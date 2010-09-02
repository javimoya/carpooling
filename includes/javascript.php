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
                  Email: 
                  {
                     required: true,
                     email: true
                  },
                  recaptcha_response_field: 
                  {
                     required: true
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
                  Email: 
                  {
                     required: "Debe informar el email",
                     email: "Debe introducir un email válido"
                  },
                  recaptcha_response_field: 
                  {
                     required: "Debe informar el código de seguridad"
                  }
               }
            }
         );         
         
      } 
      
      
   );

   
   var RecaptchaOptions = {
      theme: 'custom',
      lang: 'es',
      custom_theme_widget: 'recaptcha_widget'
   };
   
   </script>

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
   
   </script>

<?php

}

?>