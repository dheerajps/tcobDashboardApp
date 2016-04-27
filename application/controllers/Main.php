<?php

    /*
     * Main Controller handles the index page
     *
     */

class Main extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index(){

        if($this->session->userdata('logged_in')){
            $memberof = $this->session->userdata('memberOf');
            if (empty($memberof)){
                $this->session->set_flashdata("login-error", "you are not authorized to use this application.");
                redirect('login', 'refresh');
            }
            $procedure="dbo.getadmindashboarddata";
            $query1 = $this->db->query($procedure);
            $data = array(
                'query1' => $query1
            );
            
            $this->load->template('pages/home', $data);
        }else{
            redirect('login', 'refresh');
        }

    }

}