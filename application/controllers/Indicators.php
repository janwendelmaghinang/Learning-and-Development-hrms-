<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Indicators extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Indicators';

		$this->load->model('model_indicators');
		$this->load->model('model_designations');
        $this->load->model('model_departments');
	}


	public function index()
	{
		// if(!in_array('viewBrand', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$result = $this->model_departments->getDepartmentData();

		$this->data['departments'] = $result;

		$this->render_template('indicators/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/       
	public function fetchIndicatorData()
	{
		$result = array('data' => array());

		$data = $this->model_indicators->getIndicatorData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateIndicator', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editIndicator('.$value['id'].')" data-toggle="modal" data-target="#editIndicatorModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteIndicator', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeIndicator('.$value['id'].')" data-toggle="modal" data-target="#removeIndicatorModal"><i class="fa fa-trash"></i></button>
				';
			}	
            
            $department = $this->model_departments->getDepartmentData($value['department_id']);
            $designation = $this->model_designations->getDesignationData($value['designation_id']);

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
                
				$department['name'],
                $designation['name'],
                '-',
                '-',
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/             
	public function fetchIndicatorDataById($id)
	{
		if($id) {
			$data = $this->model_indicators->getIndicatorData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createIndicator', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Indicator_name', 'Indicator name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('Indicator_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_indicators->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Indicator information';			
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
	* Its checks the brand form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateIndicator', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_Indicator_name', 'Indicator name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_Indicator_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_indicators->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the Indicator information';			
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
	* It removes the Indicator information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteIndicator', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$response = array();
		
		$Indicator_id = $this->input->post('Indicator_id');
        $check = $this->model_designations->existInDesignation($Indicator_id);

		if($check == true){
			$response['success'] = false;
			$response['messages'] = "This Indicator Exists in Designation!";
		}else{
			$delete = $this->model_indicators->remove($Indicator_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the Indicator information";
			}
		}
		echo json_encode($response);
	}

}