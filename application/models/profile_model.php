<?php 

    class profile_model extends CI_Model{

        public function editprofile($data, $user){
            $query = $this->db->query("SELECT * FROM users WHERE username='$user'");
            $user_id = $query->row()->{'id'};
            
            $this->db->trans_start();
            $this->db->from('profile');
            $this->db->where('user_id', $user_id);    
            $this->db->update('profile', $data);
            return $this->db->trans_complete();
	    }


        public function getProfile($email){
            $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
            $id = $query->row()->{'id'};
            if($query->num_rows()==1){
                $query2 = $this->db->query("SELECT * FROM profile WHERE user_id='$id'");
                return $query2->row();
            }
            else{
                return false;
            }
        }
    }

?>

