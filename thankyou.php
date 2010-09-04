<?php 
   
   include("includes/general.inc.php");
   include("includes/dbc.inc.php");
  
   page_protect(false, true);
   
   // Si no estamos en una sesión de registro -> error 404    
   if (!isset($_SESSION["email_registro"])) 
   {      
      header("HTTP/1.0 404 Not Found");
      include("404.php");
      exit();
   }
     
   // Cuando pulsamos submit del formulario entramos por aquí...
   if (array_key_exists('doRegister', $_POST)) 
   {
      
      // Filtramos todos los campos del formulario, para evitar código malicioso
      foreach($_POST as $key => $value) {
      	$data[$key] = filter($value);
      }
      
      // Validamos los datos, y si son correctos creamos el usuario
      do_register();      
               
   }
      
   get_header("thankyou.php");

   escribir_titulo("Cuenta pendiente de activación", "Mira tu buzón");
   escribir_caja_resultado($_SESSION['hasSuccess'],"success");
   escribir_caja_resultado($_SESSION['hasInfo'],"information");
   // Mostramos una caja con los errores encontrados tras hacer submit 
   escribir_resultado_validaciones($hasError);   
      
?>


         <div class="contentArea">

            <div class="full-page">
                            
               <div class="mensaje" id="mensaje_email">
                  
                  <h1 class="title">Muchas gracias</h1>
                  
                  <p>Hemos enviado un mensaje con un enlace de activación a la siguiente dirección de correo electrónico:</p>
                  
                  
                     <div id="email-confirm-show"><h2 class="headline"><?php echo $_SESSION['email_registro'] ?></h2></div>
                  
                     <?php if ($_SESSION['email_registro_contador'] > 0) { ?>                   
                     <div id="oculto-inicialmente">
                     
                     <form class="cmxform" id="CommentForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
                     <fieldset>
                     <legend>Formulario de cambio de correo electrónico</legend>
                        <div>                        
                           <input id="CambioEmail" name="CambioEmail" class="textInput" <?php if(isset($_SESSION["email_registro"])) echo 'value="' . $_SESSION["email_registro"] . '"'; ?> /> 
                           &nbsp;&nbsp;<button name="doRegister" value="Register" type="submit" class="btn"><span>Cambiar correo</span></button>
                        </div>
                     </fieldset>
                     </form>                  
                     
                     </div>                  
                     <?php } ?>

                  <p>Para activar tu cuenta en <?php echo $globals['nombrewebsite']; ?> haz clic sobre el enlace que aparece en ese mensaje. Deberás hacerlo en las próximas 72 horas o se anulará automáticamente.</p>
                  <p><strong>Atención:</strong> Si no recibes el email de activación en unos minutos búscalo en la carpeta de spam.</p>
                  
                  <?php if ($_SESSION['email_registro_contador'] > 0) { ?> 
                  <p>Si te has equivocado al introducir tu correo electrónico <a id="mostrar-cambio-email" href="#">pulsa aquí para corregirlo</a>.</p>
                  <?php } ?>

               
       
               </div>                                 
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
                  
      // Generamos el nuevo código de activación
      $activ_code = rand(1000,9999);
      
      // email inicial
      $usr_email_orig = $_SESSION['email_registro'];
      $parts_orig = explode('@', $usr_email_orig);      
      $subparts_orig = explode('+', $parts_orig[0]); // se permiten direcciones del tipo user+extension@gmail.com, que debemos controlar para no permitir abusos
      $usr_email_sinext_orig = strtolower($subparts_orig[0] . '@' . $parts_orig[1]);

      // nuevo email
      $usr_email = $data['CambioEmail'];
      $parts = explode('@', $usr_email);      
      $subparts = explode('+', $parts[0]); // se permiten direcciones del tipo user+extension@gmail.com, que debemos controlar para no permitir abusos
      $usr_email_sinext = strtolower($subparts[0] . '@' . $parts[1]);
      
      if (($usr_email_orig == $usr_email) || ($usr_email_sinext_orig == $usr_email_sinext))
      {
         $hasError[] = "No ha cambiado el correo.";
         return;
      }
      
      
      $rs_duplicate = mysql_query("select count(*) as total from users where user_email = '$subparts[0]@$parts[1]' or user_email LIKE '$subparts[0]+%@$parts[1]'") or die(mysql_error());
      list($total) = mysql_fetch_row($rs_duplicate);
      
      if ($total > 0)
      {         
         $hasError[] = "El email ya está dado de alta por otro usuario.";
         return;
      }                  
      
      $result = mysql_query("SELECT `id`,`approved`, `banned`, `md5_id` FROM users WHERE user_email = '$subparts_orig[0]@$parts_orig[1]' or user_email LIKE '$subparts_orig[0]+%@$parts_orig[1]'") or die (mysql_error()); 
      $num = mysql_num_rows($result);

      
      if ( $num == 0 ) 
      { 
         $hasError[] = "Ya no existe dicho usuario.";
	      return;
      }
      else
      {
         
	      list($id,$approved,$banned,$md5_id) = mysql_fetch_row($result);
	      
	      if ($approved)
	      {
	         $hasError[] = "La cuenta ya está activada. Para cambiar el correo conéctese y vaya a su perfil.";
	         return;
	      }
	      
	      if ($banned == 1)
	      {
	         $hasError[] = "El usuario está baneado.";
	         return;
	      }
	   }
	   
    
      if(empty($hasError)) {
      
         // Actualizamos el nuevo email
         
         $sql_update = "UPDATE `users` SET `user_email` = '$usr_email', `activation_code` = '$activ_code' WHERE `id` = '$id'";
                  
         mysql_query($sql_update,$dbc['link']) or die("Update Failed:" . mysql_error());
       
         
         $_SESSION['email_registro_contador']--;
         $_SESSION['email_registro'] = $usr_email;
         $_SESSION['hasSuccess'] = "Se ha cambiado correctamente el correo y se ha enviado allí un nuevo mensaje de activación."; 
         if ($_SESSION['email_registro_contador'] == 1) 
         {
            $_SESSION['hasInfo'] = "Sólo se te permitirá un cambio más."; 
         }
         else if ($_SESSION['email_registro_contador'] == 0) 
         {
            $_SESSION['hasInfo'] = "Por motivos de seguridad ya no se te permiten más cambios."; 
         }
         
         enviar_correo_registro($usr_email,$md5_id,$activ_code);

      
         header("Location: thankyou.php");  
         
         exit();
      	 
      } 
   }					 
   
   
?>
	