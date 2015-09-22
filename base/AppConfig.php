<?php
/* use this to control when you want special behavior for dev mode */
define( 'DEVELOPMENT_MODE' , true );  

/* this key is used to explicitly determine that the session
that the webserver has, is for this application, upon login
set the $_SESSION[APP_SECRET]=true; */
define( 'APP_SECRET'        , 'ASSESSMENTDASHBOARD'                 );

/* LDAP auth */
define( 'RSCACCTSSO'        , 'umccobldap'               ); /* account name */
define( 'RSCACCTPASS'       , 'Bu51n355'                 ); /* account password */

define( 'DEFAULT_PROTOCOL'  , 'http'                     ); /* default to HTTPS or HTTP */
define( 'REQUIRE_SSL'       , true ); /* default to opposite of dev mode setting */
if (DEVELOPMENT_MODE === true) {
    define( 'APP_BASE_URL'      , '//apps-dev.business.missouri.edu/dashboard/'); /* root of app url */
} else {
    define( 'APP_BASE_URL'      , '//apps.business.missouri.edu/dashboard/'); /* root of app url */
}
define( 'APP_RESOURCE_PATH' , APP_BASE_URL.'resources/'  ); /* correct path to app resources */
define( 'APP_PAGES_PATH'    , APP_BASE_URL.'pages/'      ); /* correct path to any top level page in the app */
define( 'APP_TITLE'         , 'Assessment Dashboard'   ); /* this is for rendering the header  */
define( 'APP_CAPTION'       , ''); /* this is for rendering the header as well */
if (DEVELOPMENT_MODE === true) {
    define( 'LOG_PATH'          , 'c:/logs/dashboard/' ); // log location - protect this
} else {
    define( 'LOG_PATH'          , 'd:/website logs/dashboard/' ); // log location - protect this
}
define( 'LOG_FILE'          , date('Y-m-d').'_dashboard.log'  ); // log file

/* remember to ask for your app to be treated like one by IIS */
define( 'PERMISSIONS_SET'   , true);

/* configure app specific session requirements */
define( 'SESSION_EXPIRATION', 0 ); // when the browser is closed
if (DEVELOPMENT_MODE === true) {
    // Display Errors
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    // Error Reporting
    error_reporting(1);
    define( 'SESSION_DOMAIN'    , 'apps-dev.business.missouri.edu' );
} else {
    // Display Errors
    ini_set('display_errors', 'Off');
    ini_set('html_errors', 0);

    // Error Reporting
    error_reporting(0);
    define( 'SESSION_DOMAIN'    , 'apps.business.missouri.edu' );
}
define( 'SESSION_SECURE'    , !DEVELOPMENT_MODE || false );
define( 'SESSION_HTMLONLY'  , true );

/* friendly reminder */
if (
	APP_SECRET       === 'SUPER SECRET' ||
	PERMISSIONS_SET  === false
	) {
	echo "Please configure the app fully in AppConfig.php, make sure the permissions are set, and that the APP_SECRET is set";
	exit;
}

/* settings for dev mode vs prod */ 
if (DEVELOPMENT_MODE === true 
	&& (!defined('DATABASE_SERVER') 
		 && !defined('DEFAULT_DATABASE'))) {
	define( 'DATABASE_SERVER'   , 'cob-webdev' );  /* database server to connect to   */
	define( 'DEFAULT_DATABASE'  , 'mubusassessment' );  /* database to execute queries on  */
} 
else if (!defined('DATABASE_SERVER') 
	      && !defined('DEFAULT_DATABASE')) {
	define( 'DATABASE_SERVER'   , 'SQLHOST.IATS.MISSOURI.EDU');  /* database server to connect to   */
	define( 'DEFAULT_DATABASE'  , 'mubusassessment' );  /* database to execute queries on  */
}
?>