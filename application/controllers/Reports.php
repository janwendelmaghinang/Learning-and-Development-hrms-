<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = 'Stores';
		$this->load->model('model_courses');
	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		if(!in_array('viewReports', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->render_template('reports/index', $this->data);
	}

	public function onlineCourse(){
		$this->data['data'] = $this->model_courses->getCourseData();
		$this->load->view('reports/onlinecourse', $this->data);
	}
	public function onlineassessment(){
		$this->load->view('reports/onlineassessment');
	}
	public function onlinetraining(){
		$this->load->view('reports/onlinetraining');
	}
	public function onlinematerial(){
		$this->load->view('reports/onlinematerial');
	}
}	