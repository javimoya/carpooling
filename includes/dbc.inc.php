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