<?php
// start app
require_once('Base/Common.php');
require_once('Libs/DashboardHelper.php');
DashboardHelper::sendUserToDefaultPageBasedOnRightsInSession();
?>