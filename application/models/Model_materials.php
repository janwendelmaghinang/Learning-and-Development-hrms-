<?php 

class Model_materials extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveMaterial()
	{
		$sql = "SELECT * FROM training_materials WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getMaterialData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM training_materials WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM training_materials";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getMaterialCourseData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM training_materials WHERE course_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('training_materials', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('training_materials', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('training_materials');
			return ($delete == true) ? true : false;
		}
	}


	// check if department is in use in training_materials
	public function existInMaterial($id){
		if($id) {
			$sql = "SELECT * FROM training_materials WHERE department_id = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
	}

	public function getMaterialByDeptId($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM training_materials WHERE department_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

}