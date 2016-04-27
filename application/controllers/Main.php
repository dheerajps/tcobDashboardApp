<?php

    /*
     * Main Controller handles the index page
     *
     */

class Main extends CI_Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){

        if($this->session->userdata('logged_in')){
            $this->load->template('pages/home');
        }else{
            redirect('login', 'refresh');
        }

    }

}