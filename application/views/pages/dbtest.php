
<?php
    foreach($query1->result() as $row){
        echo "<div>";
        echo "<p>Group Name: " . $row->group_name . "</p>\n";
        echo "<p>Group ID: " . $row->group_id . "</p>\n";
        echo "</div>\n<br>";
    }
    echo "Total results: " . $query1->num_rows();

    echo "<br><br><hr>";

    $query2Row = $query2->row();
    echo "<div>";
    echo "<p>URL ID: " . $query2Row->url_id . "</p>\n";
    echo "<p>URL Name: " . $query2Row->url_name . "</p>\n";
    echo "<p>URL Address: " . $query2Row->url_address . "</p>\n";
    echo "</div>";

    echo "<br><br><hr>";

    foreach($query3->result() as $row){
        echo "<div>";
        echo "<p>Topic Name: " . $row->topic_name . "</p>\n";
        echo "<p>Topic ID: " . $row->topic_id . "</p>\n";
        echo "</div>\n<br>";
    }

    echo "<br><br><hr>";

    foreach($query4->result() as $row){
        echo "<div>";
        echo "<p>Group ID: " . $row->group_id . "</p>\n";
        echo "</div>\n<br>";
    }

    echo "<br><br><hr>";

    echo $query5->num_rows();

    print_r($query5);

?>
