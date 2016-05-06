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
                $this->session->set_flashdata("login-error", "You are not authorized to use this application.");
                redirect('login', 'refresh');
            }
            array_shift($memberof);
            if((array_search('CN=COB MDC,OU=MDC,OU=TS,OU=Departments,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu',$memberof)!==false)||(array_search('CN=COB Dashboard Admins,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu',$memberof)!==false))
            {
                $sql = 'SELECT DISTINCT dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address FROM dbo.dashboard_urls INNER JOIN dbo.dashboard_linkURLtoGroup ON dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id JOIN dbo.dashboard_groups ON dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id JOIN dbo.dashboard_sections ON dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id JOIN dbo.dashboard_topics ON dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id';
                $query = $this->db->query($sql);
            } else{
                $this->db->select('dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address');
                $this->db->from('dbo.dashboard_urls');
                $this->db->join('dbo.dashboard_linkURLtoGroup', 'dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id', 'INNER');
                $this->db->join('dbo.dashboard_groups', 'dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id');
                $this->db->join('dbo.dashboard_sections', 'dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id');
                $this->db->join('dbo.dashboard_topics', 'dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id');
                $this->db->where('dbo.dashboard_groups.group_id', $memberof[0]);
                array_shift($memberof);
                foreach($memberof as $gid){
                    $this->db->or_where('dbo.dashboard_groups.group_id', $gid);
                }
                $this->db->distinct();
                $query = $this->db->get();
                if($query === 'false'){
                    $this->session->set_flashdata("login-error", "We're sorry, you don't seem to have authorization to view any dahsboards.");
                    redirect('/logout');
                }
            }
            $data = array(
                'query' => $query
            );
            $this->load->template('pages/home', $data);
        }else{
            $request_uri = current_url();
            $_SESSION['request_uri'] = $request_uri;
            redirect('login', 'refresh');
        }

    }

}