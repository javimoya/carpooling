Carpooling
==========

## 1. Contenido

1. Contenido
2. Ficheros
3. Pendiente
4. Puntos Claves
5. Running
6. License

## 2. Ficheros

- README.markdown: documento con descripción del proyecto.

- register.php: página para registrar nuevos usuarios.
- thankyou.php: página de destino tras registrar un nuevo usuario.
- 404.php: página de error 404 (página no encontrada).

- .htaccess: configuración apache

- includes: carpeta con ficheros a incluir.
   - general.inc.php: contiene funciones de carácter general.
   - dbc.inc.php: contiene lo relacionado con la base de datos.
   - header.php: contiene el código fuente de la cabecera. No se debe incluir directamente (usar la función get_header).
   - footer.php: contiene el código fuente del pie de página. No se debe incluir directamente (usar la función get_footer).  
   - javascript.php: contiene la parte javascript de cada página.   
   - recaptchalib.php: funciones proporcionadas por recaptcha para poder usarlo.
   - class.phpmailer-lite.php: clase para enviar correos. No uso directamente el mail de php por seguridad.
   
- css: carpeta con ficheros de hojas de estilo.
   - mio.css: hoja de estilo propia.
- images/mios: carpeta con mis propias imágenes (no de la plantilla).
   - exclamation.png: icono usado en cajas con errores de validaciones de formularios.
   - success.png: icono para mostrar cajas de mensajes de éxito.
   - info.png: icono para mostrar cajas de mensajes informativos.
   - separador.gif: separador vertical del contenido.
   - icn_mail_received2.png: imagen de correo enviado.
   - 404b.png: imagen de página no encontrada.   
- sql: carpeta con consultas sqls usadas para la web. NO PUBLICAR.
   - dbsql.sql: sql con la creación de la tabla de usuarios.
   
## 3. Pendiente

- Realizar un script cron que se encargue de borrar usuarios registrados que no hayan activado su cuenta en 7 días. (ya realizado de otra forma)
- Crear un .htaccess (y no olvidar el control 404 -> ErrorDocument 404 /404.htm)
- register.php: el captcha sólo habría que mostrarlo si la IP ha tenido registros previos, o intentos fallidos.
- thankyou.php: mirar el registro en xing.com. Tiene cosas interesante -> te deja cambiar el correo (por si te has equivocado) -podemos pasarlo por session- ; te muestra un enlace a Gmail. 


## 4. Puntos Claves

- register.php
   
   - El proceso de registro debe ser fácil y rápido para no desanimar al potencial usuario. Mientras menos campos se le pidan mejor.
      - En el formulario de registro no se le pide repetir el email como suele ser habitual para evitar errores. -> Tras enviarle el correo para confirmar el registro se le permite cambiarlo si se ha equivocado mientras aún no haya realizado la activación.
      - El captcha es necesario por motivos de seguridad (evitar registros automáticos), pero es muy molesto para el usuario. Sólo se muestra en ips que tengan ya X registros anteriores -fallidos y exitosos- (o por fecha).
   - Validación client-side del formulario con jQuery Validate.   
   - Si el usuario está ya conectado e intenta acceder a esta página se le redirecciona a la gestión de su cuenta. Si quiere registrar otra cuenta que haga logout manualmente.
   - hola@gmail.com = hola+ext@gmail.com (Se tienen en cuenta las extensiones de los correos para evitar que se usen para crear varias cuentas al mismo correo).
   - algo muy molesto suele ocurrir tras registrarte en una página: el navegador te pregunta si deseas guardar la contraseña... Eso tiene sentido en la página de login... pero no en la de registro. Aquí lo solucionamos desactivando el autocompletado... Desventaja: Si un registro produce algún fallo los campos se quedan vacíos. Solución : Rellenamos los campos introducidos nosotros para que nos lo tenga que volver a teclear el usuario.
   - las validaciones realizadas en el server-side -> los posibles errores se muestran en la misma página... y no en otra.
   - tooltips donde se explica al usuario porque se le pide un email, y donde se le explica el porqué del captcha.
   - justo antes de registrar usuarios borra usuarios inactivos antiguos, para no ocupar muchos nombres de usuarios/mails. (se podría hacer en un cron)
   
- thankyou.php

   - Sólo accesible en la misma sesión en la aue has realizado el registro. Si intentas acceder sin haber iniciado el registro te lleva a error 404.
   - Te permite cambiar el correo (por si te has equivocado al registrate). En tal caso te vuelve a enviar el mensaje de activación.
   - Sólo te permite 3 cambios para evitar abusos.
   - Al cambiar el email se controla que no sea el mismo correo (en cuenta extensiones), que la cuenta ya no esté activada, que siga existiendo, que no esté baneado, etc...

## 5. Running

To execute run the game, use

    ./src/jvgs

By default, it runs the game in fullscreen mode. If you do not want this, you
can run it like this in windowed mode:

    ./src/jvgs main.lua --width 800 --height 600

JVGS will remember the most recent video mode. To put it in fullscreen mode
again, use:

    ./src/jvgs main.lua --fullscreen yes

## 6. License

JVGS is released under the [WTFPL](http://sam.zoy.org/wtfpl/).
