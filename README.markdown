Carpooling
==========

## 1. Contenido

1. Contenido
2. Ficheros
3. Pendiente
4. Compiling
5. Running
6. License

## 2. Ficheros

- README.markdown: documento con descripción del proyecto.
- ejemplo.php: fichero de ejemplo para empezar a probar cosas.
- register.php: página para registrar nuevos usuarios.
- recaptchalib.php: funciones proporcionadas por recaptcha para poder usarlo.
- includes: carpeta con ficheros a incluir.
   - general.inc.php: contiene funciones de carácter general.
   - dbc.inc.php: contiene lo relacionado con la base de datos.
   - header.php: contiene el código fuente de la cabecera. No se debe incluir directamente (usar la función get_header).
   - footer.php: contiene el código fuente del pie de página. No se debe incluir directamente (usar la función get_footer).  
- css: carpeta con ficheros de hojas de estilo.
   - mio.css: hoja de estilo propia.
- images/mios: carpeta con mis propias imágenes (no de la plantilla).
   - exclamation.png: icono usado en cajas con errores de validaciones de formularios.
   - separador.gif: separador vertical del contenido.
- sql: carpeta con consultas sqls usadas para la web. NO PUBLICAR.
   - dbsql.sql: sql con la creación de la tabla de usuarios.
   
## 3. Pendiente

- Realizar un script cron que se encargue de borrar usuarios registrados que no hayan activado su cuenta en 7 días.

## 4. Compiling

cd into the jvgs folder, and then:

    cmake .
    make

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
