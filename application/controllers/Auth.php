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
				$data2 = array(
					'type' => 0,
					'user_id' => -1,
				);
				//Switch case para sa user_type na pagset ng value wherein Teacher ay index 2 sa enum while Student ay index 1 sa enum
				switch($_SESSION['usertype']){ 
					case 'Student':
						$data2['type'] = 1;
						break;
					case 'Teacher':
						$data2['type'] = 2;
						break;
				}

				$username = $this->input->post('username', TRUE);
				$email = $this->input->post('email', TRUE);
				$password = $this->input->post('password', TRUE);
				$code = bin2hex(openssl_random_pseudo_bytes(10)); // Jedi okay na ba tong pang generate ng active_token or may better way ba?


				$data = array (
					'username'=>$username,
					'email'=>$email,
					'password'=>password_hash($password, PASSWORD_DEFAULT),
					'active_token' => $code,

					/*
						* Pinalitan yung pass hashing using the default php hashing. Read more:
						https://www.php.net/manual/en/function.password-hash.php
					*/

				);

				$this->load->model('user_model');
				$this->user_model->insertuser($data, $data2);
				$this->session->set_flashdata('success','Successfully Created. You can now login.');

				// Sending Email
				$to = $email; // Send email to our user
                $subject = 'Signup | Verification'; // Give the email a subject 
                $message = "

                    Thank you for Registering.

                    Your Account:
                    Email: ".$email."
                    Please click the link below to activate your account.
                    ".base_url()."auth/verify/".$username."/".$code."

                "; // Our message above including the link

                $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers

                $msg = mail($to, $subject, $message, $headers); // Send our email

				redirect(base_url('login'));
			}

			$this->load->view('templates/header');
			$this->load->view('pages/signup');
			$this->load->view('templates/footer');

		}
	}



	function verify(){
		$username = $this->uri->segment(3); //get email from url
		$code = $this->uri->segment(4); //get code from url
		$data = array(
			'active' => 1,
			'active_timestamp' => date('Y/m/d h:i:s'), // To be Improved. Issue mali pa ung time pero okay ung date.
		);

		$this->load->model('user_model');
		$query = $this->user_model->verifyAccount($data, $username, $code);
		if($query){
			$this->load->view('templates/header');
			$this->load->view('pages/verified');
			$this->load->view('templates/footer');
		}
	}

	
	public function setTeacher(){
		$_SESSION['usertype'] = "Teacher";
		redirect(base_url('signup'));
	}

	public function setStudent(){
		$_SESSION['usertype'] = "Student";
		redirect(base_url('signup'));
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
						'password'=>password_hash($password, PASSWORD_DEFAULT),
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

	public function logout(){
		unset($_SESSION['UserLoginSession']);
		//$this->session->session_destroy();
		redirect(base_url());
	}

}
?>
