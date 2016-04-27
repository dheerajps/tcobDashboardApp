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
    public function __construct() {
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        //Load the ldap library
        $this->load->library('dashboard_ldap');
        //Load security library
        $this->load->helper('security');
    }
    //Default function call; renders header, login view, and footer
    public function index(){
        $this->load->template('pages/login');
    }
    //VerifyLogin function is called when submit is pressed on login page ;;
    //Authenticates user with LDAP; redirects them to home if authenticated; redirects
    //them back to login if not
    public function verifyLogin(){
        if($this->session->userdata('logged_in') === NULL) {
            // Set up rules for form validation
            $rules = $this->form_validation;
            $rules->set_rules('user', 'Pawprint', 'required|trim|alpha_dash|xss_clean');
            $rules->set_rules('password', 'Password', 'required|trim|xss_clean');
            // Do the login...
            if($rules->run() && $this->dashboard_ldap->login(
                    $rules->set_value('user'),
                    $rules->set_value('password'))) {
                // Login WIN!
                $this->session->set_flashdata("success", "You have successfully logged in.");
                redirect('/', 'refresh');
            }else {
                // Login FAIL
                $this->load->template('pages/login');
            }
        }else {
            // Already logged in...
            redirect('/', 'refresh');
        }
    }
}
?>