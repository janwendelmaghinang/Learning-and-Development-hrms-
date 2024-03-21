<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainings extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'Training';
		$this->load->model('model_training');
		$this->load->model('model_departments');
		$this->load->model('model_designations');
		$this->load->model('model_employees');
		$this->load->model('model_types');
	}

	/* 
	* It only redirects to the manage Training page
	*/
	public function index()
	{

		if(!in_array('viewTraining', $this->permission)) {
			redirect('dashboard', 'refresh');
		}  
		$this->data['types'] = $this->model_types->getTrainingTypesData();
		$this->data['departments'] = $this->model_departments->getDepartmentData();
		$this->render_template('trainings/index', $this->data);	
	}	

	/*
	* It checks if it gets the Training id and retreives
	* the Training information from the Training model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchTrainingDataById($id) 
	{
		if($id) {
			$data = $this->model_training->getTrainingData($id);
			// $emp = $this->model_employees->getEmployeeData($data['employee_id']);
			// $data['employee'] = $emp; 
			// $data['department'] = $this->model_departments->getDepartmentData($emp['department_id']);
			// $data['designation'] = $this->model_designations->getDesignationData($emp['designation_id']);
			// $data['type'] = $this->model_types->getTrainingTypesData($data['type_id']);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the Training value from the Training table 
	* this function is called from the datatable ajax function
	*/          
	public function fetchTrainingData()
	{
		$result = array('data' => array());

		$data = $this->model_training->getTrainingData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			
			// if(in_array('updateTraining', $this->permission)) {
			// 	$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-eye"></i></button>';
			// }

			if(in_array('updateTraining', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteTraining', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			}
			$type = $this->model_types->getTrainingTypesData($value['type_id']);
			$emp = $this->model_employees->getEmployeeData($value['employee_id']);
			$department = $this->model_departments->getDepartmentData($emp['department_id']);
			$designation = $this->model_designations->getDesignationData($emp['designation_id']);
			// $status = ($value['status'] == 'pending') ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(	
		        $department['name'],
                $designation['name'],
				$type['name'],
				$emp['firstname'] .' '. $emp['lastname'] ,
				$value['startdate'],
				$value['enddate'],
				$value['status'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Training form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createTraining', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('designation_id', 'Designation', 'trim|required');
		$this->form_validation->set_rules('department_id', 'Department', 'trim|required');
		$this->form_validation->set_rules('type_id', 'Training type', 'trim|required');
		$this->form_validation->set_rules('employee_id', 'Employee', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		// 'designation_id' => $this->input->post('designation_id'),
				// 'department_id' => $this->input->post('department_id'),	
				'description' => $this->input->post('desc'),
				'type_id' => $this->input->post('type_id'),	
				'employee_id' => $this->input->post('employee_id'),	
				'startdate' => $this->input->post('start_date'),	
				'enddate' => $this->input->post('end_date'),
				'status' => 'pending'	
        	);

        	$create = $this->model_training->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Training information';			
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
	* Its checks the Training form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateTraining', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->form_validation->set_rules('edit_type_id', 'Training type', 'trim|required');
		$this->form_validation->set_rules('edit_start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('edit_end_date', 'End Date', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$response = array();
		if($id) {

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
				'description' => $this->input->post('edit_desc'),
				'type_id' => $this->input->post('edit_type_id'),	
				'startdate' => $this->input->post('edit_start_date'),	
				'enddate' => $this->input->post('edit_end_date'),
	        	);

	        	$update = $this->model_training->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the training information';			
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
	* It removes the Training information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteTraining', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('training_id');

		$response = array();
		if($id) {
			$delete = $this->model_training->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the training information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}