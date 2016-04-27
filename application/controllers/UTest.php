<?php

/**
 * UnitTestTest Examples
 *
 *
 * @version 1.0
 * @author cwm262
 */
class UTest extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->database();
    }

    public function index(){
        if($this->session->userdata('logged_in')){

            $SQL = "SELECT DISTINCT dashboard_topics.topic_name, dashboard_sections.section_name,dashboard_urls.url_name, dashboard_urls.url_address FROM dbo.dashboard_urls INNER JOIN dbo.dashboard_linkURLtoGroup ON dbo.dashboard_urls.url_id = dbo.dashboard_linkURLtoGroup.url_id JOIN dbo.dashboard_groups ON dbo.dashboard_linkURLtoGroup.group_id = dbo.dashboard_groups.group_id JOIN dbo.dashboard_sections ON dbo.dashboard_urls.section_id = dbo.dashboard_sections.section_id JOIN dbo.dashboard_topics ON dbo.dashboard_urls.topic_id = dbo.dashboard_topics.topic_id WHERE dbo.dashboard_groups.group_id IN (?)";

            /*******************************/
            
            $groupid = 'CN=COB Dashboard AP eMBA Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';

            $query = $this->db->query($SQL, array($groupid));
            
            $test = $query->num_rows();

            $expected_result = 2;

            $test_name = 'Test dashboard db with AP eMBA Demographics group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard AP BSBA Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 2;

            $test_name = 'Test dashboard db with AP BSBA Demographics group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard AP Acct Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 2;

            $test_name = 'Test dashboard db with AP Acct Demographics group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard AP MBA Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 2;

            $test_name = 'Test dashboard db with AP MBA Demographics group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard AP PHD Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 2;

            $test_name = 'Test dashboard db with AP PHD Demographics group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard StrategicPlan MBACompetitiveness,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 1;

            $test_name = 'Test dashboard db with Dashboard StrategicPlan MBACompetitiveness group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard StrategicPlan FinancialStrength,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 1;

            $test_name = 'Test dashboard db with Dashboard StrategicPlan FinancialStrength group';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard AP MBA Rankings,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 1;

            $test_name = 'Test dashboard db with Dashboard AP MBA Rankings';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/

            $groupid = 'CN=COB Dashboard Departments UGAdvising Demographics,OU=Dashboards,OU=Applications,OU=COB,OU=MU,DC=col,DC=missouri,DC=edu';
            $query = $this->db->query($SQL, array($groupid));

            $test = $query->num_rows();

            $expected_result = 3;

            $test_name = 'Test dashboard db with Dashboard Departments UGAdvising Demographics';

            $this->unit->run($test, $expected_result, $test_name);

            /*******************************/


            //Get all results and send them to view
            $results = $this->unit->result();
            $data = array(
                'results' => $results    
            );
            $this->load->template('pages/utest', $data);

        }else{
            redirect('login', 'refresh');
        }
    }
}