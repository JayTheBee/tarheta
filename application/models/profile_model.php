<?php 

    class profile_model extends CI_Model{

        function editprofile($data){
            return $this->db->update('profile',$data);
        }


        function getProfile($email){
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

