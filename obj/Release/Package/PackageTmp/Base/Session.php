<?php
// start session with config - http://php.net/manual/en/session.configuration.php
//$sessionTempLifetime = 600;
//session_set_cookie_params($sessionTempLifetime, APP_PAGES_PATH, SESSION_DOMAIN, SESSION_SECURE, SESSION_HTMLONLY);
 
require_once( __DIR__.'/AppHelper.php'  );
session_start();

//setcookie(session_name(),session_cache_expire_id(),time() + lifetime);

//save a few details about the session
//$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
//$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
//$_SESSION['last_login'] = time();

/* force SSL in production */
if (REQUIRE_SSL) {
    if( (!has_presence($_SERVER['HTTPS'])) || ($_SERVER['HTTPS'] == 'off') ) {
        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $redirect");
        exit;
    }    
}

/* login required */
if ( !isset($_SESSION['SECRET']) 
	  || $_SESSION['SECRET'] !== APP_SECRET ) /* set  what APP is in AppConfig.php  */
{
	if ( !preg_match('/login\.php/', $_SERVER['REQUEST_URI'] ) ) 
	{
        // use both for max compat -- browser and php
        session_unset();
        session_destroy();
        
        // TODO: there could be a bug here if you go directly to the login.php page -- you will login fine, but you will be redirected to the login page.
		$_SESSION['Destination'] = $_SERVER['REQUEST_URI'];
		header("Location: ".DEFAULT_PROTOCOL.":".APP_PAGES_PATH."login.php");
	}
}
// If you access the login page WHILE already logged in, it reroutes to index page
else if (preg_match('/login\.php/',$_SERVER['REQUEST_URI'])) {
	header("Location: ".DEFAULT_PROTOCOL.":".APP_BASE_URL."index.php");
}
?>