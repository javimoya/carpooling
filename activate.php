<?php

   include("includes/general.inc.php");
   include("includes/dbc.inc.php");

   page_protect(false, true);

   foreach($_GET as $key => $value)
   {
      $get[$key] = filter($value);
   }

   $exito = false;


   if(isset($get['user']) && isset($get['activ_code']) && !empty($get['activ_code']) && !empty($get['user']) && is_numeric($get['activ_code']) )
   {

      borrar_usuarios_no_activados_antiguos();

      $user = filter($get['user']);
      $activ = filter($get['activ_code']);


      $rs_check = mysql_query("select id from users where md5_id='$user' and activation_code='$activ' and approved=0 limit 1") or die (mysql_error());
      $num = mysql_num_rows($rs_check);

      if ( $num > 0 )
      {
         $rs_activ = mysql_query("update users set approved='1' WHERE
                                    md5_id='$user' AND activation_code = '$activ' and approved=0 ") or die(mysql_error());
         $exito = true;
         
         $_SESSION["email_registro"]=null;

      }
   }
   else
   {
      header("HTTP/1.0 404 Not Found");
      include("404.php");
      exit();
   }
   
   get_header();

   if ($exito)
   {

      escribir_titulo("Registro completado", "Ya puedes conectarte");

?>


         <div class="contentArea">

            <div class="full-page">

               <div class="mensaje" id="mensaje_registro">

                  <h1 class="title">Bienvenido</h1>

                  <p>Tu inscripción ya ha sido confirmada y desde este momento ya formas parte de <?php echo $globals['nombrewebsite'] ?>, la más innovadora comunidad de transporte privado compartido.</p>

                  <p>Esperamos que disfrutes de nuestro servicio. El primer paso a partir de ahora es <a href="login.php">conectarte</a>.</p>

               </div>
            </div>

            <!-- End of Content -->
            <div class="clear"></div>
         </div>

         <!-- End of Content -->
         <div class="clear"></div>

<?php

   }
   else
   {
       escribir_titulo("Registro NO completado", "Ha ocurrido algún error");
       ?>

         <div class="contentArea">

            <div class="full-page">

               <div class="mensaje" id="mensaje_registro_mal">

                  <h1 class="title">Tenemos un problema</h1>

                  <p>La cuenta que estás intentando confirmar ya está activada, o ha expirado su periodo de activación (72 horas)... o se ha producido algún otro error <em>raruno</em>.</p>

                  <p>Puedes probar a <a href="register.php">registrarte de nuevo</a>. Si el problema persiste y piensas que se trata de una incidencia técnica <a href="contacto.php">escríbenos</a>.</p>

               </div>
            </div>

            <!-- End of Content -->
            <div class="clear"></div>
         </div>

         <!-- End of Content -->
         <div class="clear"></div>

       <?php

   }


   // Mostramos el pie de página
   get_footer();



?>
