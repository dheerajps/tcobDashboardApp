<?php

/**
 * This demonstrates how to connect to the db and perform a query.
 *
 * @version 1.0
 * @author cwm262
 */
class DBTest extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index(){
        if($this->session->userdata('logged_in')){

            //Simple select all query example (multiple results, object version)
            $query1 = $this->db->query("SELECT * FROM dbo.dashboard_groups");

            //Simple Query with Single Result
            $query2 = $this->db->query("SELECT TOP 1 * FROM dbo.dashboard_urls");

            //QUERY BUILDER HYPE
            //Simplified select all statement; gets everything from supplied table name
            $query3 = $this->db->get('dbo.dashboard_topics');

            //More Query Builder Hype Train Choo choo
            $this->db->select('group_id'); //Set the select portion
            $query4 = $this->db->get('dbo.dashboard_groups'); //Call the getter

            $groupid = 'CN=COB Dashboard AP BSBA Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $SQL = "SELECT dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address FROM dbo.dashboard_urls INNER JOIN dbo.dashboard_linkURLtoGroup ON dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id JOIN dbo.dashboard_groups ON dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id JOIN dbo.dashboard_sections ON dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id JOIN dbo.dashboard_topics ON dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id WHERE dbo.dashboard_groups.group_id = ?";
            $query5 = $this->db->query($SQL, array($groupid));

            $data = array(
                'query1' => $query1,
                'query2' => $query2,
                'query3' => $query3,
                'query4' => $query4,
                'query5' => $query5
            );

            $this->load->template('pages/dbtest', $data); //Call view page with result

        }else{
            redirect('login', 'refresh');
        }
    }
}