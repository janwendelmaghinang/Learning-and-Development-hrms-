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
			$buttons .= ' <a class="btn btn-default" href='.base_url('emp_training/view/'.$value['course_id'].'').'> <i class="fa fa-eye"></i> </a>';
			
			$course = $this->model_courses->getCourseData($value['course_id']);
			$emp = $this->model_employees->getEmployeeData($value['employee_id']);
			$department = $this->model_departments->getDepartmentData($emp['department_id']);
			$designation = $this->model_designations->getDesignationData($emp['designation_id']);
			$attempts = $this->model_assessments->getAttemptData($value['id']);
			$assessments =  $this->model_assessments->getAssessmentByCourse($value['course_id']);
            
            $last_attempt = (!$attempts == '') ? $attempts[count($attempts) - intval(1) ]['grade'] : '';
            $count_attempt = (!$attempts == '') ? count($attempts) : '0' ;
			$no_assessments = (!$assessments == '') ? $count_attempt .'/'. $assessments['max_attempt'] : 'No Assessments';
            $passing = (!$assessments == '') ? $assessments['passing_grade'] : 'No Assessments';

			$result['data'][$key] = array(	
				$course['name'],
                $value['status'],
                $passing,
				$no_assessments,
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

	// dispplay assesmnet
	public function assessment($id = null)
	{
        if($id){
		    $item = $this->model_assessments->getAssessmentByCourse($id);
			if($item){
				$this->data['duration'] = $item['assessment_duration'];
				$this->data['ass_id'] = $item['id'];
				$this->data['questions'] = $this->model_assessments->getAssessmentQuestions($item['id']);
			}
			else{
				redirect('emp_training', 'refresh');
			}
			$this->load->view('emp_training/assessment',$this->data);
		}
	}

	public function submit_exam(){
		$answer = $this->input->post('data');
		$assessment_id = $this->input->post('id');
		$user_id = $this->session->userdata('id');
        
		foreach($answer as $key=>$value){
            $data = array(
				'assessment_id' => $assessment_id,
				'employee_id' => $user_id,
				'choices_id' => $value[1],
				'answer' => $value[0]  
			);

            $submit =$this->model_assessments->submit_exam($data);
			if($submit){
				//  
			}
		}
	}


}