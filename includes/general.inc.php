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



/**
 * Load header template.
 *
 * Includes the header template for a theme or if a name is specified then a
 * specialised header will be included.
 *
 * For the parameter, if the file is called "header-special.php" then specify
 * "special".
 *
 * @uses locate_template()
 * @since 1.5.0
 * @uses do_action() Calls 'get_header' action.
 *
 * @param string $name The name of the specialised header.
 */
function get_header( $paginaJs = null ) {
   include("header.php");
}

function incluirJavascript( $pagina ) {
   include("javascript.php");
}

/**
 * Load header template.
 *
 * Includes the header template for a theme or if a name is specified then a
 * specialised header will be included.
 *
 * For the parameter, if the file is called "header-special.php" then specify
 * "special".
 *
 * @uses locate_template()
 * @since 1.5.0
 * @uses do_action() Calls 'get_header' action.
 *
 * @param string $name The name of the specialised header.
 */
function get_footer( $name = null ) {    
   include("footer.php");
}

function enviar_correo_registro($usr_email,$md5_id,$activ_code)
{
   global $globals;
                  
   require_once('class.phpmailer-lite.php');
   
   

   $mail             = new PHPMailerLite(); 
   
   $mail->From = 'auto-reply@' . $globals['host'];
   $mail->FromName = $globals['nombrewebsite'];

   $mail->IsMail(); // telling the class to use native PHP mail()
   
         $a_link = 

      
         $message = 
"¡Hola!<br><br>

Muchas gracias por registrarte en $globals[nombrewebsite].<br><br>

Aún queda un último paso. Pulsa sobre el siguiente enlace (o copia y pégalo en tu navegador) para completar el registro y activar tu cuenta:<br>
http://" . $globals['host'] . $globals['path'] . "/activate.php?user=$md5_id&activ_code=$activ_code<br><br>

Si has recibido este mensaje por error, simplemente bórralo.<br><br>

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
