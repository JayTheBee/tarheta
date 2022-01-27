<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model{

        /**
        * Inserts new user inside database
        *
        * @param       array  $data_arg    Information for users table
        * @param       array  $data2_arg   Information for user_types table
        * @return      none
        */
        public function insert_user($data_arg, $data2_arg){

            $this->db->trans_start();
            $this->db->insert('users', $data_arg);
            $user_idvar = $this->db->insert_id();
            $data2_arg['user_id'] = $user_idvar;
            $this->db->insert('user_types', $data2_arg);

            // $this->db->from('profile');  /* This is commented out since it works without it, but just in case.*/
            $this->db->set('user_id', $user_idvar);
            $this->db->insert('profile');

            $this->db->trans_complete();

            unset($_SESSION['sess_user_type']); 
        }

        /**
        * Checks if email exists within users table
        *
        * @param       string  $email_arg    user email
        * @return      query result or FALSE
        */
        public function email_check($email_arg){
            $queryvar = $this->db->query("SELECT * FROM users WHERE email='$email_arg'");
            if($queryvar->num_rows()==1){
                return $queryvar->row();
            }
            else{
                return FALSE;
            }
        }

        /**
        * Checks if password and email matches a user in users table
        *
        * @param       string  $email_arg        user email
        * @param       string  $password_arg     user password unhashed
        * @return      query result or FALSE
        */
        public function user_check($password_arg, $email_arg){
            $queryvar = $this->db->query("SELECT * FROM users WHERE email='$email_arg'");

            if($queryvar->num_rows()==1)
            {
                /*
                    Sinnce pinalitan yung form of hashing may default rin syang pang verify. Read Here:
                    https://www.php.net/manual/en/function.password-verify.php
                */
                if(password_verify($password_arg, $queryvar->row('password'))){
                    return $queryvar->row();
                }
                else{
                    return FALSE;
                }
            }
            else{
                return FALSE;
            }
        }

        /**
        * Makes user email verified in the database
        *
        * @param       string  $username_arg        username
        * @param       string  $token_arg           email activation token
        * @param       array   $data_arg            email activation array
        * @return      transaction result or FALSE
        */
        public function verify_account($data_arg, $username_arg, $token_arg){

            $queryvar = $this->db->query("SELECT * FROM users WHERE username='$username_arg' AND active_token='$token_arg'");
            if($queryvar->num_rows() == 1){
                
                $this->db->trans_start();
                $this->db->from('users');
                $this->db->set('active', $data_arg['active']);
                $this->db->set('active_timestamp', $data_arg['active_timestamp']);
                $this->db->where('username', $username_arg);
                $this->db->update('users');

                return $this->db->trans_complete();
            }else{
                return FALSE;
            }
        }


        /**
        * Checks if reset password token is true
        *
        * @param       string  $username_arg        username
        * @param       string  $token_arg           reset password token
        * @return      bool
        */

        public function reset_token_check($username_arg, $token_arg){
            $queryvar = $this->db->query("SELECT * FROM users WHERE username='$username_arg' AND reset_token='$token_arg'");
            if(($queryvar->num_rows() > 0) && (strtotime($queryvar->row('reset_exp')) > time())){ //Checks if the reset_exp > current time meaning it is still valid
                return TRUE;
            }
            else{
                return FALSE;
            }
        }

        /**
        * Updates password after reset password check
        *
        * @param       string  $username_arg        username
        * @param       string  $password_arg        user password hashed
        * @return      none
        */
        public function update_password($username_arg, $password_arg){
            $this->db->trans_start();
            $this->db->from('users');
            $this->db->set('password', $password_arg);
            $this->db->set('reset_token', 'NULL', FALSE);
            $this->db->set('reset_exp', 'NULL', FALSE);
            $this->db->where('username', $username_arg);
            $this->db->update('users');
            $this->db->trans_complete();
        }

        /**
        * Gets user type
        *
        * @param       string  $email_arg           user email
        * @return      query result or FALSE
        */
        public function get_type($email_arg){
            $queryvar = $this->db->query("SELECT * FROM users WHERE email='$email_arg'");
            $idvar = $queryvar->row()->{'id'};

            if($queryvar->num_rows()==1){
                $query2var = $this->db->query("SELECT * FROM user_types WHERE user_id='$idvar'");
                return $query2var->row();
            }
            else{
                return FALSE;
            }
        }

        /**
        * Generates new token for reseting password 
        *
        * @param       int     $id_arg              user id
        * @return      cryptographically secure token
        */
        public function gen_new_token($id_arg){
            $datetime = time(); //Sets the new expiry +24 Hours
            $new_token = bin2hex(openssl_random_pseudo_bytes(10)); //Generating new reset token

            $this->db->trans_start();
            $this->db->from('users');
            $this->db->set('reset_token', $new_token);
            $this->db->set('reset_exp', date('Y-m-d H:i:s', $datetime + 1 * 24 * 60 * 60)); // 17 hours Validity. -ryle
            $this->db->where('id', $id_arg);
            $this->db->update('users');
            $this->db->trans_complete();

            return $new_token;
        }
        public function user_active_check($user_id){
            $query = $this->db->query("SELECT * FROM users WHERE id='$user_id' AND active='Active'");
            if($query->num_rows()==1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

?>

