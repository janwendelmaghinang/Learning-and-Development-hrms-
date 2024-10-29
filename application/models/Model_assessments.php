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
			return ($insert == true) ? true : false;
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
		$sql = "SELECT * FROM assessment_questions WHERE assessment_id = ?";
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

	// get answer
		/* get active Assessment question */
		public function getAnswer($user_id = null, $assessment_id = null)
		{
			$sql = "SELECT * FROM assessment_answers WHERE assessment_id = ? AND employee_id = ?";
			$query = $this->db->query($sql, array($assessment_id, $user_id));
			return $query->result_array();
		}

			// getCorrect
		public function getCorrect($id = null)
		{
			if($id) {
				$sql = "SELECT * FROM assessment_questions WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return  $query->row_array();
			}
		}

		// delete answer
		public function deleteAnswer($id)
		{
			if($id) {
				$this->db->where('id', $id);
				$delete = $this->db->delete('assessment_answers');
				return ($delete == true) ? true : false;
			}
		}

	
	     


}