<?php 

class Model_courses extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active Course infromation */
	public function getActiveCourse()
	{
		$sql = "SELECT * FROM courses WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the Course data */
	public function getCourseData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM courses WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM courses ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('courses', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('courses', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('courses');
			return ($delete == true) ? true : false;
		}
	}

	// check if department is in use in Course
	public function existInCourse($id, $d_type){
		if($id && $d_type == 'ttype') {
			$sql = "SELECT * FROM courses WHERE type_id = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
		if($id && $d_type == 'employee') {
			$sql = "SELECT * FROM courses WHERE employee_id = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
	}

}