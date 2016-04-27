<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
    <?php
    if($this->session->flashdata("login-error") != NULL || validation_errors() != NULL){
        echo "<div class='alert alert-danger'>";
        echo "\t<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        echo "\t".$this->session->flashdata("login-error");
        echo "\t".validation_errors();
        echo "</div>";
    }
    $attributes = array('class' => 'form-horizontal');
    echo form_open('login/verifylogin', $attributes);
    ?>
    <h1>Login</h1>
    <div class="form-group">
        Please enter your pawprint and password to access this application.
    </div>
    <div class="form-group">
        <label for="user" class="control-label">Pawprint</label>
        <input name="user" class="form-control" id="user" type="text" value="<?php echo set_value('user');?>">
    </div>
    <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <input name="password" class="form-control" id="password" type="password" autocomplete="off" value="<?php echo set_value('password');?>">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Login</button>
    </div>
    <?php echo form_close(); ?>
</div>