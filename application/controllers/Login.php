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
    //Default function call; renders header, login view, and footer
    //Passing in page-specific javascript
    public function index(){
        if($this->session->userdata('logged_in')){
            redirect('/', 'refresh');
        }
        $this->load->template('pages/login', $this->data);
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
                //If user is requesting a page before logging in, store it and point user to it later
                if(isset($_SESSION['request_uri'])){
                    $request = $_SESSION['request_uri'];
                    unset($_SESSION['request_uri']);
                    redirect($request, 'refresh');
                } else{
                    redirect('/', 'refresh');
                }
            }else {
                // Login FAIL
                redirect('/login', 'refresh');
            }
        }else {
            // Already logged in...
            redirect('/', 'refresh');
        }
    }
}
?>