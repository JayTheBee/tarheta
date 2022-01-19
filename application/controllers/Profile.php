<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
    public function __construct(){
		parent::__construct();
		$this->load->model('notification_model');

    }

    function editprofile(){
		if($_SERVER['REQUEST_METHOD']=='POST'){

			/* IDK ha pero feel ko nde need na lahat required kasi pano pag name 
				lang or school gusto iupdate ng user pero iwan ko lang dito just in case
			*/
			/*$this->form_validation->set_rules('avatar','avatar');
			$this->form_validation->set_rules('firstname','Firstname');
			$this->form_validation->set_rules('lastname','Lastname');
			$this->form_validation->set_rules('birthdate', 'Birthdate');
            $this->form_validation->set_rules('school', 'School');
			$this->form_validation->set_rules('course', 'Course');*/

			$this->load->helper('security');
			$avatar = $this->input->post('avatar', TRUE);
			$firstname = $this->input->post('firstname', TRUE);
			$lastname = $this->input->post('lastname', TRUE);
			$birthdate = $this->input->post('birthdate',TRUE);
			$school = $this->input->post('school',TRUE);
			$course = $this->input->post('course',TRUE);

			$data = array(
				'avatar'=>$avatar,
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'birthdate'=>$birthdate,
				'school'=>$school,
				'course'=>$course,
			);
			$user = $_SESSION['UserLoginSession']['username'];
			$this->load->model('profile_model');
			$this->profile_model->editprofile($data, $user);

			$this->session->set_userdata('Profile',$data);

			$this->session->set_flashdata('success', 'Profile updated successfully');
			redirect(base_url('profile'));
		}

	}
	function read($notif_id){
        $data['notifs'] = $this->notification_model->getRef($notif_id);

        $data['title'] = ucfirst('notif_show');

        $this->load->view('templates/header');
        $this->load->view('pages/notif_show', $data);
        $this->load->view('templates/footer');
	}
}
?>