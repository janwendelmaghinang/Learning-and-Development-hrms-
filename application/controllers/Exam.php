<?php 

class Exam extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct(); 
		$this->not_logged_in(); 
		$this->data['page_title'] = 'Exam';
		$this->load->model('model_assessments');
	}
	public function index()
	{
        // get question by assessment id
        $this->data['questions'] = $this->model_assessments->getAssessmentQuestions(5);

		$this->load->view('exam/index', $this->data);
	}
}