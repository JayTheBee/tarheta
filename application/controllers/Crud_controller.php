<?php
	class Crud_controller extends CI_Controller{

		public function register(){
			// Loads library for forms

			$this->load->library('form_validation'); 
			//loads model needed
			$this->load->model('crud_model');
			
			// validation rules necessary for sanitizing inputs
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');

			//loading the view
			if($this->form_validation->run() === FALSE){			
				$this->load->view('crud_views');
				
			} else {			
				//if view loads, the password gets hashed with bcrypt
				$enc_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->crud_model->register($enc_password);

			}
		}

	}