<?php

    /*
     * convertNameToId
     * Takes in a string
     * Returns a string, lower-case, stripped of white-space (with - in lieu of)
     */
    function convertNameToId($inputText) {
        $lowerCase = strtolower($inputText);
        $output = str_replace(" ", "-", $lowerCase);
        return $output;
    }

    /*
     * stripWhiteSpaces
     * Takes in a string
     * Returns a string, lower-case, stripped of white-space
     */
    function stripWhiteSpaces($string){
        $lc = strtolower($string);
        $out = str_replace(' ', '', $lc);
        return $out;
    }

    //Show flash success message if exists. Usually used for login notification
    if($this->session->flashdata("success") != NULL){

        echo "<div id='login-success-alert' class='alert alert-success'>";
        echo "\t<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        echo $this->session->flashdata("success");
        echo "</div>";
    }

    //Set up a topic name and section name array for later use.
    $topicNameArray = array();
    $sectionNameArray = array();
    //Get the SQL search results from $query object that has been passed from controller/lib, use to iterate
    $query_result = $query->result();

    //Populating the topic name array. This is used to grab topic names from entire return results.
    array_push($topicNameArray, $query_result[0]->topic_name);

    //Iterate rest of results, continue storing topic name
    foreach($query_result as $iter){
        if(array_search($iter->topic_name, $topicNameArray) === false){
            array_push($topicNameArray, $iter->topic_name);
        }
    }

    //We're looping through the results to build our links.
    //This is wonky and complicated. Hope you don't have to work on it.
    //Essentially, we're building topics, with sections under it, with dashboards under those.
    //Have to build the arrays to do that.
    $allSections = array();
    $returnString = '';
    foreach($topicNameArray as $val){
        $allSections[$val] = array();
        for ($i = 0 ; $i < count($query_result) ; $i++){
            if ($query_result[$i]->topic_name == $val) {
                $sectionName = $query_result[$i]->section_name;
                $url_name = $query_result[$i]->url_name;
                $url_address = $query_result[$i]->url_address;
                $allSections[$val][$sectionName][$url_name] = $url_address;             
            }

        }
        $returnString .= "<div id='".convertNameToId($val)."' class='dashboard-sections-wrapper'>";
        $returnString .=  "\n\t<div class='dashboard-sections-list panel-group accordion' id='".convertNameToId($val)."-accordion'>";    
        foreach($allSections[$val] as $key => $value) {
            $sections = "<div class='panel panel-default'>".
                            "<div class='panel-heading'>".
                            "<a data-toggle='collapse' data-parent='#".convertNameToId($val)."-accordion' data-target='#".convertNameToId($val)."-".convertNameToId($key)."' class='nav-buttons btn section-buttons panel-title' title='".$key."'>".$key."</a>".
                            "</div>".
                            "<div id='".convertNameToId($val)."-".convertNameToId($key)."' class='panel-collapse collapse'>".
                            "<div class='panel-body'>".
                            "<ul class='nav nav-pills nav-stacked dashboards'>";
            $dashboards = '';
            $closers = "</ul></div></div></div>";
            foreach($allSections[$val][$key] as $url_name => $values){
                $dashboards .= "<li role='presentation' class='dashboard-button'><a href='#' id='".stripWhiteSpaces($url_name)."' val='".$values."'>".$url_name."</a></li>";
            }
            $returnString .= $sections.$dashboards.$closers;
        }
        $returnString .= "</div>\n</div>";
    }


?>

    <div id="menu" class="row">
        <div id="topics" class="col-md-6 col-sm-6 col-xs-12">
            <ul class="nav nav-pills nav-stacked" id="dashboard-topics">
                <?php
                    foreach($topicNameArray as $t){
                        echo "<li class='nav-buttons-wrapper'><a class='nav-buttons btn topic-buttons ".convertNameToId($t)."' title='".$t."'>".$t."</a></li>";
                    }
                ?>
            </ul>
        </div>
        <div id="sections-list" class="col-md-6 col-sm-6 col-xs-12">
            <div id="no-topics" class="well">
                <h5>Select a topic from the list in order to show a list of sections</h5>
            </div>
            <?php
            print_r($returnString);
            ?>
        </div>
    </div>
<div id="cyfe-display" class="col-md-12 col-sm-12 col-xs-12">
</div>
</div>
</div>
</div>
</div>