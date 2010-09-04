<?php

$globals['nombrewebsite'] = "Compartir-Coche.org";
//vayamosjuntos
//compartamoscoche.net
//compartirtransporte.com
//icarpooling.com
//coche-compartido.net
//compartir-coche.es
//compartir-coche.org   

/*************** reCAPTCHA KEYS****************/
$globals['publickey'] = "6LdYproSAAAAAHUwPokqT5EoCM7t9Qzuxdd4KsdQ";
$globals['privatekey'] = "6LdYproSAAAAANf8S1zVDOGVVPd0AlEJ4FUbfdy0";

$globals['host'] = $_SERVER['HTTP_HOST']; // compartir-coche.org
$globals['path'] = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

get_global_ip();


function get_global_ip()
{   
    // PENDIENTE probar con web proxys... a ver que sale. Y desde fiddler... a ver si se puede cambiar la ip en las cabeceras
    global $globals;
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
?>			
