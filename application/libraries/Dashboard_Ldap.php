<?php
/**
 * Dashboard_Ldap
 *
 * Extending Auth_Ldap
 * Overriding functions login() and _authenticate() to perform specialized dashboard functions
 *
 * @version 1.0
 * @author cwm262
 */

include('Auth_Ldap.php');

class Dashboard_Ldap extends Auth_Ldap
{

    function __construct() {
        parent::__construct();
    }

    function login($username, $password) {

        //Call _authenticate username, password; Set return to user_info
        $user_info = $this->_authenticate($username,$password);

        if($user_info === NULL){
            return NULL;
        }

        // Record the login
        $this->_audit("Successful login: ".$user_info['cn']."(".$username.") from ".$this->ci->input->ip_address());

        // Set the session data
        $customdata = array('username' => $username,
                            'cn' => $user_info['cn'],
                            'dn' => $user_info['dn'],
                            'memberOf' => $user_info['memberOf'],
                            'logged_in' => TRUE);

        $this->ci->session->set_userdata($customdata);

        return TRUE;
    }

    private function _authenticate($username, $password) {

        $this->ldapconn = ldap_connect($this->host, $this->port);

        if(! $this->ldapconn) {
            $this->_audit("Error: Could not make a connection to ldap given host and port.");
            $this->ci->session->set_flashdata("login-error", "There was a problem connecting to the login system. Please contact hogansa@missouri.edu");
            return NULL;
        }

        ldap_set_option($this->ldapconn, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($this->ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($this->proxy_user) {
            $bind = ldap_bind($this->ldapconn, $this->proxy_user.'@'.$this->host, $this->proxy_pass);
        }else {
            $bind = ldap_bind($this->ldapconn);
        }

        if(!$bind){
            $this->ci->session->set_flashdata("login-error", "There was a problem connecting to the login system. Please contact hogansa@missouri.edu");
            $this->_audit("Error: Could not connect to ldap with given proxy user name and pass.");
            return NULL;
        }

        $filter = '('.$this->login_attribute.'='.$username.')';
        $search = ldap_search($this->ldapconn, $this->basedn, $filter);
        $entries = ldap_get_entries($this->ldapconn, $search);
        $binddn = $entries[0]['dn'];

        // Now actually try to bind as the user
        $bind = ldap_bind($this->ldapconn, $binddn, $password);
        if(! $bind) {
            $this->ci->session->set_flashdata("login-error", "Sorry. Either your pawprint or your password was incorrect.");
            $this->_audit("Failed login attempt: ".$username." from ".$_SERVER['REMOTE_ADDR']);
            return NULL;
        }

        $cn = $entries[0]['cn'][0];
        $dn = stripslashes($entries[0]['dn']);
        $id = $username;
        $memberOf = $entries[0]['memberof'];

        //can use this to determine authorization and access-level in future
        //$get_role_arg = $id;

        return array('cn' => $cn, 'dn' => $dn, 'id' => $id, 'memberOf' => $memberOf);
    }



}