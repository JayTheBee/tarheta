<?php 

    class user_model extends CI_Model{
        
        function insertuser($data,$usertype){
            $this->db->from('users');
            $this->db->set($data);
            $this->db->insert('users');

            $this->db->from('users');
            $this->db->where('email', $data['email']);  // Finding the user in the users table via email
            $userQuery = $this->db->get();
            $user = $userQuery->result_array(); //Saving the row values to a variable
            
            /*
                * Jedi feeling ko pangit itong way ko hahah medyo bruteforce kasi ayaw gumana ng 
                    join or baka may mali akong ginawa pero nagana ito
                * Pero pag nag delete ka sa myPhpAdmin nagcacascade yung delete
            */
            
            // Saving the usertype on the user_types Table
            $data2  = array(
                'user_id' => $user[0]['id'],    // Multidementional array sya kaya may '[0]'
                'type' => $usertype,
            );
            $this->db->from('user_types');
            $this->db->set($data2);
            $this->db->insert('user_types');

            $data3 = array(
                'user_id' => $user[0]['id'],
            );

            // Linking the user_if from the user table to the profile table
            $this->db->from('profile');
            $this->db->set($data3);
            $this->db->insert('profile');

            unset($_SESSION['usertype']);
        }


        function passCheck($password,$email){
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


        function saveUserType(){
            $query -$this->db->query("SELECT * FROM user_types");
        }
    }

?>

