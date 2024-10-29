<?php 

class Model_training extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active training infromation */
	public function getActiveTraining()
	{
		$sql = "SELECT * FROM trainings WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the training data */
	public function getTrainingData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM trainings WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM trainings ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('trainings', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('trainings', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('trainings');
			return ($delete == true) ? true : false;
		}
	}

	// check if department is in use in Training
	public function existInTraining($id, $d_type){
		if($id && $d_type == 'ttype') {
			$sql = "SELECT * FROM trainings WHERE type_id = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
		if($id && $d_type == 'employee') {
			$sql = "SELECT * FROM trainings WHERE employee_id = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
	}


	public function getTrainingDataByEmployee($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM trainings WHERE employee_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}


}