<?php 

class classes_model extends CI_Model {

	function insertclasses($data)
	{
        $this->db->insert('classes', $data);
	}


	//should check for access first
	function getData(){
		$query = $this->db->query('SELECT * FROM classes');
		return $query->result();
	}
}