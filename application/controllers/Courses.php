<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends Admin_Controller {
    
    public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Course';
		$this->load->model('model_courses');
		$this->load->model('model_departments');
		$this->load->model('model_designations');
		$this->load->model('model_checking');
	}

	/* 
	* It only redirects to the manage Course page
	*/
	public function index()
	{

		if(!in_array('viewCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
        $this->data['departments'] = $this->model_departments->getDepartmentData();
		$this->render_template('courses/index', $this->data);	
	}	

	/*
	* It checks if it gets the Course id and retreives
	* the Course information from the Course model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchCourseDataById($id) 
	{
		if($id) {
			$data = $this->model_Courses->getCourseData($id);
			echo json_encode($data);
		}

		return false;
	}
	public function fetchCourseByDeptId_DesigId() 
	{
		$department = $this->input->post('dept_id');
		$designation = $this->input->post('desig_id');
        $response = array();
		if($department && $designation) {
			$data = $this->model_Courses->getCourseByDeptAndDesigData($department,$designation);
            if($data){
				$response['success'] = true;
				$response['results'] = $data;
			}
			else{
				$response['success'] = false;
				$response['results'] = $data;
			}
		
			echo json_encode($response);
		}

		return false;
	}
	/*
	* Fetches the Course value from the Course table 
	* this function is called from the datatable ajax function
	*/          
	public function fetchCourseData()
	{
		$result = array('data' => array());

		$data = $this->model_courses->getCourseData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateCourse', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteCourse', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			}
			
			// $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
                $value['department'],
                $value['designation'],
				$value['duration'].' hours',
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Course form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('course_name', 'Course name', 'trim|required');
        $this->form_validation->set_rules('duration', 'duration', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if($this->form_validation->run() == TRUE) {
            
        	$data = array(
        		'name' => $this->input->post('course_name'),
				'duration' => $this->input->post('duration')
        	);
			if($this->input->post('department_id')){
				$department = $this->model_departments->getDepartmentData($this->input->post('department_id'));
				$data['department'] = $department['name'];
			}
			if($this->input->post('designation_id')){
				$designation = $this->model_designations->getDesignationData($this->input->post('designation_id'));
				$data['designation'] = $designation['name'];
			}

        	$create = $this->model_courses->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Course information';			
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
	* Its checks the Course form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('edit_lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('edit_username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('edit_email', 'Email', 'trim|required|min_length[5]');
            if(!empty($this->input->post('edit_password'))){
				$this->form_validation->set_rules('edit_password', 'Password', 'trim|required|min_length[8]');
			}
			$this->form_validation->set_rules('edit_designation_id', 'Designation', 'trim|required');
			$this->form_validation->set_rules('edit_department_id', 'Department', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {	
				if(empty($this->input->post('edit_password'))){
					$data = array(
						'firstname' => $this->input->post('edit_firstname'),
						'lastname' => $this->input->post('edit_lastname'),
						'username' => $this->input->post('edit_username'),
						'email' => $this->input->post('edit_email'),
						'department_id' => $this->input->post('edit_department_id'),
						'designation_id' => $this->input->post('edit_designation_id'),
					);

					$update = $this->model_Courses->update($data, $id);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				} 
				else{
					$data = array(
						'firstname' => $this->input->post('edit_firstname'),
						'lastname' => $this->input->post('edit_lastname'),
						'username' => $this->input->post('edit_username'),
						'password' => password_hash($this->input->post('edit_password'),PASSWORD_DEFAULT),
						'email' => $this->input->post('edit_email'),
						'department_id' => $this->input->post('edit_department_id'),
						'designation_id' => $this->input->post('edit_designation_id'),
					);

					$update = $this->model_courses->update($data, $id);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
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
	* It removes the Course information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$response = array();

		// validate before delete
		$db = 'assessments';
		$attr = 'course_id';
		$id = $this->input->post('course_id');
		$check = $this->model_checking->existing($db, $attr, $id);

		if($check == true){
			$response['success'] = false;
			$response['messages'] = "This course is in use!";
		}else{
			$delete = $this->model_courses->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the course information";
			}
		}
		echo json_encode($response);
	}

}
