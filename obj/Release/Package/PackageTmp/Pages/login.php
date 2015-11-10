<?php
require_once(__DIR__.'/../Base/Common.php');
require_once(__DIR__.'/../Libs/DashboardHelper.php');

if (has_presence($_POST['submit'])) {

    //Call function login in DashboardHelper to process login.
    //Will return either a 0, 1 or 2
    $loggedIn = DashboardHelper::login( $_POST['user'], $_POST['password'] );
 
    switch($loggedIn){
        //If function login returns a 1, redirect user back to login with Invalid pawpring msg
        case 1:
            header('Location: login.php?message=Invalid pawprint and password combination.');
            break;
        //If login returns a 2, redirect user to login with a not authorized message
        case 2:
            header('Location: login.php?message=User is not authorized to use this application.');
            break;
        //If login returns a 0, redirect user to index. 
        case 0:
            header('Location: ./../');
            logger('SECURITY', h($_POST['user']).' login success');
            break;
        default:
            header('Location: login.php?message=Invalid pawprint and password combination.');
            break;
    }
}

// load header
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css'
));
?>
<h1>Login</h1>
<p>Enter your pawprint and password to access the system.</p>
<form method="POST" id="login">
    <p class="error"><?php if (has_presence($_GET['message'] )) { echo h($_GET['message']); } ?></p>
    <label for="user">
        Pawprint
    </label>
    <div>
        <input name="user" id="user" type="text" required></div>
    <label for="password">
        Password
    </label>
    <div>
        <input name="password" id="password" type="password" autocomplete="off" required></div>
    <input type="submit" id="submit" name="submit" value="Login">
</form>
<?php
    TSTemplate::footer();
?>