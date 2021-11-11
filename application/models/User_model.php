<?php
	class User_model extends CI_Model{
		//model accepts hashed password
		public function register($enc_password){
			
			$this->load->database();
			// User data array

			$data = array(
				
                'user' => $this->input->post('username'),
                'pass' => $enc_password,
                
			);

			// Insert user mysql command
			return $this->db->insert('usersignup', $data);
		}

	}