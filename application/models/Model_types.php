<?php 

class Model_types extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active training types information*/
	public function getActiveTrainingTypes()
	{
		$sql = "SELECT * FROM training_type WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the training types data */
	public function getTrainingTypesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM training_type WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM training_type";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('training_type', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('training_type', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('training_type');
			return ($delete == true) ? true : false;
		}
	}

}