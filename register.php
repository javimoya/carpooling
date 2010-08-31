<?php 

   include("includes/general.inc.php");
   include("includes/dbc.inc.php");
     
   // Cuando pulsamos submit del formulario entramos por aquí...
   if (array_key_exists('doRegister', $_POST)) 
   {
      /******************* Filtering/Sanitizing Input *****************************
      This code filters harmful script code and escapes data of all POST data
      from the user submitted form.
      *****************************************************************/
      // Filtramos todos los campos del formulario, para evitar código malicioso
      foreach($_POST as $key => $value) {
      	$data[$key] = filter($value);
      }
      
      // Validamos los datos, y si son correctos creamos el usuario
      do_register();      
               
   }
   
   get_header();
   
?> 

         <!-- Page Content -->
         <div class="contentArea">
            <!-- Title / Page Headline -->
            <div class="full-page">
               <h1 class="headline"><strong>Regístrate</strong> &nbsp;//&nbsp; Entra en la Comunidad.</h1>
            </div>
            
            <div class="hr"></div>
            
            <!-- End of Content -->
            <div class="clear"></div>
         </div>

            
         <?php if(isset($hasError)) { // Mostramos una caja con los errores encontrados tras hacer submit ?>

         <div class="contentArea">
            <!-- Title / Page Headline -->
            <div class="full-page">
               <div class="validation"><strong>Se han producido los siguientes errores:</strong><br><br>
               <?php foreach ($hasError as $i => $value) {
                  echo "&nbsp;&nbsp;&nbsp;● " . $value . "<br>";
               }
               ?>
               </div>               
            </div>
            
            <!-- End of Content -->
            <div class="clear"></div>
         </div>
         
         <?php } ?>


         <div class="contentArea">

            <div class="half-page separador">
               <!-- Contact form -->
               <h1 class="title">
                  Crea tu cuenta. Es GRATIS
                  <span>Rellena el siguiente formulario para darte de alta.</span>
               </h1>
                        
               <p>Una vez completado el registro tendrás acceso a todas las secciones de la web. Es completamente gratis y no lleva más de 1 minuto.</p>
               
               <form class="cmxform" id="CommentForm" method="post" action="#" >
                  <fieldset>
                     <legend>Formulario de Registro</legend>
                     <div>
                        <label for="UserName">Nombre de usuario<br></label>
                        <input id="UserName" name="UserName" class="textInput" <?php if(isset($_POST["UserName"])) echo 'value="' . $_POST["UserName"] . '"'; ?> />
                     </div>
                     <div>
                        <label for="Password">Contraseña<br></label>
                        <input id="Password" name="Password" class="textInput" type="password" <?php if(isset($_POST["Password"])) echo 'value="' . $_POST["Password"] . '"'; ?> />
                     </div>
                     <div>
                        <label for="RepeatPassword">Repite la contraseña<br></label>
                        <input id="RepeatPassword" name="RepeatPassword" class="textInput" type="password"  <?php if(isset($_POST["RepeatPassword"])) echo 'value="' . $_POST["RepeatPassword"] . '"'; ?> />
                     </div>
                     <div>
                        <label for="Email"><a TABINDEX=-1 href="#" title="¿Para qué lo queremos?|Necesitamos tu dirección de correo electrónico para confirmar tu registro y para que te podamos recordar tu contraseña si la pierdes. En ningún momento será visible para el resto de usuarios ni se usará para enviarte SPAM ni nada por el estilo.">Correo electrónico</a><br></label>
                        <input id="Email" name="Email" class="textInput" <?php if(isset($_POST["Email"])) echo 'value="' . $_POST["Email"] . '"'; ?> />
                     </div>
         
                     <div id="recaptcha_widget" style="display:none"><div id="recaptcha_image" style="border:1px solid #333;"></div>
                        <label for="recaptcha_response_field"><a TABINDEX=-1 href="#" title="¿Qué es esto?|Este tipo de imágenes (conocidas como &quot;captchas&quot;) son utilizadas para evitar que programas automáticos puedan registrarse.">¿Eres un humano?</a> Escribe las 2 palabras de arriba<br><a TABINDEX=-1 href="javascript:Recaptcha.reload()">(Pulsa aquí para obtener otras dos palabras)</a><br></label>
                        <input id="recaptcha_response_field" name="recaptcha_response_field" class="textInput" />   
                     <script type="text/javascript" src="//www.google.com/recaptcha/api/challenge?k=<?php echo $globals['publickey']; ?>"></script>
                     </div>

                     <div>
                        <button name="doRegister" value="Register" type="submit" class="btn"><span>Crear mi cuenta</span></button>
                     </div>
                  </fieldset>
               </form>
            </div>

            <div class="half-page justificado">    
               <h3>¿Qué es <?php echo $globals['nombrewebsite']; ?>?</h3>
               <p>Una plataforma gratuita con la que conductores y pasajeros puedan ponerse en contacto para compartir coche en desplazamientos habituales (tanto dentro como fuera de una misma localidad; por ejemplo para ir diariamente al trabajo/centro de estudios), o para realizar viajes puntuales.<br><br> 
                  Los beneficios, entre otros, son:<ul><li>Los gastos de gasolina, peajes, parking, etc... se pueden compartir.</li><li>Viajar en compañía.</li><li>Ejercer una movilidad más sostenible y responsable con el medio ambiente.</li></ul>
               </p>
               <h3>¿Aún no eres usuario de <?php echo $globals['nombrewebsite']; ?>?</h3>
               <p>Como usuario registrado podrás, entre otras cosas:</p>
               <ul class="bullet-check">
               <li><h5>Publicar tus rutas como conductor</h5>
               <p>Para que otras personas interesadas en el mismo trayecto que realizas (ya sea regular o puntualmente) puedan contactar contigo para viajar juntos.</p></li>
               <li><h5>Buscar si alguien puede llevarte a donde te interesa</h5>
               <p>Como pasajero sin automóvil podrás encontrar facilmente si alguna ruta publicada se amolda a tus necesidades y escribir al conductor para llegar a un acuerdo.</p></li>
               <li><h5>Crear y recibir "alertas"</h5>
               <p>Si finalmente nadie realiza actualmente la ruta que te interesa puedes definir que se te avise cuando en un futuro alguien la haga.</p></li>
               </ul>             
            </div>

            <!-- End of Content -->
            <div class="clear"></div>
         </div>
         
         <!-- End of Content -->
         <div class="clear"></div>
		
