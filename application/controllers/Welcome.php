<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}
	function Confirm()
	{
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

			if($this->form_validation->run()==TRUE)
			{
				echo 'hello world';
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$data = array (
					'username'=>$username,
					'email'=>$email,
					'password'=>sha1($password),
				);	
				$this->load->model('user_model');
				$this->user_model->insertuser($data);
				$this->session->set_flashdata('success','Successfully Created');
				redirect(base_url('welcome/index'));

			}
		}
	}
	function login(){
		$this->load->view('login');

	}

	function home(){
		$this->load->view('home');

	}
	function loginnow(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');


			if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email');
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));

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
					
					redirect(base_url('welcome/lobby'));
				}
				else{
					$this->session->set_flashdata('error', 'Incorrect Email or Password');
					redirect(base_url('welcome/login'));
				}
			}
			else{
				$this->session->set_flashdata('error','Fill all the required fields');
				redirect(base_url('welcome/login'));
			}


		}

	}

	function lobby(){
		$this->load->view('lobby');

	}
}
?>