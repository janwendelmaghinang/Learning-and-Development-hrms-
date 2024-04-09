<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materials extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Materials';
		$this->load->model('model_employees');
        $this->load->model('model_courses');
		$this->load->model('model_materials');
		$this->load->model('model_departments');
	}

	/* 
	* It only redirects to the manage Material page
	*/
	public function index()
	{

		if(!in_array('viewMaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
        $this->data['courses'] = $this->model_courses->getCourseData();
		$this->render_template('trainingmaterials/index', $this->data);	
	}	

	/*
	* It checks if it gets the Material id and retreives
	* the Material information from the Material model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchMaterialDataById($id) 
	{
		if($id) {
			$data = $this->model_materials->getMaterialData($id);
			echo json_encode($data);
		}

		return false;
	}

	public function fetchMaterialByDeptId($id) 
	{
		if($id) {
			$data = $this->model_materials->getMaterialByDeptId($id);
			echo json_encode($data);
		}

		return false;
	}


	/*
	* Fetches the Material value from the Material table 
	* this function is called from the datatable ajax function
	*/          
	public function fetchMaterialData()
	{
		$result = array('data' => array());

		$data = $this->model_materials->getMaterialData();
		
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '';

			if(in_array('updateMaterial', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteMaterial', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
		
			// $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['material_name'],
                $value['material_type'],
                $value['material_url'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Material form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createMaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('name', 'Material name', 'trim|required');
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('url', 'url', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'material_name' => $this->input->post('name'),
				'course_id' => $this->input->post('course_id'),
        		'material_url' => $this->input->post('url'),	
                'material_type' => $this->input->post('type'),
                'description' => $this->input->post('description')
        	);

        	$create = $this->model_materials->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the materials information';			
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
	* Its checks the Material form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateMaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_Material_name', 'Material name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_Material_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_materials->update($data, $id);
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
	* It removes the Material information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteMaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$response = array();
		$Material_id = $this->input->post('Material_id');
		$d_type = 'Material';

        $check = $this->model_employees->existInEmployee($Material_id,$d_type);
		if($check == true){
			$response['success'] = false;
			$response['messages'] = "This Material is in use!";
		}else{

			$delete = $this->model_materials->remove($Material_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the Material information";
			}
		}
		
		echo json_encode($response);
	}

}