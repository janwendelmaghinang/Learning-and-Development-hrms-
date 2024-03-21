<?php 

class Model_employees extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveEmployee()
	{
		$sql = "SELECT * FROM users WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */

	public function getEmployeeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id !=1 AND role_id != '' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();
			$group_data = array(
				'user_id' => $user_id,
				'group_id' => $data['role_id']
			);

			$group_data = $this->db->insert('user_group', $group_data);

			return ($insert == true && $group_data) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('users', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('users');
			return ($delete == true) ? true : false;
		}
	}

	public function getEmployeeByDeptAndDesigData($department = null, $designation = null)
	{
		if($department && $designation) {
			$sql = "SELECT * FROM users WHERE department_id = ? AND designation_id = ? AND id != 1";
			$query = $this->db->query($sql,array($department,$designation));
			return $query->result_array();
		}

	}
	// check if department is in use in employee
	// public function existInEmployee($id){
	// 	if($id) {
	// 		$sql = "SELECT * FROM employee WHERE department_id = ?";
	// 		$query = $this->db->query($sql, array($id));
	// 		return ($query->num_rows()) ? true : false;
	// 	}
	// }

}