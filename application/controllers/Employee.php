<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Employee';
		$this->load->model('model_employees');
		$this->load->model('model_departments');
		$this->load->model('model_designations');
		$this->load->model('model_groups');
	}

	/* 
	* It only redirects to the manage Employee page
	*/
	public function index()
	{

		if(!in_array('viewEmployee', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['role'] = $this->model_groups->getRoleByName();
        $this->data['departments'] = $this->model_departments->getDepartmentData();
		$this->render_template('Employees/index', $this->data);	
	}	

	/*
	* It checks if it gets the Employee id and retreives
	* the Employee information from the Employee model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchEmployeeDataById($id) 
	{
		if($id) {
			$data = $this->model_employees->getEmployeeData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the Employee value from the Employee table 
	* this function is called from the datatable ajax function
	*/          
	public function fetchEmployeeData()
	{
		$result = array('data' => array());

		$data = $this->model_employees->getEmployeeData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateEmployee', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteEmployee', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			}
			
			$department = $this->model_departments->getDepartmentData($value['department_id']);
			$designation = $this->model_designations->getDesignationData($value['designation_id']);
			// $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				'EMP00'.$value['id'],
				$value['firstname'] .' '. $value['lastname'] ,
		        $department['name'],
                $designation['name'],
				$value['dateofjoining'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Employee form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createEmployee', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('role', 'role', 'trim|required');
		$this->form_validation->set_rules('designation_id', 'Designation', 'trim|required');
		$this->form_validation->set_rules('department_id', 'Department', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role'),
				'department_id' => $this->input->post('department_id'),
				'designation_id' => $this->input->post('designation_id'),
				'dateofjoining' => date('M d, Y')
        		// 'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_employees->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Employee information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	/*
	* Its checks the Employee form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateEmployee', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('edit_lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('edit_username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('edit_email', 'Email', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('edit_password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('edit_designation_id', 'Designation', 'trim|required');
			$this->form_validation->set_rules('edit_department_id', 'Department', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'firstname' => $this->input->post('edit_firstname'),
					'lastname' => $this->input->post('edit_lastname'),
					'username' => $this->input->post('edit_username'),
					'email' => $this->input->post('edit_email'),
					'password' => $this->input->post('edit_password'),
					'department_id' => $this->input->post('edit_department_id'),
					'designation_id' => $this->input->post('edit_designation_id'),
	        	);

	        	$update = $this->model_employees->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the Employee information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteEmployee', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$Employee_id = $this->input->post('Employee_id');

		$response = array();
		if($Employee_id) {
			$delete = $this->model_employees->remove($Employee_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}