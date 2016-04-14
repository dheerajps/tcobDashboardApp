<?php

define('LDAP_SERVER', 'col.missouri.edu'); // ldap server

/*
function GetPawprintFromName($name) {
    $ldap_connection = ldap_connect(LDAP_SERVER,3268);
    ldap_set_option($ldap_connection,LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_bind($ldap_connection, RSCACCTSSO.'@col.missouri.edu',RSCACCTPASS);
    $filter = '(&(objectClass=user)(cn='.$name.'*))';
    $domain = "dc=edu";
    $search_result = @ldap_search($ldap_connection, $domain, $filter);
    $user_object = @ldap_first_entry($ldap_connection,$search_result);
    $attrs = @ldap_get_attributes($ldap_connection, $user_object);
    //$memberof = $attrs['memberOf'];
    return $attrs['sAMAccountName'][0];//0 is always pawprint
}
*/

function GetUserVerified($pawprint,$password) {

	//this function takes the pawprint and finds the user[s] with a pawprint
	//takes the first entry object and attempts to match it with a password
	//if this fails then the user has failed to log in
	//this is a little backwards since it takes two calls to ldap
	//however this is easily derived into other things since that $user_object
	//contains a heck of a lot of information via ldap_get_attributes

	//it pre-processes the pawprint and password to check for naughtiness
    if (!ctype_alnum($pawprint))
        return false;

	if (preg_match( '/[^A-z0-9(*&)=?|^}\/_>#:-[\052];]~,\[<.]+/', $password ) || strlen($password) < 8 || strlen($password) > 26)
	 	return false;
	$ldap_connection = ldap_connect(LDAP_SERVER,3268);
	ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_bind($ldap_connection, RSCACCTSSO.'@col.missouri.edu',RSCACCTPASS);
	$filter = "(sAMAccountName=$pawprint)";
	$domain = "dc=edu";
	$search_result = @ldap_search($ldap_connection, $domain, $filter);
	$user_object = ldap_first_entry($ldap_connection, $search_result);
	if (empty($user_object)) return false;
	$user_domain = ldap_get_dn($ldap_connection, $user_object);
	$accepted = @ldap_bind($ldap_connection,$user_domain,$password);
	ldap_close($ldap_connection);
	return $accepted;
}
// Actually even this is not used by our project.
/*
function GetRealName($pawprint) {
	//connect and configure ldap
	$ldap_connection = ldap_connect(LDAP_SERVER,3268);
	ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_bind($ldap_connection,RSCACCTSSO.'@col.missouri.edu',RSCACCTPASS);
	//ldap node to start at
	//and filter to find user with that pawprint
	$dn = "dc=edu";
	$filter = "(&(objectClass=user)(sAMAccountName=$pawprint))";

	//search and take first entry
	$searchResult = @ldap_search($ldap_connection, $dn, $filter);
	$ldapEntry = ldap_first_entry($ldap_connection, $searchResult);
	$attrs = ldap_get_attributes($ldap_connection, $ldapEntry);
    $name = ($attrs['cn']);
    $name = $name[0];
    return $name;
}
*/

function AssignUserGroups($pawprint)
{
    //connect and configure ldap
    $ldap_connection = ldap_connect(LDAP_SERVER,3268);
    ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_bind($ldap_connection,RSCACCTSSO.'@col.missouri.edu',RSCACCTPASS);
    //ldap node to start at
    //and filter to find user with that pawprint
    $dn = "dc=edu";
    $filter = "(&(objectClass=user)(sAMAccountName=$pawprint))";

    //search and take first entry
    $searchResult = ldap_search($ldap_connection, $dn, $filter);
    $ldapEntry = ldap_first_entry($ldap_connection, $searchResult);
    //then take that entry's attributes and scan them
    $attrs = ldap_get_attributes($ldap_connection, $ldapEntry);
    $testdn = $attrs['distinguishedName'];
    $newdn=$testdn[0];
  
    $newdn= preg_replace('/\\\\+/', '\\', $newdn);
    

    $connect = new DatabaseHelper;
    $procedure="dbo.getAllGroups";
    $result = $connect->executeStoredProcedure($procedure);
 
    

    /* Create a new empty member array called $member_array */
    /* Push the memberOf attributes into the array for later use in querying the DB */
    $member_array = array();
    
    //Loop through attributes, pushing each into array
    for ($i=0; $i<count($attrs['memberOf']); $i++) {
        
        $property =  $attrs['memberOf'][$i]; //groups the user is a member of
        array_push($member_array, $property);
       
    }
    for($i=0;$i<count($result);$i++)
    {
        $check=$result[$i];
        if((inGroup($ldap_connection,$newdn,$check)===true))
        {
            array_push($member_array,$check);
        }

    } 

    ldap_unbind($ldap_connection);

    return $member_array;
}
function inGroup($ldapConnection, $userDN, $groupToFind) {
    $filter = "(memberof:1.2.840.113556.1.4.1941:=".$groupToFind.")";
    $search = ldap_search($ldapConnection, $userDN, $filter, array("dn"), 1);
    $items = ldap_get_entries($ldapConnection, $search);
    if(!isset($items["count"])) {
        return false;
    }
    return (bool)$items["count"];
}

