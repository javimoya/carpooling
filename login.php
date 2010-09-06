<?php 

   include("includes/general.inc.php");
   include("includes/dbc.inc.php");   
      
   page_protect(false, true);

   // urlencode($_SERVER['REQUEST_URI'])      
   if(!empty($_REQUEST['continue']))
   {
      $_REQUEST['continue'] = filter($_REQUEST['continue']);
   }
         
   function debo_mostrar_captcha()
   {
      global $globals;
      // Sólo mostramos el captcha si la ip se ha logueado erroneamente 3 veces en las últimas 24 horas
      return (log_get("login_fail",ip2long($globals['ip']), 0, 24*60*60)>=3);
   }

   $mostrar_captcha = debo_mostrar_captcha();   
   
   $mostrar_info_adicional = true;
        
   // Cuando pulsamos submit del formulario entramos por aquí...
   if (array_key_exists('doRegister', $_POST)) 
   {
      $mostrar_info_adicional = false;
      
      // Filtramos todos los campos del formulario, para evitar código malicioso
      foreach($_POST as $key => $value) 
      {
      	$data[$key] = filter($value);
      }
      
      // Validamos los datos, y si son correctos logeamos al usuario
      do_register();      
      
      if(!empty($hasError))
      {
         log_insert("login_fail",ip2long($globals['ip'])); 
         $mostrar_captcha = debo_mostrar_captcha();
      }
               
   }   
   
   get_header("login.php", $mostrar_captcha);
   
   escribir_titulo("Login", "Conéctate con tu usuario");

   escribir_caja_resultado($_SESSION['hasSuccessRecover'],"success");
   escribir_caja_resultado($_SESSION['hasInfoRecover'],"information");
   
   // Mostramos una caja con los errores encontrados tras hacer submit 
   escribir_resultado_validaciones($hasError);
   
?> 

         <div class="contentArea">

            <div class="half-page separador">
                              
               <h1 class="title">Ingresa en <?php echo $globals['nombrewebsite']; ?><span>Introduce tus datos en este formulario para entrar.</span></h1>   
   
               <form class="cmxform" id="CommentForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
                  <fieldset>
                     <legend>Formulario de Login</legend>
                     <div>
                        <label for="UserNameEmail">Nombre de usuario o correo electrónico:<br></label>
                        <input id="UserNameEmail" name="UserNameEmail" class="textInput" />
                     </div>
                     <div>
                        <label for="Password">Contraseña:<br></label>
                        <input id="Password" name="Password" class="textInput" type="password" />
                     </div>                  
                     <?php if ($mostrar_captcha) 
                     { 
                        escribir_captcha();
                     } ?>                                                                  
                     <div>
                        <input id="RememberMe" name="RememberMe" type="checkbox" /><label for="RememberMe">Recuérdame en este ordenador</label>
                     </div>
                     <div>
                        <input type="hidden" name="continue" value="<?php echo htmlspecialchars($_REQUEST['continue']); ?>" />                        
                        <button name="doRegister" value="Register" type="submit" class="btn"><span>Ingresar</span></button>
                     </div>
                  </fieldset>
               </form>
            
               <p><a href="recover.php">¿Has olvidado tu contraseña?</a></p>
               <p>Si aún no estás registrado <a href="register.php">haz clic aquí</a>.</p>

            </div>
            
            <?php if ($mostrar_info_adicional) 
            { 
               mostrar_info_adicional();
            } ?>

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
      
      if ($mostrar_captcha) 
      { 
         if (!validar_captcha($hasError))
            return; // si no introduce correctamente el código de seguridad no debemos mirar nada más... porque podría sacar por fuerza bruta usuario/clave.
      }
      
      $user_email = $data['UserNameEmail'];
      $pass = $data['Password'];

      if (strpos($user_email,'@') === false) 
      {         
         $user_cond = "user_name='$user_email'";
      } 
      else 
      {
         $parts = explode('@', $user_email);      
         $subparts = explode('+', $parts[0]); // se permiten direcciones del tipo user+extension@gmail.com, que debemos controlar para no permitir abusos

         $user_cond = "(user_email='$subparts[0]@$parts[1]' or user_email LIKE '$subparts[0]+%@$parts[1]')";    
      }

   
      $result = mysql_query("SELECT `id`,`pwd`,`user_name`,`approved`,`banned`,`user_level` FROM users WHERE $user_cond limit 1") or die (mysql_error()); 
      $num = mysql_num_rows($result);

      
      if ( $num > 0 ) 
      {    
         list($id,$pwd,$user_name,$approved,$banned,$user_level) = mysql_fetch_row($result);

         if($banned) 
         {         
            $hasError[] = "Cuenta anulada.";
            return;
         }         
   
         if(!$approved) 
         {         
            $hasError[] = "Cuenta registrada pero aún no activada. Revisa tu buzón de correo y sigue el enlace que allí aparece.";
            return;
         }         
             
         if ($pwd === PwdHash($pass,substr($pwd,0,9))) 
         { 
               
            log_insert("login_ok",$id,$id);
              
            session_regenerate_id (true); //prevent against session fixation attacks.

            // this sets variables in the session 
            $_SESSION['user_id']= $id;  
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_level'] = $user_level;
            $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
   
            //update the timestamp and key for cookie
            $stamp = time();
            $ckey = GenKey();
            mysql_query("update users set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'") or die(mysql_error());
      
            //set a cookie 
      
            if(isset($_POST['remember']))
            {
               setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
               setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");
               setcookie("user_name",$_SESSION['user_name'], time()+60*60*24*COOKIE_TIME_OUT, "/");
            }
                              
            header("Location: myaccount.php");
            exit();         
         }
         else
         {         
            $hasError[] = "Contraseña incorrecta. Vuelve a intentarlo.";      
         }
      }
      else 
      {
         $hasError[] = "Usuario o correo electrónico inexistente.";
      }           
   }
            

   
?>
	