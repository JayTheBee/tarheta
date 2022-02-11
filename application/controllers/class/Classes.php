<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('classes_model');
        $this->load->model('flashcard_model');
        $this->load->model('notification_model');
        $this->load->model('user_model');
        $this->load->model('classes_model');
    }

    private function _check_page($page, $data){
        if($page == 'index'){
            $data['result'] = $this->classes_model->getClass();
        }
        // if($page == 'join'){

        // }
        return $data;
    }

    public function view($page = 'index'){
        if(!file_exists(APPPATH.'views/classes/'.$page.'.php')){
            show_404();
        }

        $data['title'] = ucfirst($page);
        $data2['notif_count'] = $this->notification_model->get_notif_count($_SESSION['sess_profile']['user_id']);
        $data = $this->_check_page($page, $data);
        $this->load->view('templates/header-logged', $data2);
        $this->load->view('classes/'.$page, $data);
        $this->load->view('templates/footer');
    }

    public function create_classes(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('class_name','Class_Name','required');
            $this->form_validation->set_rules('description','Description');
            $this->form_validation->set_rules('invite','Description');
            $this->form_validation->set_rules('school','School');
            
            if($this->form_validation->run()==TRUE){

                    $class_name = $this->input->post('class_name', TRUE);
                    $description = $this->input->post('description');
                    $invite = bin2hex(openssl_random_pseudo_bytes(6));
                    $school = $this->input->post('school');
                    $invitationsvar = $this->input->post('invite');
                    if($invitationsvar == TRUE){
                        $invitationsvar = 'YES';
                    }else{
                        $invitationsvar = 'NO';
                    }

                    $data = array(
                        'class_name'=> $class_name,
                        'description'=> $description,
                        'invite_code' => $invite,
                        'school'=> $school,
                        'invitations' => $invitationsvar,
                        
                    );
                    $user_id = $_SESSION['sess_profile']['user_id'];
                    $classvar = $this->classes_model->insertclasses($data, $user_id);
                    $this->session->set_flashdata('success','Classes successfully created!');
                    $this->show($classvar);
                }
            else{
				$this->session->set_flashdata('error','Class Name is Required');
                redirect(base_url('classes/create')); 
			}
        }
    }


    public function show($class_id){
        $data['class'] = $this->classes_model->showClass($class_id);
        $data['classMembers'] = $this->classes_model->getMembers($class_id);
        $data['assignedFlashcards'] = $this->flashcard_model->get_class_flashcard($class_id);
        $data['createdFlashcards'] = $this->flashcard_model->get_created_flashcards();
        $data['title'] = ucfirst('show');

        $data2['notif_count'] = $this->notification_model->get_notif_count($_SESSION['sess_profile']['user_id']);
        $this->load->view('templates/header-logged', $data2);
        $this->load->view('classes/show', $data);
        $this->load->view('templates/footer');
    }

    public function join(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('invite','INVITE CODE', 'required');

            if($this->form_validation->run()==TRUE){

                $class_code = $this->input->post('invite', TRUE);
                $class = $this->classes_model->verifyCode($class_code);
                $user_id = $_SESSION['sess_profile']['user_id'];
                $email_check = $this->user_model->user_active_check($user_id);

                if(!$class){
                    $this->session->set_flashdata('error','Valid class code required!');
                    $this->view('join');
                }
                else{
                    if(!$email_check){
                        $this->session->set_flashdata('error','Verified email required!');
                       $this->view('join');
                    }
                    else{
                        $this->classes_model->userEnroll($class->id, $user_id, 'MEMBER');
                        $this->session->set_flashdata('success','Classes successfully joined!');
                        $this->show($class->id);       
                    }
                }
            }
            else{
                $this->session->set_flashdata('error','Valid class code required!');
                $this->view('join');
            }
        }
    }

    public function invite(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required|valid_email');

			$class_id = $this->input->post('class-id', TRUE);
            if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email', TRUE);
                $class_name = $this->input->post('class-name', TRUE);
                

				$user_check = $this->user_model->email_check($email);

                if($user_check){
                    
                    $class_check = $this->classes_model->verify_class($user_check->id, $class_id);

                    if($class_check){
                        $this->session->set_flashdata('error', 'User is already in this class!');
                        redirect(base_url('classes/show/'.$class_id));

                    }else{

                        $text = 'You have been invited to the '.$class_name.'!';
                        $refID = $this->notification_model->reference($text, $class_id, NULL, NULL);
                        $this->notification_model->notify('class.invite', $refID, $user_check->id);
                        $this->session->set_flashdata('success', 'Users Invited');
                        redirect(base_url('classes/show/'.$class_id));
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', 'User not found');
                    redirect(base_url('classes/show/'.$class_id));
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'User not found');
                redirect(base_url('classes/show/'.$class_id));
            }
        }
    }	
    
    public function assign_flashcards(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('flashcard','Flashcards','required');

            $class_id = $this->input->post('class-id', TRUE);
            if($this->form_validation->run()==TRUE){
                $selFlashcard =  $this->input->post('flashcard', TRUE);
                $check = $this->flashcard_model->verify_flashcard_access($selFlashcard);

                if($check){
                    $this->flashcard_model->insert_flashcard_class_access($selFlashcard, $class_id);

                    $text = 'Your class has been assigned a flashcard!';
                    $refID = $this->notification_model->reference($text, $class_id, $selFlashcard, NULL);
                    $this->notification_model->notify_class('flashcard.class', $refID, $class_id);

                    $this->session->set_flashdata('success', 'Flashcard assigned');
                    redirect(base_url('classes/show/'.$class_id)); 

                }else{
                    $this->session->set_flashdata('error', 'Flashcard already assigned!');
                    redirect(base_url('classes/show/'.$class_id)); 
                }
            }else{
                $this->session->set_flashdata('error', 'Please enter valid input!');
                redirect(base_url('classes/show/'.$class_id));
            }
        }        
    }


    public function enroll_user(){
        $data = $this->segment_url();
        $this->classes_model->userEnroll($data['class_id'], $data['user_id'], 'MEMBER');
        $this->show($data['class_id']);
    }


    private function segment_url(){
		$segmentedURL = array(
			'user_id' => $this->uri->segment(4),
			'class_id' => $this->uri->segment(5),
		);
		return $segmentedURL;
	}
}   