<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
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

			$data = array(
				'id'=>$_SESSION['Profile']['id'],
				'user_id'=>$_SESSION['Profile']['user_id'],
				'avatar'=>"",
				'firstname'=>"",
				'lastname'=>"",
				'birthdate'=>"",
				'school'=>"",
				'course'=>"",
			);
			$this->load->helper('security');
			if(!empty($this->input->post('avatar'))){
				$data['avatar'] = $this->input->post('avatar', TRUE);
			}
			if(!empty($this->input->post('firstname'))){
				$data['firstname'] = $this->input->post('firstname', TRUE);
			}
			if(!empty($this->input->post('lastname'))){
				$data['lastname'] = $this->input->post('lastname', TRUE);	
				
			}
			if(!empty($this->input->post('birthdate'))){
				$data['birthdate'] = $this->input->post('birthdate',TRUE);
				
			}
			if(!empty($this->input->post('school'))){
				$data['school'] = $this->input->post('school',TRUE);
				
			}
			if(!empty($this->input->post('course'))){
				$data['course'] = $this->input->post('course',TRUE);	
			}
			$user = $_SESSION['UserLoginSession']['username'];
			$this->load->model('profile_model');
			$this->profile_model->editprofile($data, $user);
			$this->session->set_userdata('Profile',$data);
			$this->session->set_flashdata('success', 'Profile updated successfully');
			redirect(base_url('profile'));
		}

	}	
}
?>