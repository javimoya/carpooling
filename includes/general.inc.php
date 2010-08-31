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
function get_header( $name = null ) {
   include("header.php");
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


			
