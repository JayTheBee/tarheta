<?php 

class classes_model extends CI_Model {

	function insertclasses($data)
	{
        $this->db->insert('classes', $data);
	}
}