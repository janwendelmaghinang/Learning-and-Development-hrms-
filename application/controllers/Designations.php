<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Designations extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Designation';
		$this->load->model('model_employees');
		$this->load->model('model_designations');
		$this->load->model('model_departments');
	}

	/* 
	* It only redirects to the manage Designation page
	*/
	public function index()
	{

		if(!in_array('viewDesignation', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
        $this->data['departments'] = $this->model_departments->getDepartmentData();
		$this->render_template('designations/index', $this->data);	
	}	

	public function fetchDesignationDataById($id) 
	{
		if($id) {
			$data = $this->model_designations->getDesignationData($id);
			echo json_encode($data);
		}
		return false;
	}

	public function fetchDesignationByDeptId($id) 
	{
		if($id) {
			$data = $this->model_designations->getDesignationByDeptId($id);
			echo json_encode($data);
		}
		return false;
	}
            
	public function fetchDesignationData()
	{

		$result = array('data' => array());

		$data = $this->model_designations->getDesignationData();
		
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '';

			if(in_array('updateDesignation', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteDesignation', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
			
			$department = $this->model_departments->getDepartmentData($value['department_id']);

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$department['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createDesignation', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Designation_name', 'Designation name', 'trim|required');
		$this->form_validation->set_rules('department_id', 'Department', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('Designation_name'),
				'department_id' => $this->input->post('department_id'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_designations->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
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

	public function update($id)
	{

		if(!in_array('updateDesignation', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_Designation_name', 'Designation name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_Designation_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_designations->update($data, $id);
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


	public function remove()
	{
		if(!in_array('deleteDesignation', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$response = array();
		$Designation_id = $this->input->post('Designation_id');
		$d_type = 'designation';

        $check = $this->model_employees->existInEmployee($Designation_id,$d_type);
		if($check == true){
			$response['success'] = false;
			$response['messages'] = "This Designation is in use!";
		}else{

			$delete = $this->model_designations->remove($Designation_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the designation information";
			}
		}
		
		echo json_encode($response);
	}

}