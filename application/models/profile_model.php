<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class Profile_model extends CI_Model{

        /**
        * Edits profile table information
        *
        * @param       array  $data_arg         Information for users table
        * @param       string  $user_arg        Information for user_types table
        * @return      transaction result or FALSE
        */
        public function edit_profiledb($data_arg, $user_arg){
            $queryvar = $this->db->query("SELECT * FROM users WHERE username='$user_arg'");
            
            if($queryvar->num_rows() == 1){
                $user_idvar = $queryvar->row()->{'id'};
                $this->db->trans_start();
                $this->db->from('profile');
                $this->db->where('user_id', $user_idvar);    
                $this->db->update('profile', $data_arg);
                return $this->db->trans_complete();
            }else{
                return FALSE;
            }
	    }

       /**
        * Get profile table information
        *
        * @param       string  $email_arg           user email
        * @return      query result or FALSE
        */
        public function get_profile($email_arg){
            $queryvar = $this->db->query("SELECT * FROM users WHERE email='$email_arg'");
            $idvar = $queryvar->row()->{'id'};

            if($queryvar->num_rows()==1){
                $query2var = $this->db->query("SELECT * FROM profile WHERE user_id='$idvar'");
                return $query2var->row();
            }
            else{
                return FALSE;
            }
        }
    }

