<?php 

class Model_indicators extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active Indicators information*/
	public function getActiveIndicators()
	{
		$sql = "SELECT * FROM indicators WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the Indicator data */
	public function getIndicatorData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM indicators WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM indicators";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('indicators', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('indicators', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('indicators');
			return ($delete == true) ? true : false;
		}
	}

}