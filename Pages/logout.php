<?php
require_once(__DIR__.'/../Libs/DashboardHelper.php');

// initialize the session
session_start();

// assign local variable
$pawprint = $_SESSION['pawprint'];

// use both for max compat -- browser and php
session_unset();
session_destroy();

// log the event
logger('SECURITY', h($pawprint).' logged out');

// send user to login page
DashboardHelper::sendUserToDefaultPageBasedOnRightsInSession();
?>