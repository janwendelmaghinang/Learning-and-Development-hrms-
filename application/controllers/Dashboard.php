<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct(); 
		$this->not_logged_in(); 
		$this->data['page_title'] = 'Dashboard';
		$this->load->model('model_users');
	}
	public function index()
	{
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_employee'] = $this->model_users->countTotalEmployee();
		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}