<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('user_model');
		$this->load->model('profile_model');
		$this->load->model('classes_model');
		$this->load->model('notification_model');
		$this->load->helper('url');
	}


	/**
	 * Main function to handle loading the view file
	 */
	public function view($page){
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}
		$data2['notif_count'] = $this->notification_model->get_notif_count($_SESSION['sess_profile']['user_id']);
		$data['title'] = ucfirst($page);
		$this->load->view('templates/header-logged', $data2);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}


    /**
    * Main function for editing profile. Validates input, filters xss, and checks for empty inputs.
    *
    * @param       none
    * @return      none
    */
    public function edit_profile(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
  
			$this->form_validation->set_rules('firstname', 'First Name','trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('lastname', 'Last Name','trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('birthdate', 'Birthday');
			$this->form_validation->set_rules('school', 'School','trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('course', 'Course','trim|alpha_numeric_spaces');

			if($this->form_validation->run()){
				$avatarvar = $this->input->post('avatar', TRUE);
				$firstnamevar = $this->input->post('firstname', TRUE);
				$lastnamevar = $this->input->post('lastname', TRUE);
				$birthdatevar = $this->input->post('birthdate',TRUE);
				$schoolvar = $this->input->post('school', TRUE);
				$coursevar = $this->input->post('course', TRUE);

				$data = $_SESSION['sess_profile'];

				if(!empty($avatarvar)){
					$data['avatar'] = $avatarvar;
				}
				if(!empty($firstnamevar)){
					$data['firstname'] = $firstnamevar;
				}
				if(!empty($lastnamevar)){
					$data['lastname'] = $lastnamevar;	
				}
				if(!empty($birthdatevar)){
					$data['birthdate'] = $birthdatevar;					
				}
				if(!empty($schoolvar)){
					$data['school'] = $schoolvar;					
				}
				if(!empty($coursevar)){
					$data['course'] = $coursevar;
				}

				$uservar = $_SESSION['sess_login']['username'];
				$this->profile_model->edit_profiledb($data, $uservar);
				$this->session->set_userdata('sess_profile', $data);
				$this->session->set_flashdata('success', 'Profile updated successfully');
			}else{
				$this->session->set_flashdata('error','Please enter valid information');
			}
		}else{
			$this->session->set_flashdata('error','Please enter valid information');
		}
		redirect(base_url('profile'));

	}	
	

	/**
	 * 
	 */
	public function check_notif($context_arg, $response_arg, $user_arg, $class_arg, $ref_id_arg){
		if($context_arg=='class.invite' && $response_arg == 'ACCEPT'){
	        $this->notification_model->change_response($ref_id_arg, $response_arg);
			$this->classes_model->userEnroll($class_arg, $user_arg, 'MEMBER');
		}elseif($context_arg=='class.invite' && $response_arg == 'DECLINE'){
			$this->notification_model->change_response($ref_id_arg, $response_arg);
		} 
		$this->view('profile');
	}


	/**
	 * 
	 */
	public function read($notif_id, $active, $context_arg){
        $data['notifs'] = $this->notification_model->get_reference($notif_id);
        $this->notification_model->mark_read($notif_id);

        $data['title'] = ucfirst('notif_show');
        $data['flag'] = $active;
        $data['context'] = $context_arg;
        $data2['notif_count'] = $this->notification_model->get_notif_count($_SESSION['sess_profile']['user_id']);
        $this->load->view('templates/header-logged', $data2);
        $this->load->view('pages/notif_show', $data);
        $this->load->view('templates/footer');
	}


	/**
	 * 
	 */
	public function notif_redirects($context_arg, $notif_id_arg){
		$this->notification_model->mark_read($notif_id_arg);
		switch($context_arg){
			case'password.reset':
				$this->session->set_flashdata('success','Password has been reset properly!');
				$this->view("profile");
			break;
			case'user.verify':
				$this->session->set_flashdata('success','Email has been verified!');
				redirect(base_url("dashboard-student"));
			break;
			case'flashcard.class':
				redirect(base_url("classes/index"));
			break;
			case'flashcard.user':
				redirect(base_url("flashcards/index"));
			break;
			case'flashcard.reopen':
				redirect(base_url("flashcards/index"));
			break;
			default:
				$this->session->set_flashdata('error','Notification error!');
				$this->view("profile");
			break;
		}
	}	
	public function contact_us(){
		if($_SERVER['REQUEST_METHOD']=='POST'){

			$this->form_validation->set_rules('user_name', 'Your Name','trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('user_email', 'Your Email','valid_email');
			$this->form_validation->set_rules('subject', 'Subject');
			$this->form_validation->set_rules('message', 'Message');

			if($this->form_validation->run()){
				$namevar = $this->input->post('user_name', TRUE);
				$emailvar = $this->input->post('user_email', TRUE);
				$subjectvar = $this->input->post('subject', TRUE);
				$messagevar = $this->input->post('message',TRUE);

				if(empty($namevar)){
					$namevar = 'Anonymous';
				}
				if(empty($emailvar)){
					$emailvar = 'anonymous@anonmail.com';
				}
				if(empty($subjectvar)){
					$subjectvar = 'No subject';
				}
				if(empty($messagevar)){
					$messagevar = 'No message';
				}

				$this->session->set_flashdata('success','Message sent successfully!');
				$mailvar = array(
					'subject' => $namevar." says",
					'header' => $subjectvar,
					'body' => $messagevar,
					'email' => "Contact using: ".$emailvar,

				);

				$this->email->contact_us($mailvar, 'templates/message_us');
			}else{
				$this->session->set_flashdata('error','Please enter valid information');
			}
		}else{
			$this->session->set_flashdata('error','Please enter valid information');
		}
		redirect(base_url('home'));
	}
}
?>