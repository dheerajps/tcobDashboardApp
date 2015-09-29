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
        <div class="col-md-6 dashboard-wrapper">
            <div class="row dashboard-banner">
                <br>
                <h2> Dashboard Topics </h2>
            </div>
            <ul class="nav nav-pills nav-stacked" id="dashboard-topics">
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Business Things</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Other Business</a></li>
                <li class="nav-buttons-wrapper this"><a class="nav-buttons btn topic-buttons">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Business Things</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Other Business</a></li><li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Business Things</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Other Business</a></li><li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Business Things</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Other Business</a></li>
            </ul>
        </div>
        <div id="sections-list" class="col-md-6 dashboard-wrapper">
            <div class="row dashboard-banner">
                <br>
                <h2> Section Topics </h2>
            </div>
            <div id="no-topics" class="well">
                <h5>Select a topic from the list on the left in order to show a list of sections</h5>
            </div>
            <div class="dashboard-sections-wrapper">
                <ul class="nav nav-pills nav-stacked dashboard-sections">
                    <li class="nav-buttons-wrapper"><a class="nav-buttons btn section-buttons">Section 1</a></li>
                    <li class="nav-buttons-wrapper"><a class="nav-buttons btn section-buttons">Section 2</a></li>
                    <li class="nav-buttons-wrapper"><a class="nav-buttons btn section-buttons">Section 3</a></li>
                </ul>
            </div>
        </div>
    </div>




<?php
TSTemplate::footer();
?>