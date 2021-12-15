<?php 

    class user_model extends CI_Model{
        
        public function insertuser($data,$data2){

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

        // function editprofile($data, $user){
        //     echo($user_id);
        //     exit();
        //     $query = $this->db->query("SELECT * FROM users WHERE username='$user'");
        //     $user_id = $query->row()->{'id'};
            
        //     $this->db->trans_start();
        //     $this->db->from('profile');
        //     $this->db->set('birthdate', $data['birthdate']);
        //     $this->db->set('firstname', $data['firstname']);
        //     $this->db->set('lastname', $data['lastname']);
        //     $this->db->set('school', $data['school']);
        //     $this->db->set('course', $data['course']);
        //     $this->db->where('user_id', $user_id);
            
        //     $this->db->update('profile');
        //     return $this->db->trans_complete();
        //     return $this->db->update('profile',$data);
	    // }

        public function emailCheck($email){
            $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
            if($query->num_rows()==1){
                return $query->row();
            }
            else{
                return false;
            }
        }


        public function passCheck($password,$email){
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
                //return $this->db->update('users', $data);
                $this->db->trans_start();
                $this->db->from('users');
                $this->db->set('active', $data['active']);
                $this->db->set('active_timestamp', $data['active_timestamp']);
                $this->db->where('username', $username);
                $this->db->update('users');
                return $this->db->trans_complete();
            }
        }

        public function codeCheck($username, $code){
            $query = $this->db->query("SELECT * FROM users WHERE username='$username' AND reset_token='$code'");
            if(($query->num_rows() > 0) && (strtotime($query->row('reset_exp')) > time())){ //Checks if the reset_exp > current time meaning it is still valid
                return true;
            }
            else{
                return false;
            }
        }

        public function updatePassword($username,$password){
            $this->db->trans_start();
            $this->db->from('users');
            $this->db->set('password', $password);
            $this->db->set('reset_token', 'NULL', false);
            $this->db->set('reset_exp', 'NULL', false);
            $this->db->where('username', $username);
            $this->db->update('users');
            $this->db->trans_complete();
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

        public function genNewResetToken($id){
            $datetime = time(); //Sets the new expiry +24 Hours
            $newToken = bin2hex(openssl_random_pseudo_bytes(10)); //Generating new reset token
            $this->db->trans_start();
            $this->db->from('users');
            $this->db->set('reset_token', $newToken);
            $this->db->set('reset_exp', date('Y-m-d H:i:s', $datetime + 1 * 24 * 60 * 60)); // 17 hours Validity. -ryle
            $this->db->where('id', $id);
            $this->db->update('users');
            $this->db->trans_complete();
            return $newToken;
        }
    }

?>

