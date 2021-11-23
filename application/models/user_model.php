<?php 

    class user_model extends CI_Model{
        
        function insertuser($data)
        {
            $this->db->insert('users',$data);
        }

        function passCheck($password,$email)
        {
            $query = $this->db->query("SELECT * FROM users WHERE email='$email'");

            if($query->num_rows()==1)
            {
                /*
                    Sinnce pinalitan yung form of hashing may default rin syang pang verify. Read Here:
                    https://www.php.net/manual/en/function.password-verify.php
                */
                if (password_verify($password, $query->row('password'))){
                    return $query->row();
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }
        }
    }

?>

