<?php

if ($pagina=="register.php")
{

?>
   
   <script src="js/jquery.validate.min.js" type="text/javascript"></script>

   <script type="text/javascript">

   $(document).ready(
      function()
      {
         $('#CommentForm').attr('autocomplete', 'off');
         $("#UserName").focus();
         
         $.validator.addMethod("username", 
            function(value) 
            {
               return /^[a-z0-9\_]+$/i.test(value);
            }, 
            ""
         );
         
         $("#CommentForm").validate
         (
            {      
               rules: 
               {
                  UserName: 
                  {
                     required: true,
                     minlength: 3,
                     maxlength: 20,
                     username: true
                  },
                  Password: 
                  {
                     required: true,
                     minlength: 5,
                     maxlength: 20
                  },
                  RepeatPassword: 
                  {
                     equalTo: "#Password"
                  },
                  <?php if ($mostrar_captcha) { ?>
                  recaptcha_response_field: 
                  {
                     required: true
                  },
                  <?php } ?>
                  Email: 
                  {
                     required: true,
                     email: true
                  }
               },
      
               messages:
               {
                  UserName: 
                  {
                     required: "Debe informar el nombre de usuario",
                     minlength: "El nombre de usuario debe tener al menos 3 carácteres",
                     maxlength: "El nombre de usuario debe tener como máximo 20 carácteres",
                     username: "El nombre de usuario sólo debe contener letras y números"
                  },
                  Password: 
                  {
                     required: "Debe informar la clave",
                     minlength: "La clave debe tener al menos 5 carácteres",
                     maxlength: "La clave debe tener como máximo 20 carácteres"
                  },
                  RepeatPassword: 
                  {
                     equalTo: "No ha tecleado la misma clave"
                  },
                  <?php if ($mostrar_captcha) { ?>
                  recaptcha_response_field: 
                  {
                     required: "Debe informar el código de seguridad"
                  },
                  <?php } ?>
                  Email: 
                  {
                     required: "Debe informar el email",
                     email: "Debe introducir un email válido"
                  }
               }
            }
         );         
         
      } 
      
      
   );
   
<?php

}
else if ($pagina=="recover.php")
{

?> 

   <script src="js/jquery.validate.min.js" type="text/javascript"></script>

   <script type="text/javascript">

   $(document).ready(
      function()
      {
         $("#Email").focus();
                  
         $("#CommentForm").validate
         (
            {      
               rules: 
               {
                  recaptcha_response_field: 
                  {
                     required: true
                  },
                  Email: 
                  {
                     required: true,
                     email: true
                  }
               },
      
               messages:
               {
                  recaptcha_response_field: 
                  {
                     required: "Debe informar el código de seguridad"
                  },
                  Email: 
                  {
                     required: "Debe informar el email",
                     email: "Debe introducir un email válido"
                  }
               }
            }
         );         
         
      } 
      
      
   );
        
   
<?php

}
else if ($pagina=="login.php")
{

?>   
   
   <script src="js/jquery.validate.min.js" type="text/javascript"></script>
   <script src="js/customInput.jquery.js" type="text/javascript"></script>

   <script type="text/javascript">

   $(document).ready(
      function()
      {         
         $("#UserNameEmail").focus();
         
         $('input').customInput();
                  
         $("#CommentForm").validate
         (
            {      
               rules: 
               {
                  UserNameEmail: 
                  {
                     required: true
                  },
                  RememberMe: 
                  {
                     required: true
                  },
                  <?php if ($mostrar_captcha) { ?>
                  recaptcha_response_field: 
                  {
                     required: true
                  },
                  <?php } ?>                  
                  Password: 
                  {
                     required: true
                  }
               },
      
               messages:
               {
                  UserNameEmail: 
                  {
                     required: "Debe informar el nombre de usuario o correo electrónico"
                  },
                  Password: 
                  {
                     required: "Debe informar la clave"
                  }
                  <?php if ($mostrar_captcha) { ?>
                  ,
                  recaptcha_response_field: 
                  {
                     required: "Debe informar el código de seguridad"
                  }
                  <?php } ?>
               }
            }
         );         
         
      } 
      
      
   );
   
   
<?php

}
else if ($pagina=="thankyou.php")
{

?>

   <script src="js/jquery.validate.min.js" type="text/javascript"></script> 

   <script type="text/javascript">         

   $(document).ready(
      function()
      {
                                             
         $('#CommentForm').attr('autocomplete', 'off');
         
         $("a#mostrar-cambio-email").click(
            function () 
            {
               $("#email-confirm-show").fadeOut('fast', 
                  function () 
                  {
                     $("#oculto-inicialmente").fadeIn('fast',
                        function () 
                        { 
                           $("#CambioEmail").focus(); 
                        }
                     );
                  }
               );
   
               return true;
  
            }
         );            
   
         $("#CommentForm").validate
         (
            {
      
               errorPlacement: function(error, element) 
               {
                  //error.appendTo( "#MensajeDeError" );
                  error.insertAfter(".btn");
               },
      
               rules: 
               {
                  CambioEmail: 
                  {
                     required: true,
                     email: true
                  }
               },
      
               messages:
               {
                  CambioEmail: 
                  {
                     required: "Debe informar el email",
                     email: "Debe introducir un email válido"
                  }
               }
            }
         ); 

      }      
   );      

<?php

}

if ($mostrar_captcha) { ?>
   
   var RecaptchaOptions = {
      theme: 'custom',
      lang: 'es',
      custom_theme_widget: 'recaptcha_widget'
   };
   
<?php } ?>
   
</script>