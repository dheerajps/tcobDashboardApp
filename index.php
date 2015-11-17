<?php
// start app
require_once('./Base/Common.php');
require_once('./Libs/DashboardHelper.php');
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css',
    'index-page.min.css',
    'index-page.min.js'
));
// Changes made to the database when a user is logged in is reflected on page refresh, instead of logging back in again.
session_start();
if (!isset($_SESSION["visits"]))
{
    $_SESSION["visits"] = 0;
    $count=0;
}
$_SESSION["visits"] += 1;
$count+=1;
if ($_SESSION["visits"] > 1)
{
    unset($_SESSION["visits"]);
    $userGroups=$_SESSION['usergroups'];
    unset($_SESSION['DASHBOARDS']);
    $dashboardArrayAgain = DashboardHelper::getUrls($userGroups);
    $_SESSION['DASHBOARDS'] = $dashboardArrayAgain;
    
}
function convertNameToId($inputText) {
    $lowerCase = strtolower($inputText);
    $output = str_replace(" ", "-", $lowerCase);
    return $output;
}

function createSections($db, $topicNameArray) {
  $allSections = array();
    $returnString = '';
    foreach($topicNameArray as $val){
      $allSections[$val] = array();
        for ($i = 0 ; $i < count($db) ; $i++){
            if ($db[$i]->topic_name == $val) {
                $sectionName = $db[$i]->section_name;
                $url_name = $db[$i]->url_name;
                $url_address = $db[$i]->url_address;
                $allSections[$val][$sectionName][$url_name] = $url_address;             
            }

        }
        $returnString .= "<div id='".convertNameToId($val)."' class='dashboard-sections-wrapper-wrapper'>";
        $returnString .=  "\n\t<div class='dashboard-sections-wrapper panel-group accordion' id='".convertNameToId($val)."-accordion'>";
        foreach($allSections[$val] as $key => $value) {

            $sections = "<div class='panel panel-default'>".
                        "<div class='panel-heading'>".
                        "<a data-toggle='collapse' data-parent='#".convertNameToId($val)."-accordion' href='#".convertNameToId($val)."-".convertNameToId($key)."' class='nav-buttons btn section-buttons panel-title' title='".$key."'>".$key."</a>".
                        "</div>".
                        "<div id='".convertNameToId($val)."-".convertNameToId($key)."' class='panel-collapse collapse'>".
                        "<div class='panel-body'>".
                        "<ul class='nav nav-pills nav-stacked dashboards'>";
            $dashboards = '';
            $closers = "</ul></div></div></div>";
            foreach($allSections[$val][$key] as $url_name => $values){
                $dashboards .= "<li role='presentation' class='dashboard-button'><a href='#' val='".$values."'>".$url_name."</a></li>";
            }
            $returnString .= $sections.$dashboards.$closers;
        }
        $returnString .= "</div>\n</div>";
    }
    return $returnString;
}
?>
    <div class="row" id="menu-nav">
        <div class="col-md-6 col-sm-6 col-xs-12 dashboard-wrapper" id="topics">
            <ul class="nav nav-pills nav-stacked" id="dashboard-topics">
                <?php
                    $db = $_SESSION['DASHBOARDS'];
                    $sizeOf = count($db) - 1;
                    $topicNameArray = array();
                    $i = 0;
                    echo "<li class='nav-buttons-wrapper'><a class='nav-buttons btn topic-buttons' title='".$db[$i]->topic_name."'>".$db[$i]->topic_name."</a></li>";
                    array_push($topicNameArray, $db[$i]->topic_name);
                    while($i < $sizeOf){
                        $i++;
                        $j = $i - 1;
                        if($db[$i]->topic_name != $db[$j]->topic_name){
                            echo "<li class='nav-buttons-wrapper'><a class='nav-buttons btn topic-buttons' title='".$db[$i]->topic_name."'>".$db[$i]->topic_name."</a></li>";
                            array_push($topicNameArray, $db[$i]->topic_name);
                        }
                    }
                    $tNameArraySize = count($topicNameArray);
                ?>
            </ul>
        </div>
        <div id='sections-list' class='col-md-6 col-sm-6 col-xs-12 dashboard-wrapper'>
            <div id='no-topics' class='well'>
                <h5>Select a topic from the list in order to show a list of sections</h5>
            </div>
        <?php
        print_r(createSections($db, $topicNameArray));
        ?>
        </div>
    </div>
    <div id="cyfe-display" class="col-md-12 col-sm-12 col-xs-12">
        <iframe id="cyfe-iframe"></iframe>
    </div>

<?php
TSTemplate::footer();
?>