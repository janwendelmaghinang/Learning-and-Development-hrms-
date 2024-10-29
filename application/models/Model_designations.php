<?php 

class Model_designations extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveDesignation()
	{
		$sql = "SELECT * FROM designation WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getDesignationData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM designation WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM designation";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('designation', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('designation', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('designation');
			return ($delete == true) ? true : false;
		}
	}


	// check if department is in use in designation
	public function existInDesignation($id){
		if($id) {
			$sql = "SELECT * FROM designation WHERE department_id = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
	}

	public function getDesignationByDeptId($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM designation WHERE department_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}

}