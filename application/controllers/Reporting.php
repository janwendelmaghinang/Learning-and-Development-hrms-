<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
 
        $this->load->model('report_model');

    }

    public function courseEnrollments() {

        $this->load->view('course_enrollments_report');
    }

    public function quizScores() {

        $this->load->view('quiz_scores_report');
    }

    public function employeeProgress($employee_id) {

        $this->load->view('employee_progress_report');
    }

    public function generateCertificate($enrollment_id) {

        $this->load->view('certificate');
    }
}
