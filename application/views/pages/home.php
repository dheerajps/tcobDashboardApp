<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <?php
            if($this->session->flashdata("success") != NULL){

                echo "<div class='alert alert-success'>";
                echo "\t<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                echo $this->session->flashdata("success");
                echo "</div>";
            }
            ?>
            <h1>Home</h1>
            
            <h2>Templates</h2>
            <ul>
                <li>
                    <a href="dashboard">Summary/Dashboard view</a>
                </li>
            </ul>
            
        </div>
    </div>
</div>