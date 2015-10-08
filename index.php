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


<!--<div id="breadcrumb">
    <ul class="crumbs2">
        <li class="first"><a href="#" style="z-index:9;"><span></span>Home</a></li>
        <li><a href="/Archive.php" style="z-index:9;">Archive </a></li>
        <li><a href="#" style="z-index:7;">2011 Writing</a></li>
        <li><a href="#" style="z-index:6;">Tips for jQuery Development in HTML5</a></li>
    </ul>
</div>-->


    <div class="row" id="menu-nav">
        <div class="col-md-6 col-xs-6 dashboard-wrapper">
            <div class="row dashboard-banner">
                <br>
                <h2> Dashboard Topics </h2>
            </div>
            <ul class="nav nav-pills nav-stacked" id="dashboard-topics">
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">Business Things</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">Other Business</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">This one Topic</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">This is Another One</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">Wow look Another One</a></li><li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">So Many Topics</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">This is Just Crazy</a></li><li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons">Strategic Initiative</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="example">I don't have names</a></li>
                <li class="nav-buttons-wrapper"><a class="nav-buttons btn topic-buttons" title="This is the Last One but it is going to be really long to check things">This is the Last One but it is going to be really long to check things</a></li>
            </ul>
        </div>
        <div id="sections-list" class="col-md-6 col-xs-6 dashboard-wrapper">
            <div class="row dashboard-banner">
                <br>
                <h2> Section Topics </h2>
            </div>
            <div id="no-topics" class="well">
                <h5>Select a topic from the list on the left in order to show a list of sections</h5>
            </div>
            <div class="dashboard-sections-wrapper panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#Section1" class="nav-buttons btn section-buttons panel-title" title="Section 1">Section 1 is going to be very long to check that the ellipsis thing is working</a>
                    </div>
                    <div id="Section1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class='nav nav-pills nav-stacked dashboards'>
                                <li role='presentation' class='dashboard-button'><a href='#'>This one</a></li>
                                <li role='presentation' class='dashboard-button'><a href='#'>That one</a></li>
                                <li role='presentation' class='dashboard-button'><a href='#'>These ones</a></li>
                                <li role='presentation' class='dashboard-button'><a href='#'>Those one</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" class="nav-buttons btn section-buttons" title="Section 2" data-toggle="collapse" data-parent="#accordion" href="#Section2">Section 2</a>
                        </h4>
                    </div>
                    <div id="Section2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class='nav nav-pills nav-stacked dashboards'>
                                <li role='presentation' class='dashboard-button'><a href='#'>This one</a></li>
                                <li role='presentation' class='dashboard-button'><a href='#'>That one</a></li>
                                <li role='presentation' class='dashboard-button'><a href='#'>These ones</a></li>
                                <li role='presentation' class='dashboard-button'><a href='#'>Those one</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TO DO: Add a loading spinner for when the AJAX call is processing -->
    <div id="cyfe-display" class="col-md-12 col-xs-12"><iframe id="cyfe-iframe"></iframe></div>




<?php
TSTemplate::footer();
?>