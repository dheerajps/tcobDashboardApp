<?php
// start app
require_once('Base/Common.php');
require_once('Libs/PDPHelper.php');
PDPHelper::sendUserToDefaultPageBasedOnRightsInSession();
?>