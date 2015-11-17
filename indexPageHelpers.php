<?php
/* This file contains all php helpers for the index page.  The functions here are required for the index.php page to work
 * 
 * Functions:
 * - convertNameToId
 * - createSections
 * - createTopics
 * 
 */


// converts a string into the format that we use for class names and id names
// arg[0] = a string
function convertNameToId($inputText) {
    $lowerCase = strtolower($inputText);
    $output = str_replace(" ", "-", $lowerCase);
    return $output;
}

// Takes all of the dashboards for a user, and creates the template for all of the dashboards.  Generates the html for the dashboards
// arg[0] = the session variable containing the json of all dashboards for the user 
// arg[1] = an array of all topic names 
function createSections($topicNameArray) {
    $db = $_SESSION['DASHBOARDS'];
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
        $returnString .= "<div id='".convertNameToId($val)."' class='dashboard-sections-wrapper'>";
        $returnString .=  "\n\t<div class='dashboard-sections-list panel-group accordion' id='".convertNameToId($val)."-accordion'>";
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

// Uses the session variable in order to print off all topics and create an array of all topic names 
function createTopics () {
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

    return $topicNameArray;
}
?>