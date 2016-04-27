<table class="table">
    <thead>
        <tr>
            <th>Test Name</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>

<?php
foreach($results as $row){
    echo "\t\t<tr>\n";
    echo "\t\t\t<td>".$row['Test Name']."</td>\n";
    echo "\t\t\t<td>".$row['Result']."</td>\n";
    echo "\t\t</tr>\n";
}
?>
    </tbody>
</table>
