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

        // once password is authenticated, check if user has viewable dashboards
	    if ($passwordIsCorrect) {

            $userGroups = AssignUserGroups($username);
            $dashboardArray = DashboardHelper::getUrls($userGroups);
            
            
            //If no viewable dashboards, return 2
            if(empty($dashboardArray[0])){
                return 2;
            }

            //If user has dashboards, set all the session data.
            //Set the dashboard array to SESSION['DASHBOARDS'];
            //Programmer can json_encode this session variable and use it to generate dashboard URLs
            else{
                session_regenerate_id(true);
                $_SESSION['usergroups']=$userGroups;
                $_SESSION['pawprint'] = $username; /* to easily id the user    */
                //$_SESSION['name']     = GetRealName($username); /* display name of the user */
                $_SESSION['SECRET'] = APP_SECRET;
                $_SESSION['ACCESS'] = 'ACCESS';
                $_SESSION['DASHBOARDS'] = $dashboardArray;
                return 0; //return 0
            }
	    }

	    // login failed; return 1
	    return 1;
	}

	// helper to direct the user to their landing page based on their rights
	static function sendUserToDefaultPageBasedOnRightsInSession() {

		$userDefaultRouteMap = array(
			//"ADMIN_RIGHTS"   => 'Admin.php',
			//"CHECKER_RIGHTS" => 'PickEvent.php',
			//"STUDENT_RIGHTS" => '../',
			//"NO_RIGHTS"      => '../',
            "ACCESS"         => '../'
			);

		// assumes that the session base library has checked that the user is logged in
		$baseOfRedirectURL = DEFAULT_PROTOCOL.":".APP_PAGES_PATH;

		// TODO: test this condition
		if ( !has_presence( $_SESSION['ACCESS'] ) ) {
			header( 'Location: '.$baseOfRedirectURL."login.php" );
			return;
		} else {
            // the user rights should be set when the user logs in
            header( 'Location: '.$baseOfRedirectURL.$userDefaultRouteMap[ $_SESSION[ 'ACCESS' ] ] );
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

    /* 
     * Function used to grab dashboards from database
     * Takes in an array of group_ids
     * Returns an array of database results.
     */
    static function getUrls($groups){
        $connect = new DatabaseHelper; //Connect to db * TODO: What if cannot connect?

        /* The name of the stored procedure being used.
         * See /../Database Scripts/dashboardProcedures.sql
         */
        $procedure = "dbo.getDashboardData";

        /* 
         * Breaks up the groups array into a string to use it in the stored procedure's IN operator
         */
        $in_str = "'".implode("', '", $groups)."'";

        /*
         * Execute procedure. Set results equal to $result. Return that. We'll check if empty elsewhere 
         */
        $result = $connect->executeStoredProcedure($procedure, [$in_str]);

        return $result;
    }

}
?>