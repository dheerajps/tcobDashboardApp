<?php
// Load all required content and helpers
require_once(__DIR__.'/../Base/Common.php');
require_once(__DIR__.'/../Libs/DashboardHelper.php');

// load header
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css',
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"
));
?>



<?php
TSTemplate::footer();
?>