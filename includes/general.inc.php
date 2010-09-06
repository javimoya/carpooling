<?php

$globals['nombrewebsite'] = "Compartir-Coche.org";
//kmcompartido.com
//compartimoscoche.com
//kilometrear.com
//compartirkilometros.com
//compartirkms.com
//cochelleno.com
//cochecompartido.net
//vayamosjuntos.com -> vamosjuntos ... 
//compartamoscoche.net
//compartirtransporte.com
//icarpooling.com
//coche-compartido.net
//compartir-coche.es
//compartir-coche.org   
//viajarjuntos.net
//viajamosjuntos.net
//compartirelcoche.com

/*************** reCAPTCHA KEYS****************/
$globals['publickey'] = "6LdYproSAAAAAHUwPokqT5EoCM7t9Qzuxdd4KsdQ";
$globals['privatekey'] = "6LdYproSAAAAANf8S1zVDOGVVPd0AlEJ4FUbfdy0";

$globals['host'] = $_SERVER['HTTP_HOST']; // compartir-coche.org
$globals['path'] = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// PENDIENTE probar con web proxys... a ver que sale. Y desde fiddler... a ver si se puede cambiar la ip en las cabeceras
if ( isset($_SERVER["HTTP_CLIENT_IP"]) && $_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown") )
{
  $globals['ip'] = $_SERVER["HTTP_CLIENT_IP"];
}
else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && $_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown") )
{
  $globals['ip'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
{
  $globals['ip'] = getenv("REMOTE_ADDR");
}
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
{
  $globals['ip'] = $_SERVER['REMOTE_ADDR'];
}
else
{
$globals['ip'] = "0.0.0.0";
}


function validar_captcha(&$hasError)
{
   global $globals;
   if ((isset($_POST["recaptcha_challenge_field"])) && (isset($_POST["recaptcha_response_field"])))
   {
      require_once('/includes/recaptchalib.php');
      $resp = recaptcha_check_answer ($globals['privatekey'],
                              $_SERVER["REMOTE_ADDR"],
                              $_POST["recaptcha_challenge_field"],
                              $_POST["recaptcha_response_field"]);

      if (!$resp->is_valid) 
      {
         $hasError[] = "El código de seguridad no es correcto.";
         return false;
      }     
   }
   else
   {
      $hasError[] = "El código de seguridad no es correcto.";
      return false;
   }
   return true;
}

function escribir_captcha()
{
   global $globals;
   ?>   
   <div id="recaptcha_widget" style="display:none"><div id="recaptcha_image" style="border:1px solid #333;"></div>
      <label for="recaptcha_response_field"><a TABINDEX=-1 href="#" title="¿Qué es esto?|Este tipo de imágenes (conocidas como &quot;captchas&quot;) son utilizadas para evitar que programas automáticos puedan operar en la web.">¿Eres un humano?</a> Escribe las 2 palabras de arriba<br><a TABINDEX=-1 href="javascript:Recaptcha.reload()">(Pulsa aquí para obtener otras dos palabras)</a><br></label>
      <input id="recaptcha_response_field" name="recaptcha_response_field" class="textInput" />   
      <script type="text/javascript" src="//www.google.com/recaptcha/api/challenge?k=<?php echo $globals['publickey']; ?>"></script>
   </div>
   <?php
}

function mostrar_info_adicional()
{
   global $globals;
   ?>   
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
   <?php
}
                         

function get_header( $paginaJs = null , $mostrar_captcha = false) 
{
   include("header.php");
}

function incluirJavascript( $pagina, $mostrar_captcha ) 
{
   include("javascript.php");
}

function get_footer( $name = null ) 
{
   include("footer.php");
}

function escribir_titulo($primero, $segundo)
{
   ?>
         <div class="contentArea">
            <div class="full-page">
               <h1 class="headline"><strong><?php echo $primero; ?></strong> &nbsp;//&nbsp; <?php echo $segundo; ?></h1>
            </div>            
            <div class="hr"></div>
            <div class="clear"></div>
         </div>            
   <?php         
}

function escribir_caja_resultado(&$mensaje, $tipo)
{
   if(isset($mensaje)) {   ?>

      <div class="contentArea">
         <div class="full-page">
            <div class="<?php echo $tipo; ?>">
               <strong><?php echo $mensaje; ?></strong>
            </div>
         </div>
         <div class="clear"></div>
      </div>
         
      <?php 
      $mensaje = null;
   } 
}

function escribir_resultado_validaciones( &$array ) 
{
   if(isset($array)) { ?>

      <div class="contentArea">
         <div class="full-page">
            <div class="validation">
               <strong>Se han producido los siguientes errores:</strong><br><br>
               <?php foreach ($array as $i => $value) {
                     echo "&nbsp;&nbsp;&nbsp;● " . $value . "<br>";
               } ?>
            </div>               
         </div>         
      <div class="clear"></div>
      </div>
         
   <?php } 
}


function enviar_correo_registro($usr_email,$md5_id,$activ_code)
{
   global $globals;
                  
   require_once('class.phpmailer-lite.php');   
   

   $mail = new PHPMailerLite(); 
   
   $mail->From = 'auto-reply@' . $globals['host'];
   $mail->FromName = $globals['nombrewebsite'];
   $mail->CharSet="utf-8";

   $mail->IsMail(); // telling the class to use native PHP mail()
         
   $message = 
"¡Hola!<br><br>

Muchas gracias por registrarte en $globals[nombrewebsite].<br><br>

Aún queda un último paso. Pulsa sobre el siguiente enlace (o copia y pégalo en tu navegador) para completar el registro y activar tu cuenta:<br>
http://" . $globals['host'] . $globals['path'] . "/activate.php?user=$md5_id&activ_code=$activ_code<br><br>

Si ha recibido este mensaje por error, símplemente ignórelo.<br><br>

Atentamente,<br>
El equipo de $globals[nombrewebsite]<br>
______________________________________________________<br>
ESTE ES UN MENSAJE GENERADO AUTOMÁTICAMENTE<br>
****NO RESPONDA A ESTE CORREO****<br>
";
   
   try {
     
     $mail->AddReplyTo('auto-reply@' . $globals['host'], $globals['nombrewebsite']);
     $mail->AddAddress($usr_email);
     $mail->Subject = 'Confirma tu dirección de correo electrónico';    
     $mail->MsgHTML($message);
     $mail->isHtml(false);
     $mail->Send();
     return true;
   } catch (phpmailerException $e) {
      return false;
   } catch (Exception $e) {
      return false;
   }
   
}

function enviar_correo_recover($usr_email,$new_pwd)
{
   global $globals;
                  
   require_once('class.phpmailer-lite.php');   
   

   $mail = new PHPMailerLite(); 
   
   $mail->From = 'auto-reply@' . $globals['host'];
   $mail->FromName = $globals['nombrewebsite'];
   $mail->CharSet="utf-8";

   $mail->IsMail(); // telling the class to use native PHP mail()
         
   $message = 
"¡Hola!<br><br>

Has pedido recuperar tu contraseña. Apunta tu nueva clave y úsala a partir de ahora para ingresar en la web:<br><br>

$new_pwd<br><br>

Por seguridad es recomendable que una vez conectado la cambies manualmente desde tu perfil. PENDIENTE: poner enlace.<br><br>

Atentamente,<br>
El equipo de $globals[nombrewebsite]<br>
______________________________________________________<br>
ESTE ES UN MENSAJE GENERADO AUTOMÁTICAMENTE<br>
****NO RESPONDA A ESTE CORREO****<br>
";
   
   try {
     
     $mail->AddReplyTo('auto-reply@' . $globals['host'], $globals['nombrewebsite']);
     $mail->AddAddress($usr_email);
     $mail->Subject = 'Recuperación de la contraseña';    
     $mail->MsgHTML($message);
     $mail->isHtml(false);
     $mail->Send();
     return true;
   } catch (phpmailerException $e) {
      return false;
   } catch (Exception $e) {
      return false;
   }
   
}
?>		


