<?php 

class classes_model extends CI_Model {

	function insertclasses($data, $user_id){
		$this->db->trans_start();
        $this->db->insert('classes', $data);
		$class_id = $this->db->insert_id();
		$this->userEnroll($class_id, $user_id, 'CREATOR');
		$this->db->trans_complete();
        return $class_id;

	}


	//fucntion to check for access first
	function getData(){
		$query = $this->db->query('SELECT * FROM classes');
		return $query->result();
	}

    private function userEnroll($class_id, $user_id, $role){
            $this->db->trans_start();
            $this->db->set('class_id', $class_id);	
            $this->db->set('user_id', $user_id);
            $this->db->set('role', $role);
            $this->db->insert('enroll');
            $this->db->trans_complete();
        }
}