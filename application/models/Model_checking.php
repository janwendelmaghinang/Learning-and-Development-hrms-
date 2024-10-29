<?php
 
 class Model_checking extends Ci_Model {

    public function __construct()
	{
		parent::__construct();
	}
    
    public function existing($db, $attr, $id){
		if($id) {
			$sql = "SELECT * FROM $db WHERE $attr = ?";
			$query = $this->db->query($sql, array($id));
			return ($query->num_rows()) ? true : false;
		}
	}

 }