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
    <div class="row" id="menu-nav">
        <div class="col-md-6 col-sm-6 col-xs-12 dashboard-wrapper">
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
        <div id="sections-list strategic-initiative" class="col-md-6 col-sm-6 col-xs-12 dashboard-wrapper">
            <div id="no-topics" class="well">
                <h5>Select a topic from the list in order to show a list of sections</h5>
            </div>
            <div class="dashboard-sections-wrapper panel-group" id="accordion">
                <?php
                    // Prints out all sections and dashboards for each topic
                    for ($i = 1; $i <= 10; $i++) {
                        $sections = "<div class='panel panel-default'>".
                                        "<div class='panel-heading'>".
                                            "<a data-toggle='collapse' data-parent='#accordion' href='#Section".$i."' class='nav-buttons btn section-buttons panel-title' title='Section ".$i."'>Section ".$i." is going to be very long to check that the ellipsis thing is working</a>".
                                        "</div>".
                                        "<div id='Section".$i."' class='panel-collapse collapse'>".
                                            "<div class='panel-body'>".
                                                "<ul class='nav nav-pills nav-stacked dashboards'>";
                        $dashboards = '';
                        $closers = "</ul></div></div></div>";
                        for ($j = 1; $j <= 5; $j++) {
                            $dashboards .= "<li role='presentation' class='dashboard-button'><a href='dashboard".$j."'>Section ".$i." --- Dashboard ".$j."</a></li>";
                        }
                        echo $sections.$dashboards.$closers;
                    }               
                ?>
            </div>
        </div>
    </div>
    <div id="cyfe-display" class="col-md-12 col-sm-12 col-xs-12">
        <iframe id="cyfe-iframe"></iframe>
    </div>

<?php
TSTemplate::footer();
?>