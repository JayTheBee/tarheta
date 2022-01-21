<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_passwords extends CI_Controller{

    public function __construct(){
		parent::__construct();
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('user_model');
	}

    /**
    * Staple view function for controllers
    *
    * @param       string  $page  		 page views title
    * @return      none
    */

    private function _view($page = 'home'){
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

		$data['title'] = ucfirst($page);

		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}

    /**
    * url segmenting that helps with routing and recognizing arguments
    *
    * @param       none
    * @return      array 	$segmentedURL		function arguments
    */
    private function _segment_url(){
		$segmentedURL = array(
			'username' => $this->uri->segment(4),
			'code' => $this->uri->segment(5),
		);
		return $segmentedURL;
	}


    /**
    * Main function for password reset, confirms password hashes
    *
    * @param       none
    * @return      array 	$segmentedURL		function arguments
    */	
	public function reset_main(){
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

		if($this->form_validation->run()){

			$passwordvar = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);

	
			$this->user_model->update_password($_SESSION['sess_reset_pass'], $passwordvar);

			$this->session->set_flashdata('success','Password changed successfully.');

			unset($_SESSION['sess_reset_pass']);
			redirect(base_url('login'));
		}
		else{
			$this->_view('reset-password');
			
		}
	}


    /**
    * Checks reset password token from email
    *
    * @param       none
    * @return      none
    */	
	public function token_check(){ 
		$data = $this->_segment_url();

		$query = $this->user_model->reset_token_check($data['username'], $data['code']);
		
		if($query){
			$_SESSION['sess_reset_pass'] = $data['username'];
			$this->_view('reset-password');
		}
		else{
			$this->session->set_flashdata('error','Invalid Token.');
			redirect(base_url('login'));
		}
	}

    /**
    * Sends password reset token to email
    *
    * @param       none
    * @return      none
    * 
    */	
	public function send_pass_email(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required|valid_email');

			if($this->form_validation->run()){
				$emailvar = $this->input->post('email', TRUE);

				$statusvar = $this->user_model->email_check($emailvar);

				if($statusvar){
					$statusvar->{'reset_token'} = $this->user_model->gen_new_token($statusvar->{'id'});
					/*
						* This array contains data to be passed to the email.php file which serves as 
							the content of the email.
					*/
					$data = array(
						'subject' => "Tarheta | Password Reset",
						'header' => "Reset your Password",
						'username' => $statusvar->{'username'},
						'body' => "Please click the the button to reset your password",
						'button' => "Reset",
						'link' => base_url()."auth/reset_passwords/token_check/".$statusvar->{'username'}."/".$statusvar->{'reset_token'},
					);

					$this->email->send_email($data, 'templates/email', $emailvar);
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