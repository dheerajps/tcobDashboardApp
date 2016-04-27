<?php

    /*
     * Main Controller handles the index page
     *
     */

class Dashboard extends CI_Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){

        if($this->session->userdata('logged_in')){
            $this->load->template('pages/dashboard');
        }else{
            redirect('login', 'refresh');
        }

    }

}