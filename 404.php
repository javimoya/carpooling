<?php

      include_once("includes/general.inc.php");

?>
      
<html>
<head><title><?php echo $globals['nombrewebsite'] ?> - 404</title>
<style type="text/css">


body { font-family: "lucida grande", "Segoe UI", arial, verdana, "lucida sans unicode", tahoma, sans-serif; font-size: 8pt; color: #444; font-weight: normal;}

body { background-color: #fff; height: 100%; margin: 0; padding: 0;}

a { color: #1f75cc; text-decoration: none; }

</style>   
<link rel="shortcut icon" href="http://para.llel.us/favicon.ico"/>
</head>
<body style="background-color:#fff">
<br/><br/>
<div align="center">
<table><tr><td width="600px">
<center><img id="errorimage" src="<?php echo 'http://' . $globals['host'] . $globals['path'] . '/images/mios/404b.png' ?>"/></center>
<h1>Oops! (Error 404)</h1>
No podemos encontrar la página que estás buscando. Si crees que algo ha fallado puedes <a href='<?php echo "http://" . $globals['host'] . $globals['path'] . "/contacto.php" ?>'>contactar conmigo</a>. Mientras tanto date una vuelta por nuestra <a href='<?php echo "http://" . $globals['host'] . $globals['path'] ?>'>página principal</a>.
</td></tr></table>
</div>
</body>
</html>