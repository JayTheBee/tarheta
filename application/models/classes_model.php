<?php 

class classes_model extends CI_Model {

	function insertclasses($data, $user_id){
		$this->db->trans_start();
        $this->db->insert('classes', $data);
		$class_id = $this->db->insert_id();
		$this->userEnroll($class_id, $user_id, 'CREATOR');
		$this->db->trans_complete();

	}


	//fucntion to check for access first
	function getClass(){
        $user_id = $_SESSION['Profile']['user_id'];
        $query = $this->db->query("SELECT * FROM enroll WHERE user_id='$user_id'");
        $access = $query->result_array();
        
        $result = array();
        
        foreach($access as $class){
            $class_id = $class['class_id'];
	        //Getting the user's classes
	        $query = $this->db->query("SELECT * FROM classes WHERE id='$class_id'");
	        if($query->num_rows()==1){
	            array_push($result, $query->row_array());
	        };
        }
        return $result;
	}


	function showClass($class_id){
        $query = $this->db->query("SELECT * FROM classes WHERE id='$class_id'");
	    return $query->row_array();
	}

	//Changed to public since it is needed for the join class
    function userEnroll($class_id, $user_id, $role){
            $this->db->trans_start();
            $this->db->set('class_id', $class_id);	
            $this->db->set('user_id', $user_id);
            $this->db->set('role', $role);
            $this->db->insert('enroll');
            $this->db->trans_complete();
    }

    function verifyCode($code){
    	$query = $this->db->query("SELECT * FROM classes WHERE invite_code='$code'");
    	if($query->num_rows()==1){
    		return $query->row();
    	}else{
    		return false;
    	}
    }


}