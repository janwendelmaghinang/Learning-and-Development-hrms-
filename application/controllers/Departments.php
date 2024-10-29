<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Departments';

		$this->load->model('model_departments');
		$this->load->model('model_designations');
	}


	public function index()
	{
		if(!in_array('viewDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_departments->getDepartmentData();

		$this->data['results'] = $result;

		$this->render_template('department/index', $this->data);
	}

	/*
	* Fetches the Department data from the Department table 
	* this function is called from the datatable ajax function
	*/       
	public function fetchDepartmentData()
	{
		$result = array('data' => array());

		$data = $this->model_departments->getDepartmentData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('viewDepartment', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editDepartment('.$value['id'].')" data-toggle="modal" data-target="#editDepartmentModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteDepartment', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeDepartment('.$value['id'].')" data-toggle="modal" data-target="#removeDepartmentModal"><i class="fa fa-trash"></i></button>
				';
			}				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the Department id and retreives
	* the Department information from the Department model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/             
	public function fetchDepartmentDataById($id)
	{
		if($id) {
			$data = $this->model_departments->getDepartmentData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the Department form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('department_name', 'Department name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('department_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_departments->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Department information';			
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
	* Its checks the Department form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_department_name', 'Department name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_department_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_departments->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the department information';			
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
	* It removes the department information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$response = array();
		
		$department_id = $this->input->post('department_id');
        $check = $this->model_designations->existInDesignation($department_id);

		if($check == true){
			$response['success'] = false;
			$response['messages'] = "This Department Exists in Designation!";
		}else{
			$delete = $this->model_departments->remove($department_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the department information";
			}
		}
		echo json_encode($response);
	}

}