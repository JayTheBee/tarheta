<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('user_model');
		$this->load->model('profile_model');
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
    * Sets session data after confirming user login
    *
    * @param       obj  	 $status_arg  			 db query
    * @param       string  	 $password_arg  		 password
    * @return      none
    */
	private function _login_redirect($status_arg, $password_arg){
		$usernamevar = $status_arg->username;
		$emailvar = $status_arg->email;

		$session_data = array(
			'username'=> $usernamevar ,
			'email'=> $emailvar,
			'password'=>password_hash($password_arg, PASSWORD_DEFAULT),
		);

		$queryvar = $this->profile_model->get_profile($emailvar);
		$query2var = $this->user_model->get_type($emailvar);
		$profilevar = (array) $queryvar; 
		$typevar = (array) $query2var;

		$this->session->set_userdata('sess_user_type', $typevar);
		$this->session->set_userdata('sess_profile', $profilevar);
		$this->session->set_userdata('sess_login', $session_data);
		
		redirect(base_url('profile'));
	}

    /**
    * Confirms user login and sets error flash if false
    *
    * @param       none
    * @return      none
    */

    public function login(){

		if($_SERVER['REQUEST_METHOD']=='POST'){

			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run()){
				$emailvar = $this->input->post('email', TRUE);
				$passwordvar = $this->input->post('password', TRUE);

				$statusvar = $this->user_model->user_check($passwordvar, $emailvar);

				if($statusvar){
					$this->_login_redirect($statusvar, $passwordvar);
				}
				else{
					$this->session->set_flashdata('error', 'Incorrect email or password!');
					$this->_view('login');
				}
			}
			else{
				$this->session->set_flashdata('error','Fill all the required fields!');
				$this->_view('login');
			}
		}
	}
	
    /**
    * Removes session data and redirects to home page
    *
    * @param       none
    * @return      none
    */
	public function logout(){
		unset($_SESSION['sess_login']);
		unset($_SESSION['sess_profile']);
		unset($_SESSION['sess_user_type']);
		redirect(base_url());
	}
}