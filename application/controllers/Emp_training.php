<?php 

class Emp_training extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct(); 
		$this->not_logged_in(); 
		$this->data['page_title'] = 'training';
        $this->load->model('model_training');
		$this->load->model('model_departments');
		$this->load->model('model_designations');
		$this->load->model('model_employees');
		$this->load->model('model_courses');
		$this->load->model('model_assessments');
	}
	public function index()
	{
		if(!in_array('viewTest', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

        // if($is_admin == false){
		// 	redirect('dashboard', 'refresh');
		// }  

		$this->data['is_admin'] = $is_admin;
		$this->render_template('emp_training/index',$this->data);
	}

    public function fetchTrainingData()
	{
		$result = array('data' => array());
        $user_id = $this->session->userdata('id');
		$data = $this->model_training->getTrainingDataByEmployee($user_id);
		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			$buttons .= ' <a class="btn btn-default" href='.base_url('emp_training/view/'.$value['id'].'').'>View</a>';
			
			$course = $this->model_courses->getCourseData($value['course_id']);
			$emp = $this->model_employees->getEmployeeData($value['employee_id']);
			$department = $this->model_departments->getDepartmentData($emp['department_id']);
			$designation = $this->model_designations->getDesignationData($emp['designation_id']);
			$assessments =  $this->model_assessments->getAssessmentByCourse($value['course_id']);
            $passing = (!$assessments == '') ? $assessments['passing_grade'] : 'No Assessments';

			$result['data'][$key] = array(	
				$course['name'],
                $passing .' %',
                $value['status'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function view($id = null)
	{
        if($id){
			$user_id = $this->session->userdata('id');
			$is_admin = ($user_id == 1) ? true :false;
			$this->data['id'] = $id;
			$this->render_template('emp_training/view',$this->data);
		}
		else{
			// show 404 page
		}
	}

	// display assessment
	public function assessment($id = null)
	{
        if($id){
            // get training data
			$course = $this->model_training->getTrainingData($id);
		    $item = $this->model_assessments->getAssessmentByCourse($course['course_id']);
			if($item){
				$this->data['duration'] = $item['assessment_duration'];
				$this->data['ass_id'] = $item['id'];
				$this->data['questions'] = $this->model_assessments->getAssessmentQuestions($item['id']);
			}
			else{
				redirect('emp_training', 'refresh');
			}
			$this->data['id'] = $id;
			$this->load->view('emp_training/assessment',$this->data);
		}
	}

	public function submit_exam(){
		$answer = $this->input->post('data');
		$assessment_id = $this->input->post('id');
		$training_id = $this->input->post('training_id');
		$user_id = $this->session->userdata('id');
        
		// // delete the existing answer 
		// // get existing answer
		// $res = $this->model_assessments->getAnswer($user_id, $assessment_id);
		// if($res){
		// 	$this->model_assessments->deleteAnswer($res);
		// }

		foreach($answer as $key=>$value){
            $data = array(
				'assessment_id' => $assessment_id,
				'employee_id' => $user_id,
				'choices_id' => $value[1],
				'answer' => $value[0]  
			);
            $this->model_assessments->submit_exam($data);
		}

		//  get assessment by emp_id and assessment_id
		$answer = $this->model_assessments->getAnswer($user_id, $assessment_id);
		$total = 0;
		foreach($answer as $key=>$val){
			// check the questions
			$correct = $this->model_assessments->getCorrect($val['choices_id']);
			if($val['answer'] === $correct['correct_answer'] ){
				$total = $total + 1;
			}
		}
		// get assessment total items
		$items = count($this->model_assessments->getQuestionData($assessment_id));

		// get passing grade
		$passing_grade = $this->model_assessments->getAssessmentData($assessment_id);

		// convert total percent
		$score = intval($items) * ($total / 100);
		
		$score_percent = $score * 100;
		// compute and compare 
		$status = ($score_percent > $passing_grade['passing_grade'] || $score_percent == $passing_grade['passing_grade']) ? 'Passed' : 'Failed' ;

		$ass_result = array(
			'grade' => $score_percent,
			'status' => $status
		);

				// update training table
		$update = $this->model_training->update($ass_result, $training_id);
        
		$response = array();

		if($update){
			$response['success'] = true;
		}
		else
		{
			$response['success'] = false;
		}

		echo json_encode($response);
	}


}