// THIS PART IS NOT USED BY DASHBOARD PROJECT

/*
function getAllFacStaffPhdUsers() {
    $ldapc = ldap_connect(LDAP_SERVER,3268);	
    ldap_bind($ldapc,RSCACCTSSO.'@col.missouri.edu',RSCACCTPASS);
    $dn = COB_Fac_Staf_Phd;
    $array = getAllGroupsNames($ldapc,$dn,"Group");  
    $members = flattenArray($array);
    $mysize = sizeof($members);
    sort($members);
    $members=array_values(array_unique($members));
    ldap_unbind($ldapc);
    return $members;
}

function getAllGroupsNames($ldap_connection,$distinguishedName, $type){
    $count = 0;
    
    //query top level
    $attributes = array("member", "mail");
    $filter = "(cn=*)"; 
    $search_result=@ldap_search($ldap_connection,$distinguishedName,$filter, $attributes);
    $info = ldap_get_entries($ldap_connection, $search_result);
    
    //if the entry is a User, then return the user's email and name - returned as "Doe, John -- doej@missouri.edu"
    if($type=="User"){
        $pieces= explode("CN",str_replace("\,", ",", str_replace("=", "", $info[0]["dn"])));
        $thename = substr($pieces[1],0,strlen($pieces[0])-1);	
        $person =  $thename. ' -- '.$info[0]["mail"][0];//just return pawprint
        return $person;
    }
    
    //if the entry is a Group, then find all members of the group and send those entries back through this function
    elseif($type=="Group"){
        for($i=0; $i<$info[0]["member"]["count"]; $i++) {
            $totallength    = strlen($info[0]["member"][$i]);
            $OUpos          = strpos($info[0]["member"][$i],",OU=");
            $mygroup        = substr($info[0]["member"][$i],0,$OUpos);
            $OUlength       = strlen($mygroup);
            $ADfolder       = substr($info[0]["member"][$i],$OUpos+1,$totallength-$OUpos);
            $pieces         = explode(",OU",$info[0]["member"][$i]) ;
            $length         = strlen($pieces[0]);
            $mygroups[$i]   = substr($pieces[0],3,$length);
            $pos            = strpos($info[0]["member"][$i],"CN=Users");
            
            //if the member entry is another Group, recursively call this function with that group
            if(!$pos){
                $newarray[$count] = getAllGroupsNames($ldap_connection,$info[0]["member"][$i],"Group");
            }
            //if the member entry is a user, recursively call this function as a user to retrieve email address
            else{
                //go down one more level to get email address
                $thename = getAllGroupsNames($ldap_connection,$info[0]["member"][$i], "User");
                $namearray = $thename;
                $newarray[$count] = $namearray;          
            }
            $count++;
        }
        if($newarray){
            $newarray = array_values($newarray);
        }
        return $newarray;  
    }
}
*/
function flattenArray($array){
    $arrayValues = array();
    foreach ($array as $value){
        if(is_scalar($value) OR is_resource($value)){
            $arrayValues[] = $value;
        }
        elseif (is_array($value)){
            $arrayValues = array_merge($arrayValues, flattenArray($value));
        }
    }
    return $arrayValues;
}

?>