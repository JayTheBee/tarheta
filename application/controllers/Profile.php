<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    function editprofile(){
		if($_SERVER['REQUEST_METHOD']=='POST'){

			/* IDK ha pero feel ko nde need na lahat required kasi pano pag name 
				lang or school gusto iupdate ng user pero iwan ko lang dito just in case
			*/
			/*$this->form_validation->set_rules('firstname','Firstname');
			$this->form_validation->set_rules('lastname','Lastname');
			$this->form_validation->set_rules('birthdate', 'Birthdate');
            $this->form_validation->set_rules('school', 'School');
			$this->form_validation->set_rules('course', 'Course');*/

			$this->load->helper('security');
			$firstname = $this->input->post('firstname', TRUE);
			$lastname = $this->input->post('lastname', TRUE);
			$birthdate = $this->input->post('birthdate',TRUE);
			$school = $this->input->post('school',TRUE);
			$course = $this->input->post('course',TRUE);

			$data = array(
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'birthdate'=>$birthdate,
				'school'=>$school,
				'course'=>$course,
			);

			$this->load->model('profile_model');
			$this->profile_model->editprofile($data);

			$this->session->set_userdata('Profile',$data);

			$this->session->set_flashdata('success', 'Profile updated successfully');
			redirect(base_url('profile'));
		}

	}
}
?>