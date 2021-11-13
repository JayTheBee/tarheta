<?php 

    class user_model extends CI_Model{
        
        function insertuser($data)
        {
            $this->db->insert('users',$data);
        }

        function passCheck($password,$email)
        {
            echo "test";
            $query = $this->db->query("SELECT * FROM users WHERE password='$password' AND email='$email'");
            if($query->num_rows()==1)
            {
                return $query->row();
            }
            else{
                return false;
            }
        }
    }

?>

