<?php 

class Model_assessments extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active Assessment infromation */
	public function getActiveAssessment()
	{
		$sql = "SELECT * FROM assessments WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the Assessment data */
	public function getAssessmentData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM assessments WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM assessments ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('assessments', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('assessments', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('assessments');
			return ($delete == true) ? true : false;
		}
	}

	public function createQuestion($data)
	{
		if($data) {
			$insert = $this->db->insert('assessment_questions', $data);
			$insert_id = $this->db->insert_id();

			if($insert_id){
				$choices = array(
					'question_id' => $insert_id,
					'a' => $this->input->post('choice_a'),
					'b' => $this->input->post('choice_b'),
					'c' => $this->input->post('choice_c'),
					'd' => $this->input->post('choice_d'),
					'correct_answer' => $this->input->post('correct')
				);
			    $this->db->insert('choices', $choices);
			}
			return ($insert_id) ? true : false;
		}
	}

	public function getQuestionData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM assessment_questions WHERE assessment_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

	public function getChoiceData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM choices WHERE question_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}

	/* get the Assessment attemtps data */
	public function getAttemptData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM assessment_attempts WHERE training_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}
	// getAssessmentByCourse
	public function getAssessmentByCourse($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM assessments WHERE course_id = ?";
			$query = $this->db->query($sql, array($id));
			return  $query->row_array();
		}
	}

		/* get active Assessment question */
		public function getAssessmentQuestions($id = null)
		{
			$sql = "SELECT question_id,question,a,b,c,d FROM assessment_questions INNER JOIN choices ON assessment_questions.id = choices.question_id WHERE assessment_questions.assessment_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		// submit exam

		public function submit_exam($data)
		{
			if($data) {
				$insert = $this->db->insert('assessment_answers', $data);
				return ($insert == true) ? true : false;
			}
		}
	     


}