<?php
    /*
     *
     * Login Controller
     *
     * Handles authentication and authorization
     * Uses auth_ldap library for authentication and session creation
     *
     *
     */
class Login extends CI_Controller {
    private $data;
    public function __construct() {
        parent::__construct();
        // Load helpers and libraries.
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->library('dashboard_ldap');
        //Load page specific javascript (e.g., login-page.js)
        $this->data = array(
            'js_to_load' => 'login-page.js'
        );
    }

    public function index(){
        if($this->session->userdata('logged_in')){
            redirect('/', 'refresh');
        }else{
            $rules = $this->form_validation;
            $rules->set_rules('user', 'Pawprint', 'required|trim|alpha_dash|xss_clean');
            $rules->set_rules('password', 'Password', 'required|trim|xss_clean');
            if($rules->run()){
                if($this->dashboard_ldap->login($rules->set_value('user'), $rules->set_value('password'))){
                    if(isset($_SESSION['request_uri'])){
                        $request = $_SESSION['request_uri'];
                        unset($_SESSION['request_uri']);
                        redirect($request, 'refresh');
                    } else{
                        redirect('/', 'refresh');
                    }
                }else{
                    redirect('/login', 'refresh');
                }
            }else{
                $this->load->template('pages/login', $this->data);
            }

        }
    }
?>