<?php 

   // Mostramos el pie de página
   get_footer();
   
   // FUNCIONES
   
   function do_register() {
      
      global $hasError, $data, $dbc, $globals;

      // Valido el captcha      
      require_once('recaptchalib.php');
      $resp = recaptcha_check_answer ($globals['privatekey'],
                                   $_SERVER["REMOTE_ADDR"],
                                   $_POST["recaptcha_challenge_field"],
                                   $_POST["recaptcha_response_field"]);
   
      if (!$resp->is_valid) {
        $hasError[] = "El código de seguridad no es correcto.";
      }     
      
      $user_ip = $_SERVER['REMOTE_ADDR'];
      
      // hash sha1 de la clave
      $sha1pass = PwdHash($data['Password']);
      
      $host  = $_SERVER['HTTP_HOST']; // compartir-coche.org
      $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      
      // Generamos el código de activación
      $activ_code = rand(1000,9999);
      
      $usr_email = $data['Email'];
      $user_name = $data['UserName'];

      // Valido si existe ya el usuario
      $rs_duplicate = mysql_query("select count(*) as total from users where user_name='$user_name'") or die(mysql_error());
      list($total) = mysql_fetch_row($rs_duplicate);
      
      if ($total > 0)
      {         
         $hasError[] = "El usuario ya está dado de alta.";
      }
      
      // Valido si existe ya el email
      $parts = explode('@', $usr_email);      
      $subparts = explode('+', $parts[0]); // se permiten direcciones del tipo user+extension@gmail.com, que debemos controlar para no permitir abusos
      $rs_duplicate = mysql_query("select count(*) as total from users where user_email = '$subparts[0]@$parts[1]' or user_email LIKE '$subparts[0]+%@$parts[1]'") or die(mysql_error());
      list($total) = mysql_fetch_row($rs_duplicate);
      
      if ($total > 0)
      {         
         $hasError[] = "El email ya está dado de alta.";
      }
            
      
      if(empty($hasError)) {
      
         // Insertamos el Nuevo Usuario
         
         $sql_insert = "INSERT into `users`
                  (`user_email`,`pwd`,`date`,`users_ip`,`activation_code`,`user_name`)
                   VALUES
                   ('$usr_email','$sha1pass',now(),'$user_ip','$activ_code','$user_name')
                  ";
                  
         mysql_query($sql_insert,$dbc['link']) or die("Insertion Failed:" . mysql_error());
         $user_id = mysql_insert_id($dbc['link']);  
         $md5_id = md5($user_id);
         mysql_query("update users set md5_id='$md5_id' where id='$user_id'");
       
         if($dbc['$user_registration'])  {
            
            $a_link = 
"Aún queda un último paso. Pulsa sobre el siguiente enlace para completar el registro y activar tu cuenta:
http://$host$path/activate.php?user=$md5_id&activ_code=$activ_code"; 
         } else {
            $a_link = 
"Tu cuenta está pendiente de aprobación y pronto será activada por el administrador.";
         }
      
         $message = 
"¡Hola!
Muchas gracias por registrarte en $globals[nombrewebsite].

$a_link

Atentamente,
El equipo de $globals[nombrewebsite]
______________________________________________________
ESTE ES UN MENSAJE GENERADO AUTOMÁTICAMENTE
****NO RESPONDA A ESTE CORREO****
";

//Nombre de Usuario: $user_name
//Correo: $usr_email
//Contraseña: $data[Password]

      
         mail($usr_email, "Confirma tu dirección de correo electrónico", $message,
               "From: \"$globals[nombrewebsite]\" <auto-reply@$host>\r\n" .
               "X-Mailer: PHP/" . phpversion());
      
         header("Location: thankyou.php");  
         
         exit();
      	 
      } 
   }					 
   
   
?>
	