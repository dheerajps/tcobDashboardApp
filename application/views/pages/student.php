<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            
            <?php
            if($this->session->flashdata("success") != NULL){

                echo "<div class='alert alert-success'>";
                echo "\t<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                echo $this->session->flashdata("success");
                echo "</div>";
            }
            ?>
            <br>
            <ul class="nav nav-tabs nav-tabs" role="tablist">
                <li class="active"><a href="#active" role="tab" data-toggle="tab">General</a></li>
                <li><a href="#education" role="tab" data-toggle="tab">Education & Test Scores</a></li>
                <li><a href="#program" role="tab" data-toggle="tab">Program & Dissertation</a></li>
                <li><a href="#discipline" role="tab" data-toggle="tab">Discipline</a></li>
                <li><a href="#log" role="tab" data-toggle="tab">Activity Log</a></li>
            </ul>
            
            <h1>Doe, John A.</h1>
                        
           
        </div>
    </div>
</div>

<script>
    $(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});
</script>