<?php

    /*
     * Handles LogOut functionality
     *
     */

class Logout extends CI_Controller
{
    //Logout the user
    public function index(){

        //Get userData from session
        //$userData = $this->session->all_userdata();
        ////Unset the userData
        //$this->session->unset_userdata($userData);
        $this->session->userdata = array();
        //Destroy the session
        session_destroy();
        //Redirect to login
        redirect('login', 'refresh');

    }
}