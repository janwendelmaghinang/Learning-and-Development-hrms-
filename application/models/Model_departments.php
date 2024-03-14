<?php 

class Model_departments extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active departments information*/
	public function getActiveDepartments()
	{
		$sql = "SELECT * FROM departments WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getDepartmentData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM departments WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM departments";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('departments', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('departments', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('departments');
			return ($delete == true) ? true : false;
		}
	}

}