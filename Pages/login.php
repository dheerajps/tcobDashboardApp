<?php
require_once(__DIR__.'/../Base/Common.php');
require_once(__DIR__.'/../Libs/DashboardHelper.php');

if (has_presence($_POST['submit'])) {
    /* the DashboardHelper logs in the user by setting up the session, if
    the user is in no groups specific to pdp, then RIGHTS = NO_RIGHTS,
    see DashboardHelper.php in Libs for more code */
    $loggedIn = DashboardHelper::login( $_POST['user'], $_POST['password'] );
    if (!$loggedIn) {
        logger('SECURITY', h($_POST['user']).' login failed');
        header('Location: login.php?message=Invalid pawprint and password combination.');
        exit();
    }
    /* NO_RIGHTS would be set in DashboardHelper::login if user has no rights */
    else if ($_SESSION['RIGHTS'] === 'NO_RIGHTS') {
        header('Location: login.php?message=User is unauthorized to use this application.');
        exit();
    }
    
    logger('SECURITY', h($_POST['user']).' login success');
    
    /* sends the user to their dash based on their rights */
    DashboardHelper::routeUserToCorrectLocationAfterLogin();
}

// load header
TSTemplate::header(array(
    'base.min.css',
    'app.min.css',
    'login-page.min.css',
    'login-page.min.js'
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