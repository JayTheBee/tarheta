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
            $this->db->from('users');
            // FOR FUTURE RAMON: Please condense yung db->where may naaalala ka noon na mas better way nde mo lang mahanap check docs
            $this->db->where('username ', $username);
            $this->db->where('active_token ', $code);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $this->db->update('users', $data);
            }
        }
    }

?>

