<?php
// start app
require_once('./Base/Common.php');
require_once('./Libs/DashboardHelper.php');
require_once('./indexPageHelpers.php');
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css',
    'index-page.min.css',
    'index-page.min.js'
));
reloadDashboards();
?>

    <div id="menu" class="row">
        <div id="topics" class="col-md-6 col-sm-6 col-xs-12">
            <ul class="nav nav-pills nav-stacked" id="dashboard-topics">
                <?php // Generates all topics for the user from the session variable
                $topicNameArray = createTopics(); 
               // sometimes visual studios thinks these php functions are "unknown" when they actually are 
                ?>
            </ul>
        </div>
        <div id='sections-list' class='col-md-6 col-sm-6 col-xs-12'>
            <div id='no-topics' class='well'> <!-- this shows ONLY when a topic is not selected -->
                <h5>Select a topic from the list in order to show a list of sections</h5>
            </div>
        <?php
        // Populates the list of sections and dashboards for each topic
        print_r(createSections($topicNameArray)); 
        ?>
        </div>
    </div>
    <div id="cyfe-display" class="col-md-12 col-sm-12 col-xs-12">
        <iframe id="cyfe-iframe"></iframe>
    </div>

<?php
TSTemplate::footer();
?>