<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Nirename ko lang yung Welcome controller to Auth

class Auth extends CI_Controller {
	function signup(){

		if (($_SERVER['REQUEST_METHOD']=='POST' && $_POST['g-recaptcha-response'] != "")){
			$secret = '';// Secret key. Nasakin ung keys. si ramon kasi ung sa .env - ryle
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);

					if ($responseData->success) {

						if($_SERVER['REQUEST_METHOD']=='POST'){
							$this->load->library('form_validation');
							$this->form_validation->set_rules('username','Username','required|is_unique[users.username]'); //<- is_unique[dbTableName.FieldToBeChecked]
							$this->form_validation->set_rules('email','Email','required|is_unique[users.email]|valid_email');
							$this->form_validation->set_rules('password','Password','required');
							$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

							if($this->form_validation->run()==TRUE){
								$this->load->helper('security');
								$data2 = array(
									'type' => $_SESSION['usertype'],
								);

								$username = $this->input->post('username', TRUE);
								$email = $this->input->post('email', TRUE);
								$password = $this->input->post('password', TRUE);
								$code = bin2hex(openssl_random_pseudo_bytes(10)); // Jedi okay na ba tong pang generate ng active_token or may better way ba?
								$code2 = bin2hex(openssl_random_pseudo_bytes(10));

								$data = array (
									'username'=>$username,
									'email'=>$email,
									'password'=>password_hash($password, PASSWORD_DEFAULT),
									'active_token' => $code,
									'reset_token' => $code2,
								);

								$this->load->model('user_model');
								$this->user_model->insertuser($data, $data2);
								$this->session->set_flashdata('success','Successfully Created. You can now login.');

								$mail = array(
									'subject' => "Tarheta | Activeate Account",
									'header' => "Activate your account",
									'username' => $username,
									'body' => "Please click the the button to activate your account",
									'button' => "Activate",
									'link' => base_url()."auth/verify/".$username."/".$code,
								);
								$this->sendEmail($mail, 'templates/email', $email);

								redirect(base_url('login'));
							}

							$this->load->view('templates/header');
							$this->load->view('pages/signup');
							$this->load->view('templates/footer');
						}
					}
				}
				else{
					$this->session->set_flashdata('error','reCaptcha is Required.');
					redirect(base_url('signup'));
				}
			}

	function segmentURL(){
		$segmentedURL = array(
			'username' => $this->uri->segment(3),
			'code' => $this->uri->segment(4),
		);
		return $segmentedURL;
	}


	function verify(){
		$url = $this->segmentURL();
		$data = array(
			'active' => "Verified",
			'active_timestamp' => date('Y/m/d h:i:s'), // To be Improved. Issue mali pa ung time pero okay ung date.
		);

		$this->load->model('user_model');
		$query = $this->user_model->verifyAccount($data, $url['username'], $url['code']);
		if($query){
			$this->load->view('templates/header');
			$this->load->view('pages/verified');
			$this->load->view('templates/footer');
		}
	}

	
	public function setTeacher(){
		$_SESSION['usertype'] = "TEACHER";
		redirect(base_url('signup'));
	}

	public function setStudent(){
		$_SESSION['usertype'] = "STUDENT";
		redirect(base_url('signup'));
	}
	

	function login(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email', TRUE);
				$username = $this->input->post('username', TRUE);
				$password = $this->input->post('password',TRUE);

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

					$query = $this->user_model->getProfile($email);
					$profile = (array) $query; //Typecasting from object to array
					$this->session->set_userdata('Profile',$profile);
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
		unset($_SESSION['Profile']);
		redirect(base_url());
	}


	/////////////////////////////* RESET PASSWORD FUNCTIONS */////////////////////////////

	/* Function wherein it handle taking in the new password and sending it to the model */
	function resetPassword(){
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

		if($this->form_validation->run()==TRUE){
			$this->load->helper('security');
			$password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);

			$this->load->model('user_model');
			$this->user_model->updatePassword($_SESSION['resetpassword'], $password);

			$this->session->set_flashdata('success','Password changed successfully.');

			unset($_SESSION['resetpassword']);
			redirect(base_url('login'));
		}
		else{
			$this->load->view('templates/header');
			$this->load->view('pages/reset-password');
			$this->load->view('templates/footer');
		}
	}


	/* Function to extract the code and username in the reset password link and sends it to the model */
	function resetPassCheck(){
		$data = $this->segmentURL();
		$this->load->model('user_model');
		$query = $this->user_model->codeCheck($data['username'], $data['code']);
		
		if($query){
			$_SESSION['resetpassword'] = $data['username'];
			$this->load->view('templates/header');
			$this->load->view('pages/reset-password');
			$this->load->view('templates/footer');
		}
		else{
			$this->session->set_flashdata('error','Token Invalid.');
			redirect(base_url('login'));
		}
	}


	/* Function that sends the reset password link to the entered email */
	public function sendPassReset(){
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email');

				$this->load->model('user_model');
				
				$status = $this->user_model->emailCheck($email);

				if($status!=false){
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
						'link' => base_url()."auth/resetPassCheck/".$status->{'username'}."/".$status->{'reset_token'},
					);
					
					$this->sendEmail($data, 'templates/email', $email);

					$this->session->set_flashdata('success','Password reset email sent.');
					redirect(base_url('login'));
				}
				else{
					$this->session->set_flashdata('error','Email not registered in the database.');
					redirect(base_url('login'));
				}
				
			}
			else{
				$this->session->set_flashdata('error','No email entered for password reset.');
				redirect(base_url('login'));
			}
		}
	}

	/*
		* I decided to also pass in the email template maybe we can use this function to send another 
			email but with a different template. ie Email when you joined a class or something.
	*/
	function sendEmail($data, $emailTemplate, $email){
		/*
	 		* Changed the email sending. It now builds on this: https://www.youtube.com/watch?v=ctUUxx0Klng
			 	but it loads a php file rather than a string.
		*/
		$to = $email;
		$subject = $data['subject'];
		$from = 'tarheta.app@gmail.com';

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_timeout'] = '60';
		
		$config['smtp_user'] = 'tarheta.app@gmail.com';
		$config['smtp_pass'] = 'Qw3rtyu!';
		
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE;

		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);

		$this->email->message($this->load->view($emailTemplate,$data,true));
		$this->email->send();
	}
}
?>