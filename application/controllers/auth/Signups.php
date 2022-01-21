<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signups extends CI_Controller{


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
    * recaptcha inner function
    *
    * @param       none
    * @return      captcha response
    */
    private function _captcha() {
		if (($_SERVER['REQUEST_METHOD']=='POST' && $_POST['g-recaptcha-response'] != "")){
			$secret = env('RCAPTCHA_SECRET_KEY');// Secret key. Nasakin ung keys. si ramon kasi ung sa .env - ryle
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
			return $responseData = json_decode($verifyResponse);
		}
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
    * Function for validating inputs
    *
    * @param       none
    * @return      none
    */
	private function _signup_clean(){
		$data2var = array(
			'type' => $_SESSION['sess_user_type'],
		);

		$usernamevar = $this->input->post('username', TRUE);
		$emailvar = $this->input->post('email', TRUE);
		$passwordvar = $this->input->post('password', TRUE);

		$tokenvar = bin2hex(openssl_random_pseudo_bytes(10)); // Jedi okay na ba tong pang generate ng active_token or may better way ba?
		// $code2 = bin2hex(openssl_random_pseudo_bytes(10));	jedi:ito dapat removed
		//$datetime = new DateTime('tomorrow'); // @ryle pa fix Time not setting. 0:0:0 nagsasave sa DB
		// $datetime = time(); // hindi na 0:0:0 ung time. -ryle

		$datavar = array (
			'username'=>$usernamevar,
			'email'=>$emailvar,
			'password'=>password_hash($passwordvar, PASSWORD_DEFAULT),
			'active_token' => $tokenvar,
			// 'reset_token' => $code2,	jedi: ito rin dapat removed
			// 'reset_exp' =>  date('Y-m-d H:i:s', $datetime + 1 * 24 * 60 * 60)
		);

		$this->user_model->insert_user($datavar, $data2var);
		$this->_email_verify($usernamevar, $tokenvar, $emailvar);
	}


    /**
    * Main function for signups
    *
    * @param       none
    * @return      none
    */
	public function signup(){

		if ($this->_captcha()) { // '-> success' throws an error
				
				$this->form_validation->set_rules('username','Username','required|is_unique[users.username]'); //<- is_unique[dbTableName.FieldToBeChecked]
				$this->form_validation->set_rules('email','Email','required|is_unique[users.email]|valid_email');
				$this->form_validation->set_rules('password','Password','required');
				$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

				if($this->form_validation->run()){
					$this->_signup_clean();

				}else{
					$this->session->set_flashdata('error','Please enter valid information');
				}

				$this->_view('signup');
		}
		else{
			$this->session->set_flashdata('error','reCaptcha is Required.');
			$this->_view('signup');
		}
	}

    /**
    * Function for verifying email and sending email verification
    *
    * @param       string  		$username_arg  		 	username
    * @param       string   	$token_arg  	 		email verification token
    * @param       string 		$email_arg  		 	user email
    * @return      none
    */
	private function _email_verify($username_arg, $token_arg, $email_arg){
		$this->session->set_flashdata('success','Successfully Created. You can now login.');
		$mailvar = array(
			'subject' => "Tarheta | Activeate Account",
			'header' => "Activate your account",
			'username' => $username_arg,
			'body' => "Please click the the button to activate your account",
			'button' => "Activate",
			'link' => base_url()."/auth/signups/verify/".$username_arg."/".$token_arg,
		);

		$this->email->send_email($mailvar, 'templates/email', $email_arg);
		redirect(base_url('login'));
	}

    /**
    * Set session data user type as TEACHER 
    *
    * @param       none
    * @return      none
    */
    public function set_teacher(){
		$_SESSION['sess_user_type'] = "TEACHER";
		redirect(base_url('signup'));
	}

    /**
    * Set session data user type as STUDENT 
    *
    * @param       none
    * @return      none
    */
	public function set_student(){
		$_SESSION['sess_user_type'] = "STUDENT";
		redirect(base_url('signup'));
	}


   /**
    * public function for email verification
    *
    * @param       none
    * @return      none
    */
	public function verify(){
		$url = $this->_segment_url();
		$data = array(
			'active' => "Verified",
			'active_timestamp' => date('Y-m-d H:i:s', time()), 
		);

		
		$queryvar = $this->user_model->verify_account($data, $url['username'], $url['code']);
		if($queryvar){
			$this->_view('verified');
		}
	}
}