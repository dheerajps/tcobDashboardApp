<?php
// start app
require_once('/Base/Common.php');
require_once('/Libs/DashboardHelper.php');
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css',
    'index-page.min.css',
    'index-page.min.js',
    'style.css'
));
?>


<div id="breadcrumb">
    <ul class="crumbs2">
        <li class="first"><a href="#" style="z-index:9;"><span></span>Home</a></li>
        <li><a href="/Archive.php" style="z-index:9;">Archive </a></li>
        <li><a href="#" style="z-index:7;">2011 Writing</a></li>
        <li><a href="#" style="z-index:6;">Tips for jQuery Development in HTML5</a></li>
    </ul>
</div>


    <div class="row">
        <div id="dashboard-topics-wrapper" class="col-md-6">
            <div id="dashboard-topics-banner" class="row">
                <br>
                <h2> Dashboard Topics </h2>
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
?>