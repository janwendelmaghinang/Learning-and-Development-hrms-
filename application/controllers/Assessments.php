<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessments extends Admin_Controller {
    
    public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Assesments';
		$this->load->model('model_assessments');
        $this->load->model('model_courses');
		$this->load->model('model_checking');
	}

	public function index()
	{
		if(!in_array('viewAssessment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['courses'] = $this->model_courses->getCourseData();
		$this->render_template('assessments/index', $this->data);	
	}	

	public function fetchAssessmentDataById($id) 
	{
		if($id){
			$data['data'] = $this->model_assessments->getAssessmentData($id);
            $data['course'] = $this->model_courses->getCourseData($data['data']['course_id'] );
			echo json_encode($data);
		}

		return false;
	}
         
	public function fetchAssessmentData()
	{
		$result = array('data' => array());

		$data = $this->model_assessments->getAssessmentData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateAssessment', $this->permission)) {
				$buttons .= ' <a class="btn btn-default" href='.base_url('assessments/manageassessments/'.$value['id'].'').'> <i class="fa fa-eye"></i> </a>';
			}

			if(in_array('updateAssessment', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteAssessment', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			}
			
			// $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$course = $this->model_courses->getCourseData($value['course_id']);
			$result['data'][$key] = array(
				$course['name'],
                $value['passing_grade'].' %' ,
                $value['max_attempt'],
				$buttons
			);
		} 

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createAssessment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('course_id', 'course', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required');
		$this->form_validation->set_rules('duration_type', 'Type', 'trim|required');
        $this->form_validation->set_rules('passing', 'passing', 'trim|required');
		// $this->form_validation->set_rules('attempt', 'Max Attempt', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            // validate before create
			$db = 'assessments';
			$attr = 'course_id';
			$id = $this->input->post('course_id');
			$check = $this->model_checking->existing($db, $attr, $id);

			if($check !== true){
				$data = array(
					'course_id' => $this->input->post('course_id'),
					'assessment_duration' => $this->input->post('duration'),
					'duration_type' => $this->input->post('duration_type'),
					'passing_grade' => $this->input->post('passing'),
					// 'max_attempt' => $this->input->post('attempt')
				);
	
				$create = $this->model_assessments->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the Assessment information';			
				}
			}
			else{
				$response['success'] = false;
				$response['messages'] = 'You cant create multiple assessment in one course. You can choose different courses!';		
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

		if(!in_array('updateAssessment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
				$this->form_validation->set_rules('edit_duration', 'Duration', 'trim|required');
				$this->form_validation->set_rules('edit_duration_type', 'Type', 'trim|required');
				$this->form_validation->set_rules('edit_passing', 'passing', 'trim|required');
				// $this->form_validation->set_rules('edit_attempt', 'Max Attempt', 'trim|required');
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	            if ($this->form_validation->run() == TRUE) {	
					$data = array(
						'assessment_duration' => $this->input->post('edit_duration'),
						'duration_type' => $this->input->post('edit_duration_type'),
						'passing_grade' => $this->input->post('edit_passing'),
						// 'max_attempt' => $this->input->post('edit_attempt'),
					);

					$update = $this->model_assessments->update($data, $id);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the assessments information';			
					}
			    }
				else {
					$response['success'] = false;
					foreach ($_POST as $key => $value) {
						$response['messages'][$key] = form_error($key);
					}
				}
		}
		echo json_encode($response);
	}

	public function remove()
	{
		if(!in_array('deleteAssessment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$response = array();
		// validate before create
		$db = 'assessment_questions';
		$attr = 'assessment_id';
		$id = $this->input->post('assessment_id');
		$check = $this->model_checking->existing($db, $attr, $id);

		if($check == true){
			$response['success'] = false;
			$response['messages'] = "This Assessment is in use!";
		}else{
			$delete = $this->model_assessments->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		echo json_encode($response);
	}

	public function manageassessments($id = null){

		if(!in_array('viewAssessment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
         
		if($id){
            // create a validation here
			// check id if existing
            $this->data['assessment'] = $this->model_assessments->getAssessmentData($id);
	
			if($this->data['assessment'] == null){
                redirect('dashboard', 'refresh');
			}
			else{
				$this->data['course'] = $this->model_courses->getCourseData($this->data['assessment']['course_id']);
				$this->render_template('assessments/manage', $this->data);	
			}
		}
		else{
			redirect('dashboard', 'refresh');
		}
	}

	public function createQuestion(){

		if(!in_array('createAssessment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('question', 'question', 'trim|required');
		$this->form_validation->set_rules('choice_a', 'choice a', 'trim|required');
		$this->form_validation->set_rules('choice_b', 'choice b', 'trim|required');
		$this->form_validation->set_rules('choice_c', 'choice c', 'trim|required');
		$this->form_validation->set_rules('choice_d', 'choice d', 'trim|required');
		$this->form_validation->set_rules('correct', 'correct', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
          
        	$data = array(
        		'question' => $this->input->post('question'),
				'assessment_id' => $this->input->post('assessment_id'),
				'a' => $this->input->post('choice_a'),
				'b' => $this->input->post('choice_b'),
				'c' => $this->input->post('choice_c'),
				'd' => $this->input->post('choice_d'),
				'correct_answer' => $this->input->post('correct')
        	);

        	$create = $this->model_assessments->createQuestion($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the question information';			
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

	public function fetchQuestionData($id)
	{
	    
		$result = array('data' => array());

		$data = $this->model_assessments->getQuestionData($id);
		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateAssessment', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteAssessment', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			}
			
			$result['data'][$key] = array(
				$value['question'],
                $value['a'],
				$value['b'],
				$value['c'],
				$value['d'],
				'<span class="label label-success text-uppercase">'.$value['correct_answer'].'</span>',
				$buttons
			);
		} 

		echo json_encode($result);
	}

	public function process($id) { 
        if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
            $file = $_FILES['csv_file']['tmp_name'];
            $handle = fopen($file, 'r');
            $header = true;

            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($header) {
                    $header = false;
                    continue;
                }

                $data = array(
					'assessment_id' => $this->input->post('ass_id'),
                    'question' => $row[0],
                    'a' => $row[1],
                    'b' => $row[2],
                    'c' => $row[3],
                    'd' => $row[4],
                    'correct_answer' => $row[5]
                );

				$create = $this->model_assessments->createQuestion($data);
            }
            fclose($handle);
            $this->session->set_flashdata('success', 'CSV File successfully processed and data inserted.');
        } else {
            $this->session->set_flashdata('error', 'Error uploading file.');
        }
        redirect('assessments/manageassessments/'.$id);
    }

}
