<?php 

    class user_model extends CI_Model{
        
        function insertuser($data,$data2){

            $this->db->trans_start();
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();

            $data2['user_id'] = $user_id;
            $this->db->insert('user_types', $data2);

            // $this->db->from('profile');  /* This is commented out since it works without it, but just in case.*/
            $this->db->set('user_id', $user_id);
            $this->db->insert('profile');

            $this->db->trans_complete();

            unset($_SESSION['usertype']);
        }

        function editprofile($data){
            return $this->db->update('profile',$data);
        }

        function emailCheck($email){
            $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
            if($query->num_rows()==1){
                return $query->row();
            }
            else{
                return false;
            }
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


        public function verifyAccount($data, $username, $code){
            $query = $this->db->query("SELECT * FROM users WHERE username='$username' AND active_token='$code'");
            if($query->num_rows() > 0){
                return $this->db->update('users', $data);
            }
        }

        function codeCheck($username, $code){
            $query = $this->db->query("SELECT * FROM users WHERE username='$username' AND reset_token='$code'");
            if($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function updatePassword($username,$password){
            $this->db->trans_start();
            $this->db->from('users');
            $this->db->set('password', $password);
            $this->db->where('username', $username);
            $this->db->update('users');
            $this->db->trans_complete();
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

