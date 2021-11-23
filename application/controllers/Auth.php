<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Nirename ko lang yung Welcome controller to Auth

class Auth extends CI_Controller {
	function signup()
	{
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			/*
				* is_unique lang ginamit ko for checking if existing na yung username 
				* idk if robust na ito or is there a better way of doing it? 
			*/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username','required|is_unique[users.username]'); //<- is_unique[dbTableName.FieldToBeChecked]
			$this->form_validation->set_rules('email','Email','required|is_unique[users.email]');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

			if($this->form_validation->run()==TRUE)
			{
				/*
					* IDK if ito yung tamang xss filtering nakita ko dito https://stackoverflow.com/questions/36575129/how-to-remove-xss-clean-in-ci3
					* Ineable ko rin yung sa config.php na "global_xss_filtering" to TRUE accourding dito https://codeigniter.com/userguide3/libraries/input.html 
						Pero nde ko masasama sa commit yung config.php
				*/
				$this->load->helper('security'); 
				$username = $this->input->post('username', TRUE);
				$email = $this->input->post('email', TRUE);
				$password = $this->input->post('password', TRUE);

				$data = array (
					'username'=>$username,
					'email'=>$email,
					'password'=>password_hash($password, PASSWORD_DEFAULT),
					/*
						* Pinalitan yung pass hashing using the default php hashing. Read more:
						https://www.php.net/manual/en/function.password-hash.php
					*/
				);	
				$this->load->model('user_model');
				$this->user_model->insertuser($data);
				$this->session->set_flashdata('success','Successfully Created. You can now login.');
				redirect(base_url('login'));
			}

			$this->load->view('templates/header');
			$this->load->view('pages/signup');
			$this->load->view('templates/footer');

		}
	}
	

	function login(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');


			if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email');
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$this->load->model('user_model');
				
				$status = $this->user_model->passCheck($password,$email);
				if($status!=false){
					$username = $status->username;
					$email = $status->email;
					$session_data = array(
						'username'=>$username,
						'email'=>$email,
						'password'=>$password,
					);
					
					$this->session->set_userdata('UserLoginSession',$session_data);
					
					redirect(base_url('profile'));
				}
				else{
					$this->session->set_flashdata('error', 'Incorrect Email or Password');
					redirect(base_url('login'));
				}
			}
			else{
				$this->session->set_flashdata('error','Fill all the required fields');
				redirect(base_url('login'));
			}
		}
	}
}
?>