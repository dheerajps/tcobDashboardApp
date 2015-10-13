<?php
require_once(__DIR__.'/../Base/Common.php');

class DashboardHelper {

	// helper which correctly sets up the session when the user logs in
	static function login($username, $password) {
        // check for a clean pawprint
        if (!ctype_alnum($username)) {
            // TODO: make them go somewhere to say they are goofing around
            header( 'Location: '.DEFAULT_PROTOCOL.":".APP_PAGES_PATH."login.php?message=Invalid pawprint and password combination." );
            exit;
        }
        // do some additional cleanup
		$username = chop($username);
		$username = stripslashes($username);
		$password = chop($password);

		// login the user
	    $passwordIsCorrect = GetUserVerified( $username, $password );

        // once logged in assign permissions and other properties
	    if ($passwordIsCorrect) {
            // invalidate previous session id
            // session hijacking/fixation fix - regenerate session id *after* login
            session_regenerate_id(true);

	        $_SESSION['pawprint'] = $username; /* to easily id the user    */
	        $_SESSION['name']     = GetRealName($username); /* display name of the user */
            //$_SESSION['id']       = GetStudentId($username); // id for use with security
	        $_SESSION['RIGHTS']   = AssignUserGroups($username); /* control pages user is allowed to view */

	        // set the session secret specific to this app, this helps prevent logins cross-app
	        $_SESSION['SECRET'] = APP_SECRET;

	        // login succeeded
	        return true;
	    }

	    // login failed
	    return false;
	}

	// helper to direct the user to their landing page based on their rights
	static function sendUserToDefaultPageBasedOnRightsInSession() {

		$userDefaultRouteMap = array(
			"ADMIN_RIGHTS"   => 'Admin.php',
			"CHECKER_RIGHTS" => 'PickEvent.php',
			"STUDENT_RIGHTS" => '../',
			"NO_RIGHTS"      => '../',
            "ACCESS"         => '../'
			);

		// assumes that the session base library has checked that the user is logged in
		$baseOfRedirectURL = DEFAULT_PROTOCOL.":".APP_PAGES_PATH;

		// TODO: test this condition
		if ( !has_presence( $_SESSION['RIGHTS'] ) ) {
			header( 'Location: '.$baseOfRedirectURL."login.php" );
			return;
		} else {
            // the user rights should be set when the user logs in
            header( 'Location: '.$baseOfRedirectURL.$userDefaultRouteMap[ $_SESSION[ 'RIGHTS' ] ] );
            return;
        }

	}

	static function routeUserToCorrectLocationAfterLogin() {
		/* SESSION['Destination'] is set if the user
		tries to skip the login and go to a page inside,
		in this case they are forced to login first, but we
		direct them to their target location after they login */
		if ( has_presence( $_SESSION[ 'Destination' ] ) ) {
            // TODO: Add preg_match for sanitizing - .match(/^[-\w_&=+#]*$/);
            // we could also setup a whitelist of available destinations
            $destination = $_SESSION[ 'Destination' ];
            unset($_SESSION[ 'Destination' ]); // clear
			header( 'Location: '.$destination );
            exit();
		}

		// under regular conditions we route the user to the normal starting location based on their rights
		DashboardHelper::sendUserToDefaultPageBasedOnRightsInSession();
	}

}
?>