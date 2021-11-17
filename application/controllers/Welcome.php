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
			/*
			* is_unique lang ginamit ko for checking if existing na yung username 
			* idk if robust na ito or is there a better way of doing it? 
			* may problem lang sa html ayaw magpakita nung errors sa set_rules
				like if nde matching yung password nde nagpapakita na "password does not match" or something
				along those lines.
			*/
			$this->form_validation->set_rules('username','Username','required|is_unique[users.username]'); //<- is_unique[dbTableName.FieldToBeChecked]
			$this->form_validation->set_rules('email','Email','required');
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
					'password'=>sha1($password),
				);	
				$this->load->model('user_model');
				$this->user_model->insertuser($data);
				$this->session->set_flashdata('success','Successfully Created');
			}
			redirect(base_url('welcome/index'));
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