<?php 

   include("includes/general.inc.php");
   include("includes/dbc.inc.php");   
      
   page_protect(false, true);
             
   function debo_mostrar_captcha()
   {
      global $globals;
      // Sólo mostramos el captcha si se ha registrado con éxito ya esta ip en las últimas 24 horas
      // o si se han fallado 3 veces durante el registro en las últimas 24 horas
      return ((log_get("register_ok",ip2long($globals['ip']), 0, 24*60*60)>0) || (log_get("register_fail",ip2long($globals['ip']), 0, 24*60*60)>=3));
   }
   
   $mostrar_captcha = debo_mostrar_captcha();   
        
   // Cuando pulsamos submit del formulario entramos por aquí...
   if (array_key_exists('doRegister', $_POST)) 
   {
      // Filtramos todos los campos del formulario, para evitar código malicioso
      foreach($_POST as $key => $value) {
      	$data[$key] = filter($value);
      }
      
      // Validamos los datos, y si son correctos creamos el usuario
      do_register();      
      
      if(!empty($hasError))
      {         
         log_insert("register_fail",ip2long($globals['ip']));                     
         $mostrar_captcha = debo_mostrar_captcha();                  
      }      
               
   }   
   
   get_header("register.php", $mostrar_captcha);
   
   escribir_titulo("Regístrate", "Entra en la comunidad");

   // Mostramos una caja con los errores encontrados tras hacer submit 
   escribir_resultado_validaciones($hasError);
   
?> 

         <div class="contentArea">

            <div class="half-page separador">
               <!-- Contact form -->
               <h1 class="title">
                  Crea tu cuenta. Es GRATIS
                  <span>Rellena el siguiente formulario para darte de alta.</span>
               </h1>
                        
               <p>Una vez completado el registro tendrás acceso a todas las secciones de la web. Es completamente gratis y no lleva más de 1 minuto.</p>
               
               <form class="cmxform" id="CommentForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
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
                     
                     <?php if ($mostrar_captcha) 
                     { 
                        escribir_captcha();
                     } ?>

                     <div>
                        <button name="doRegister" value="Register" type="submit" class="btn"><span>Crear mi cuenta</span></button>
                     </div>
                  </fieldset>
               </form>
            </div>
            
            mostrar_info_adicional();



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
      
      global $hasError, $data, $dbc, $globals, $mostrar_captcha;
      
      borrar_usuarios_no_activados_antiguos();      

      if ($mostrar_captcha)  
      {
         validar_captcha($hasError);
      }
      
      $user_ip = $globals['ip'];
      
      // hash sha1 de la clave
      $sha1pass = PwdHash($data['Password']);
            
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
         
         log_insert("register_ok",ip2long($globals['ip']));
       
         $_SESSION['email_registro'] = $usr_email; 
         $_SESSION['email_registro_contador'] = 3; 
         $_SESSION['hasSuccess'] = null;          
         
         enviar_correo_registro($usr_email,$md5_id,$activ_code);
      
         header("Location: thankyou.php");  
         
         exit();
     
      }
   }   
   
?>
	