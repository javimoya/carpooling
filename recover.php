<?php 

   include("includes/general.inc.php");
   include("includes/dbc.inc.php");   
      
   page_protect(false, true);
                       
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
   
   get_header("recover.php", true);
   
   escribir_titulo("Recuperación de contraseñas", "Introduce tu email");
   
   // Mostramos una caja con los errores encontrados tras hacer submit 
   escribir_resultado_validaciones($hasError);
   
?> 

         <div class="contentArea">

            <div class="half-page separador">

               <h1 class="title">Solicitar una nueva contraseña
                  <span>Rellena el siguiente formulario para conseguirlo.</span>
               </h1>
                        
               <p>Desde esta página puedes recuperar tu clave si no la recuerdas. Introduce el email desde el que te registraste y te enviaremos una nueva contraseña.</p>
               
               <form class="cmxform" id="CommentForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
                  <fieldset>
                     <legend>Formulario de Recuperación de Contraseñas</legend>
                     <div>
                        <label for="Email">Correo electrónico<br></label>
                        <input id="Email" name="Email" class="textInput" />
                     </div>
                     
                     <?php escribir_captcha(); ?>

                     <div>
                        <button name="doRegister" value="Register" type="submit" class="btn"><span>Enviar</span></button>
                     </div>
                  </fieldset>
               </form>
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
      
      global $hasError, $data, $dbc, $globals, $mostrar_captcha;
            
      validar_captcha($hasError);

      
      // PENDIENTE: VALIDAR EMAIL ... y en register.php
            
      $user_email = $data['Email'];
      
      // Valido si existe ya el email
      $parts = explode('@', $user_email);      
      $subparts = explode('+', $parts[0]); // se permiten direcciones del tipo user+extension@gmail.com, que debemos controlar para no permitir abusos      
            
      $rs_check = mysql_query("select `id` from users where (user_email = '$subparts[0]@$parts[1]' or user_email LIKE '$subparts[0]+%@$parts[1]') AND banned=0 limit 1") or die (mysql_error()); 
      $num = mysql_num_rows($rs_check);
        
      if ( $num <= 0 ) 
      { 
         $hasError[] = "El correo electrónico introducido no está registrado o la cuenta está anulada.";
         return;
      }        
      
      if(empty($hasError)) 
      {
      
         $new_pwd = GenKey();
         $pwd_reset = PwdHash($new_pwd);
         
         list($id) = mysql_fetch_row($rs_check);
         
         $rs_activ = mysql_query("update users set pwd='$pwd_reset' WHERE 
                                    id=$id") or die(mysql_error());
                                    
                                    
         enviar_correo_recover($user_email,$new_pwd);

         $_SESSION['hasSuccessRecover'] = "Te hemos enviado un mensaje a $user_email con tu nueva contraseña."; 
         $_SESSION['hasInfoRecover'] = "Si no recibes el correo en unos instantes revisa también en la carpeta de spam.";

         header("Location: login.php");
         exit();         
         

       }      
      

   }   
   
?>
	