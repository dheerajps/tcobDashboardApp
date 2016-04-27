<?php

    /*
     * Main Controller handles the student page
     *
     */

class Student extends CI_Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){

        if($this->session->userdata('logged_in')){
            $this->load->template('pages/student');
        }else{
            redirect('login', 'refresh');
        }

    }

}