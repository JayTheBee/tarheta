<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpasswords extends CI_Controller{
    public function __construct(){
		parent::__construct();
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('user_model');
	}

    private function view($page = 'home'){
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

		$data['title'] = ucfirst($page);

		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}

    private function segmentURL(){
		$segmentedURL = array(
			'username' => $this->uri->segment(4),
			'code' => $this->uri->segment(5),
		);
		return $segmentedURL;
	}

/////////////////////////////* RESET PASSWORD FUNCTIONS */////////////////////////////

	/* Function wherein it handle taking in the new password and sending it to the model */
	public function resetPassword(){
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

		if($this->form_validation->run()==TRUE){

			$password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);

	
			$this->user_model->updatePassword($_SESSION['resetpassword'], $password);

			$this->session->set_flashdata('success','Password changed successfully.');

			unset($_SESSION['resetpassword']);
			redirect(base_url('login'));
		}
		else{
			$this->view('reset-password');
			// $this->load->view('templates/header');
			// $this->load->view('pages/reset-password');
			// $this->load->view('templates/footer');
		}
	}


	/* Function to extract the code and username in the reset password link and sends it to the model */
	public function resetPassCheck(){ //Changed to public since it needs to be access when resetting the password
		$data = $this->segmentURL();

		$query = $this->user_model->codeCheck($data['username'], $data['code']);
		
		if($query){
			$_SESSION['resetpassword'] = $data['username'];
			$this->view('reset-password');
			// $this->load->view('templates/header');
			// $this->load->view('pages/reset-password');
			// $this->load->view('templates/footer');
		}
		else{
			$this->session->set_flashdata('error','Invalid Token.');
			redirect(base_url('login'));
		}
	}


	/* Function that sends the reset password link to the entered email */
	public function sendPassReset(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email');

				$status = $this->user_model->emailCheck($email);
				//generate new token upon password reset request

				if($status!=false){
					$status->{'reset_token'} = $this->user_model->genNewResetToken($status->{'id'});
					/*
						* This array contains data to be passed to the email.php file which serves as 
							the content of the email.
					*/
					$data = array(
						'subject' => "Tarheta | Password Reset",
						'header' => "Reset your Password",
						'username' => $status->{'username'},
						'body' => "Please click the the button to reset your password",
						'button' => "Reset",
						'link' => base_url()."auth/resetpasswords/resetPassCheck/".$status->{'username'}."/".$status->{'reset_token'},
					);

					$this->email->send_email($data, 'templates/email', $email);

					$this->session->set_flashdata('success','Password reset email sent.');
					redirect(base_url('login'));
				}
				else{
					$this->session->set_flashdata('error','Email not registered!');
					redirect(base_url('login'));
				}
				
			}
			else{
				$this->session->set_flashdata('error','No email entered for password reset!');
				redirect(base_url('login'));
			}
		}
    }
}