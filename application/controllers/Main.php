<?php
    /*
     * Main Controller handles the index page
     *
     */
class Main extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        //Connect to database. Uses settings in application/config/database.php
        $this->load->database();
    }
    public function index(){
        //If user is logged in, do this, else, grab their request URI if they meant to go elsewhere (See below)
        if($this->session->userdata('logged_in')){
            //Check that they have memberof attributes from ldap
            $memberof = $this->session->userdata('memberOf');
            if (empty($memberof)){
                $this->session->set_flashdata("login-error", "You are not authorized to use this application.");
                redirect('login', 'refresh');
            }
            //Shift array over one (first index is a count, we don't want that)
            array_shift($memberof);
            //Check to see if they have a COB MDC memberof or dashboard admin memberof. If so, get all results from db.
            if((array_search('CN=COB MDC,OU=MDC,OU=TS,OU=Departments,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu',$memberof)!==false)||(array_search('CN=COB Dashboard Admins,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu',$memberof)!==false))
            {
                $sql = 'SELECT DISTINCT dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address FROM dbo.dashboard_urls INNER JOIN dbo.dashboard_linkURLtoGroup ON dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id JOIN dbo.dashboard_groups ON dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id JOIN dbo.dashboard_sections ON dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id JOIN dbo.dashboard_topics ON dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id';
                $query = $this->db->query($sql);
            } else{
                //Build a query using codeigniter query-builder. Unnecessary but made it easier to read due to its length.
                $this->db->select('dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address');
                $this->db->from('dbo.dashboard_urls');
                $this->db->join('dbo.dashboard_linkURLtoGroup', 'dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id', 'INNER');
                $this->db->join('dbo.dashboard_groups', 'dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id');
                $this->db->join('dbo.dashboard_sections', 'dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id');
                $this->db->join('dbo.dashboard_topics', 'dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id');
                $this->db->where('dbo.dashboard_groups.group_id', $memberof[0]);
                array_shift($memberof); //Same thing as earlier. Shift over one.
                foreach($memberof as $gid){
                    $this->db->or_where('dbo.dashboard_groups.group_id', $gid);
                }
                $this->db->distinct();
                //Finally execute query
                $query = $this->db->get();
                //If we don't have a valid search return, log them out.
                if($query === 'false'){
                    $this->session->set_flashdata("login-error", "We're sorry, you don't seem to have authorization to view any dahsboards.");
                    redirect('/logout');
                }
            }
            //Send query results to view
            $data = array(
                'query' => $query
            );
            $this->load->template('pages/home', $data);
        }else{
            //If they aren't logged in, get their requested page, direct them to login
            $request_uri = current_url();
            $_SESSION['request_uri'] = $request_uri;
            redirect('login', 'refresh');
        }
    }
}