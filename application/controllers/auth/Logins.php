<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller{
    //jediboy: Modified function visibility for POLP. A function should always be private unless needed to be called on externally such as for views
	//jediboy: Added class constructs
	public function __construct(){
		parent::__construct();
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

    //jediboy: refactored
	private function login_redirect($status, $username, $email, $password){
		$username = $status->username;
		$email = $status->email;
		$session_data = array(
			'username'=>$username,
			'email'=>$email,
			'password'=>password_hash($password, PASSWORD_DEFAULT),
		);

		$query = $this->user_model->getProfile($email);
		$profile = (array) $query; //Typecasting from object to array
		$this->session->set_userdata('Profile',$profile);
		$this->session->set_userdata('UserLoginSession',$session_data);
		
		redirect(base_url('profile'));
	}

    public function login(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email', TRUE);
				$username = $this->input->post('username', TRUE);
				$password = $this->input->post('password',TRUE);
				$status = $this->user_model->passCheck($password,$email);

				if($status!=false){
					$this->login_redirect($status, $username, $email, $password);
				}
				else{
					$this->session->set_flashdata('error', 'Incorrect Email or Password');
					$this->view('login');
					// redirect(base_url('login'));
				}
			}
			else{
				$this->session->set_flashdata('error','Fill all the required fields');
				$this->view('login');
				// redirect(base_url('login'));
			}
		}
	}
	

	public function logout(){
		unset($_SESSION['UserLoginSession']);
		unset($_SESSION['Profile']);
		redirect(base_url());
	}
}