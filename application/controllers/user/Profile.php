<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('user_model');
		$this->load->model('profile_model');
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
	
	public function read($notif_id, $active){
        $data['notifs'] = $this->notification_model->get_reference($notif_id);

        $data['title'] = ucfirst('notif_show');
        $data['flag'] = $active;

        $this->load->view('templates/header');
        $this->load->view('pages/notif_show', $data);
        $this->load->view('templates/footer');
	}
}
?>