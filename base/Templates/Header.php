<!doctype html>
<html class="no-js" lang="en">
<head id="apps-business-missouri-edu" data-template-set="html5-reset">
    <meta charset="utf-8" />
    <meta content='True' name='HandheldFriendly' />
    <meta content='width=device-width, initial-scale=1.0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="title" content="PDP Point Tracker" />
    <meta name="description" content="Student Point Tracker for the Trulaske College of Business" />
    <meta name="Copyright" content="Copyright <?php echo date('Y'); ?> Curators of the University of Missouri. All Rights Reserved." />
    <meta name="DC.title" content="<?php echo APP_TITLE ;?>" />
    <title><?php echo APP_TITLE ;?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo APP_RESOURCE_PATH ;?>images/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?php echo APP_RESOURCE_PATH ;?>images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo APP_RESOURCE_PATH ;?>images/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo APP_RESOURCE_PATH ;?>images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo APP_RESOURCE_PATH ;?>images/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo APP_RESOURCE_PATH ;?>images/manifest.json">
    <link rel="shortcut icon" href="<?php echo APP_RESOURCE_PATH ;?>images/favicon.ico?v3">
    <meta name="apple-mobile-web-app-title" content="PDP Points Tracker">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-TileImage" content="/pdp-attendance/resources/images/mstile-144x144.png">
    <meta name="msapplication-config" content="/pdp-attendance/resources/images/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Adding the dependencies for Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<?php
// load css first
foreach ($css as $link) {
	echo "\t<link rel='stylesheet' type='text/css' href='$link' />\n";
}
// add dev css
if (DEVELOPMENT_MODE === true) {
    echo "\t<link rel='stylesheet' type='text/css' href='" . APP_RESOURCE_PATH . "css/dev.css' />\n";
}
?>

    <script src="<?php echo APP_RESOURCE_PATH ;?>js/jquery-1.11.2.min.js"></script>
<?php
// load up javascript
foreach ($js as $link) {
	echo "\t<script src='$link' ></script>\n";
}
// add dev js
if (DEVELOPMENT_MODE === true) {
    echo "\t<script src='" . APP_RESOURCE_PATH . "js/dev.min.js'></script>\n";
}
?>
        <!--[if lt IE 9]>
		    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body>
        <div id="bg">
            <img src="<?php echo APP_BASE_URL; ?>Resources/images/bg/bg.jpg" alt="Page Background" />
        </div>
<?php
//echo '<div class="debug">SESSION [' . session_id() . ']: ';
//print_r($_SESSION);
//echo '</div>';
?>
    <div id="page">        
	    <a id="header-link" href="<?php echo APP_BASE_URL; ?>" style="text-decoration: none;">
	    <div id="header">
	        <div id="app-title">
                <?php echo APP_TITLE ;?>
                <span><?php echo APP_CAPTION ;?></span>
	        </div>
	    </div>
	    </a>
        <div id="content">