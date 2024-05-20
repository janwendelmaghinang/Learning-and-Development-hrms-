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
		$this->load->model('model_courses');
		$this->load->model('model_assessments');
	}

	public function index()
	{

		if(!in_array('viewTraining', $this->permission)) {
			redirect('dashboard', 'refresh');
		}  

		$this->data['courses'] = $this->model_courses->getCourseData();
		$this->data['departments'] = $this->model_departments->getDepartmentData();
		$this->render_template('trainings/index', $this->data);	
	}	

	public function fetchTrainingDataById($id) 
	{
		if($id) {
			$data = $this->model_training->getTrainingData($id);
			echo json_encode($data);
		}

		return false;
	}
       
	public function fetchTrainingData()
	{
		$result = array('data' => array());

		$data = $this->model_training->getTrainingData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateTraining', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteTraining', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			}

			$course = $this->model_courses->getCourseData($value['course_id']);
			$emp = $this->model_employees->getEmployeeData($value['employee_id']);
			$department = $this->model_departments->getDepartmentData($emp['department_id']);
			$designation = $this->model_designations->getDesignationData($emp['designation_id']);
			$attempts = $this->model_assessments->getAttemptData($value['id']);
			$assessments =  $this->model_assessments->getAssessmentByCourse($value['course_id']);
            
            $last_attempt = (!$attempts == '') ? $attempts[count($attempts) - intval(1) ]['grade'] : '';
            $count_attempt = (!$attempts == '') ? count($attempts) : '0' ;
			$no_assessments = (!$assessments == '') ? $count_attempt .'/'. $assessments['max_attempt'] : 'No Assessments';

			$result['data'][$key] = array(	
				$emp['firstname'] .' '. $emp['lastname'] ,
		        $department['name'],
                $designation['name'],
			    $value['date_created'],
				$course['name'],
				$last_attempt,
				$no_assessments,
				$value['status'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createTraining', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
		$this->form_validation->set_rules('employee_id', 'Employee', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
				'description' => $this->input->post('desc'),
				'course_id' => $this->input->post('course_id'),	
				'employee_id' => $this->input->post('employee_id'),	
        	);

        	$create = $this->model_training->create($data);
        	if($create == true) {
				
				// call send_notification 
			$eSuccess =  $this->send_notification();
			if($eSuccess){
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
			}	
			else{
				$response['success'] = false;
			}
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

	public function send_notification() {

		// $config = array(
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_port' => 587,
        //     'smtp_user' => 'janwendelmaghinang@gmail.com',
        //     'smtp_pass' => 'janwendel00000100',
		// 	'smtp_crypto' => 'tls',
        //     'mailtype'  => 'html',
        //     'charset'   => 'iso-8859-1',
        //     'wordwrap'  => TRUE
        // );

        $this->load->library('email');
       
		$employee_email = 'maghinangjanwendel.pdm@gmail.com';

        // Email configuration
        // $config['mailtype'] = 'html';
        // $this->email->initialize($config);

        // Compose email
        $subject = 'Assessment Notification';
        $message = 'Dear Employee, <br><br> You have an upcoming assessment. Please be prepared.';

        // Sender's email address
        $this->email->from('janwendelmaghinang@gmail.com', 'wendel');

        // Recipient's email address
        $this->email->to($employee_email);

        // Email subject
        $this->email->subject($subject);

        // Email message
        $this->email->message($message);

        // Send email
        if ($this->email->send()) {
            return 'Email sent successfully.';
        } else {
            return 'Unable to send email.';
            // echo $this->email->print_debugger();
        }
    }

}