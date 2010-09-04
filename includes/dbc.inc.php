<?php

define ("DB_HOST", "127.0.0.1"); // set database host
define ("DB_USER", "admin"); // set database user
define ("DB_PASS","admin"); // set database password
define ("DB_NAME","carpoolingdb"); // set database name

$dbc['link'] = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$dbc['db'] = mysql_select_db(DB_NAME, $dbc['link']) or die("Couldn't select database");

define("COOKIE_TIME_OUT", 10); //specify cookie timeout in days (default is 10 days)
define('SALT_LENGTH', 9); // salt for password

// filtra ("sanitiza") datos introducidos por el usuario para evitar código malicioso
function filter($data) {
	$data = trim(htmlentities(strip_tags($data)));
	
	if (get_magic_quotes_gpc())
		$data = stripslashes($data);
	
	$data = mysql_real_escape_string($data);
	
	return $data;
}


function borrar_usuarios_no_activados_antiguos()
{
   global $dbc;
   // miro si se han borrado usuarios inactivos en las últimas 72 horas
   $borrados_inactivos = log_get("users_inactives_deleted", 0, 0, 72*60*60);
   if ($borrados_inactivos==0)
   {      
      // si no se ha realizado borrado en las últimas 72 horas lo hago ahora
      $sql_delete = "DELETE from `users` WHERE `approved` = 0 AND `date` < now() - INTERVAL 3 DAY";
               
      mysql_query($sql_delete,$dbc['link']) or die("Deletion Failed:" . mysql_error());         
      log_insert("users_inactives_deleted", 0, 0) ;
   }         
}

function log_get($tipo, $ref_id, $user_id=0, $seconds=0) 
{
   global $dbc, $globals;
   
   if ($seconds > 0) 
   {      
      $interval = "and log_date > date_sub(now(), interval $seconds second)";
   } else $interval = '';
   $rs_duplicate = mysql_query("select count(*) from logs where log_type='$tipo' and log_ref_id  = $ref_id $interval and log_user_id = $user_id order by log_date desc limit 1") or die(mysql_error());
   list($total) = mysql_fetch_row($rs_duplicate);
   return $total;
}


function log_insert($tipo, $ref_id, $user_id=0) 
{
   global $dbc, $globals;
   
   
   $sql_insert = "INSERT into `logs`
               (`log_type`,`log_ref_id`,`log_user_id`, `log_ip`)
                VALUES
                ('$tipo', $ref_id, $user_id, '$globals[ip]')
               ";
               
   mysql_query($sql_insert,$dbc['link']) or die("Insertion Failed:" . mysql_error());   
}

// algoritmo hash
function PwdHash($pwd, $salt = null)
{
    if ($salt === null)     {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
    }
    else     {
        $salt = substr($salt, 0, SALT_LENGTH);
    }
    return $salt . sha1($pwd . $salt);
}

function page_protect($ir_a_login = true, $ir_a_myaccount_si_conectado = false) 
{
   $usuario_conectado=false;

   session_start();
   
   global $db; 
   
   /* Secure against Session Hijacking by checking user agent */
   if (isset($_SESSION['HTTP_USER_AGENT']))
   {
       if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
       {
           logout($ir_a_login);
           exit;
       }
   }
   
   // before we allow sessions, we need to check authentication key - ckey and ctime stored in database
   
   /* If session not set, check for cookies set by Remember me */
   if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) ) 
   {
      if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_key']))
      {
         /* we double check cookie expiry time against stored in database */
      
         $cookie_user_id  = filter($_COOKIE['user_id']);
         $rs_ctime = mysql_query("select `ckey`,`ctime` from `users` where `id` ='$cookie_user_id'") or die(mysql_error());
         list($ckey,$ctime) = mysql_fetch_row($rs_ctime);
         // coookie expiry
         if( (time() - $ctime) > 60*60*24*COOKIE_TIME_OUT) 
         {
            logout($ir_a_login);
         }
         else
         {
         
            /* Security check with untrusted cookies - dont trust value stored in cookie.       
            /* We also do authentication check of the `ckey` stored in cookie matches that stored in database during login*/
      
            if( !empty($ckey) && is_numeric($_COOKIE['user_id']) && isUserID($_COOKIE['user_name']) && $_COOKIE['user_key'] == sha1($ckey)  ) 
            {
               session_regenerate_id(); //against session fixation attacks.
      
               $_SESSION['user_id'] = $_COOKIE['user_id'];
               $_SESSION['user_name'] = $_COOKIE['user_name'];
               
               /* query user level from database instead of storing in cookies */   
               list($user_level) = mysql_fetch_row(mysql_query("select user_level from users where id='$_SESSION[user_id]'"));
      
               $_SESSION['user_level'] = $user_level;
               $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
               
               $usuario_conectado=true;
            
            } 
            else 
            {
               logout($ir_a_login);
            }
            
         }
         
      } 
      else 
      {
         if ($ir_a_login)
         {
            header("Location: login.php");
            exit();
         }
      }
   }
   else
   {
      $usuario_conectado=true;
   }
   
   if ($usuario_conectado && $ir_a_myaccount_si_conectado)
   {
            echo "estoy conectado y voy a myaccount!!" ; // pendiente
            exit();
   }
}


function logout($ir_a_login=true)
{
   global $db;
   session_start();
   
   if (isset($_SESSION['user_id']))
   {
      mysql_query("update `users` 
         set `ckey`= '', `ctime`= '' 
         where `id`='$_SESSION[user_id]'") or die(mysql_error());
   }     
   else
   {      
      if ((isset($_COOKIE['user_id'])) && is_numeric($_COOKIE['user_id']))
      {   
         $cookie_user_id  = filter($_COOKIE['user_id']);
      }
   
      if (isset($cookie_user_id)) 
      {
         mysql_query("update `users` 
            set `ckey`= '', `ctime`= '' 
            where `id` = '$_COOKIE[user_id]'") or die(mysql_error());
      }
   }

   /************ Delete the sessions****************/
   unset($_SESSION['user_id']);
   unset($_SESSION['user_name']);
   unset($_SESSION['user_level']);
   unset($_SESSION['HTTP_USER_AGENT']);
   session_unset();
   session_destroy(); 
   
   /* Delete the cookies*******************/
   setcookie("user_id", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
   setcookie("user_name", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
   setcookie("user_key", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
   
   if ($ir_a_login)
   {
      header("Location: login.php");
   }
}   

function isUserID($username)
{
   if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) 
   {
      return true;
   } 
   else 
   {
      return false;
   }
 } 
 
?>