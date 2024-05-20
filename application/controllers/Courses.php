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

	public function index()
	{

		if(!in_array('viewCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
        $this->data['departments'] = $this->model_departments->getDepartmentData();
		$this->render_template('courses/index', $this->data);	
	}	

	public function fetchCourseDataById($id) 
	{
		if($id) {
			$data = $this->model_courses->getCourseData($id);
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
            $type = ($value['duration'] == 1) ? ($value['duration_type'] == 'hours') ? 'hour' : 'minute' : $value['duration_type'];
			$result['data'][$key] = array(
				$value['name'],
                $value['department'],
                $value['designation'],
				$value['duration'].' '.$type,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('course_name', 'Course name', 'trim|required');
        $this->form_validation->set_rules('duration', 'duration', 'trim|required');
		$this->form_validation->set_rules('duration_type', 'duration type', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if($this->form_validation->run() == TRUE) {
            
        	$data = array(
        		'name' => $this->input->post('course_name'),
				'duration' => $this->input->post('duration'),
				'duration_type' => $this->input->post('duration_type'),
				'date_created' => date('M d, Y')
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


	public function update($id)
	{

		if(!in_array('updateCourse', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id){
			$this->form_validation->set_rules('edit_course_name', 'Course Name', 'trim|required');
			$this->form_validation->set_rules('edit_duration', 'Duration', 'trim|required');
			$this->form_validation->set_rules('edit_duration_type', 'Type', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {	
				$data = array(
					'name' => $this->input->post('edit_course_name'),
					'duration' => $this->input->post('edit_duration'),
					'duration_type' => $this->input->post('edit_duration_type'),
				);

				$update = $this->model_courses->update($data, $id);
				if($update == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully updated';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while updated the courses information';			
				}
			}
		}else{
			$response['success'] = false;
			foreach ($_POST as $key => $value) {
				$response['messages'][$key] = form_error($key);
			}
		}
		echo json_encode($response);
    }

	
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
