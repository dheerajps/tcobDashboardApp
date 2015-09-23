<?php
// Load all required content and helpers
require_once(__DIR__.'/../Base/Common.php');
require_once(__DIR__.'/../Libs/DashboardHelper.php');

// load header
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css',
    'index-page.min.css',
    'index-page.min.js'
));
?>
    <div class="row">
        <div id="dashboard-topics-wrapper" class="col-md-6">
            <div id="dashboard-topics-banner" class="row">
                <h1> Dashboard Topics </h1>
            </div>
            <ul class="nav nav-pills nav-stacked" id="dashboard-topics">
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn">Business Things</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn">Other Business</a></li>
            </ul>
        </div>
    </div>


<?php
TSTemplate::footer();
?>