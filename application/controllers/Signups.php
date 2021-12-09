<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signups extends CI_Controller{
    //jediboy: Modified function visibility for POLP. A function should always be private unless needed to be called on externally such as for views
	//jediboy: Added class constructs
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

    private function captcha() {
		if (($_SERVER['REQUEST_METHOD']=='POST' && $_POST['g-recaptcha-response'] != "")){
			$secret = env('RCAPTCHA_SECRET_KEY');// Secret key. Nasakin ung keys. si ramon kasi ung sa .env - ryle
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
			return $responseData = json_decode($verifyResponse);
		}
	}

    private function segmentURL(){
		$segmentedURL = array(
			'username' => $this->uri->segment(3),
			'code' => $this->uri->segment(4),
		);
		return $segmentedURL;
	}

    //jediboy: refactored
	private function signup_clean(){
		$data2 = array(
			'type' => $_SESSION['usertype'],
		);

		$username = $this->input->post('username', TRUE);
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$code = bin2hex(openssl_random_pseudo_bytes(10)); // Jedi okay na ba tong pang generate ng active_token or may better way ba?
		$code2 = bin2hex(openssl_random_pseudo_bytes(10));
		$datetime = new DateTime('tomorrow'); // @ryle pa fix Time not setting. 0:0:0 nagsasave sa DB

		$data = array (
			'username'=>$username,
			'email'=>$email,
			'password'=>password_hash($password, PASSWORD_DEFAULT),
			'active_token' => $code,
			'reset_token' => $code2,
			'reset_exp' =>  $datetime->format('Y-m-d H:i:s')
		);

		$this->user_model->insertuser($data, $data2);
		$this->email_verify($username, $code, $email);
	}

    //jediboy:refactored
	public function signup(){

		if ($this->captcha()) { // '-> success' throws an error
				
				$this->form_validation->set_rules('username','Username','required|is_unique[users.username]'); //<- is_unique[dbTableName.FieldToBeChecked]
				$this->form_validation->set_rules('email','Email','required|is_unique[users.email]|valid_email');
				$this->form_validation->set_rules('password','Password','required');
				$this->form_validation->set_rules('confirm_password','Confrim Password','required|matches[password]');

				if($this->form_validation->run()==TRUE){
					$this->signup_clean();
				}
				$this->view('signup');
				// $this->load->view('templates/header');
				// $this->load->view('pages/signup');
				// $this->load->view('templates/footer');
		}
		else{
			$this->session->set_flashdata('error','reCaptcha is Required.');
			$this->view('signup');
		}
	}

    //jediboy:refactored
	private function email_verify($username, $code, $email){

		$this->session->set_flashdata('success','Successfully Created. You can now login.');
		$mail = array(
			'subject' => "Tarheta | Activeate Account",
			'header' => "Activate your account",
			'username' => $username,
			'body' => "Please click the the button to activate your account",
			'button' => "Activate",
			'link' => base_url()."signups/verify/".$username."/".$code,
		);

		$this->email->send_email($mail, 'templates/email', $email);
		redirect(base_url('login'));
	}

    public function setTeacher(){
		$_SESSION['usertype'] = "TEACHER";
		redirect(base_url('signup'));
	}

	public function setStudent(){
		$_SESSION['usertype'] = "STUDENT";
		redirect(base_url('signup'));
	}

	public function verify(){
		$url = $this->segmentURL();
		$data = array(
			'active' => "Verified",
			'active_timestamp' => date('Y/m/d h:i:s'), // To be Improved. Issue mali pa ung time pero okay ung date.
		);

		
		$query = $this->user_model->verifyAccount($data, $url['username'], $url['code']);
		if($query){
			$this->view('verified');
			// $this->load->view('templates/header');
			// $this->load->view('pages/verified');
			// $this->load->view('templates/footer');
		}
	}
}