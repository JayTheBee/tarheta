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
        $data = $this->_check_page($page, $data);
        $this->load->view('templates/header');
        $this->load->view('classes/'.$page, $data);
        $this->load->view('templates/footer');
    }

    public function create_classes(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('class_name','Class_Name','required');
            $this->form_validation->set_rules('description','Description');
            $this->form_validation->set_rules('school','School');
            
            if($this->form_validation->run()==TRUE){

                    $class_name = $this->input->post('class_name', TRUE);
                    $description = $this->input->post('description');
                    $invite = bin2hex(openssl_random_pseudo_bytes(6));
                    $school = $this->input->post('school');
                    $data = array(
                        'class_name'=> $class_name,
                        'description'=> $description,
                        'invite_code' => $invite,
                        'school'=> $school,
                        
                    );
                    $user_id = $_SESSION['sess_profile']['user_id'];
                    $this->classes_model->insertclasses($data, $user_id);
                    
                    $this->session->set_flashdata('success','Classes successfully created!');
                    $this->view('create');
                }
            else{
				$this->session->set_flashdata('error','Class Name is Required');
    			$this->view('create');
			}
        }
    }


    public function show($class_id){
        $data['class'] = $this->classes_model->showClass($class_id);
        $data['classMembers'] = $this->classes_model->getMembers($class_id);
        $data['assignedFlashcards'] = $this->flashcard_model->getClassFlashcard($class_id);
        $data['createdFlashcards'] = $this->flashcard_model->getCreatedFlashcards($_SESSION['sess_profile']['user_id']);
        $data['title'] = ucfirst('show');

        $this->load->view('templates/header');
        $this->load->view('classes/show', $data);
        $this->load->view('templates/footer');
    }

    public function join(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('invite','Invite', 'required');

            if($this->form_validation->run()==TRUE){

                $class_code = $this->input->post('invite', TRUE);
                $class = $this->classes_model->verifyCode($class_code);
                $user_id = $_SESSION['sess_profile']['user_id'];
                $email_check = $this->classes_model->emailCheck($user_id);

                if(!$class){
                    $this->session->set_flashdata('error','Valid class code required!');
                    redirect(base_url('classes/join'));
                }
                else{
                    if(!$email_check){
                        $this->session->set_flashdata('error','Verified email required!');
                        redirect(base_url('classes/join'));
                    }
                    else{
                        $this->classes_model->userEnroll($class->id, $user_id, 'MEMBER');
                        $this->session->set_flashdata('success','Classes successfully joined!');
                        redirect(base_url('classes/index'));       
                    }
                }
            }
            else{
                $this->session->set_flashdata('error','Valid class code required!');
                redirect(base_url('classes/join'));
            }
        }
        $this->view('join');
    }

    public function invite(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			
            if($this->form_validation->run()==TRUE){
				$email = $this->input->post('email', TRUE);
                $class_name = $this->input->post('class-name', TRUE);
                $class_id = $this->input->post('class-id', TRUE);
				$status = $this->classes_model->classes_inv($email);

                if($status){
                
                    $text = 'You have been invited to the '.$class_name.'!';
                    $refID = $this->notification_model->reference($text, $class_id, NULL);
                    $this->notification_model->notify('class.invite', $refID, $status['id']);
                    $this->session->set_flashdata('success', 'Users Invited');
                    redirect(base_url('classes/show/'.$class_id));
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
    
    public function assignFlashcards(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('flashcard','Flashcards','required');

            if($this->form_validation->run()==TRUE){
                $class_id = $this->input->post('class-id', TRUE);
                $selFlashcard =  $this->input->post('flashcard', TRUE);
                $check = $this->flashcard_model->verify_flashcard_data($selFlashcard);

                if($check){
                    $this->flashcard_model->insert_flashcard_class_access($selFlashcard, $class_id);
                    $this->session->set_flashdata('success', 'Flashcard assigned');
                    redirect(base_url('classes/show/'.$class_id)); 

                }else{
                    $this->session->set_flashdata('error', 'Flashcard not found!');
                    redirect(base_url('classes/show/'.$class_id)); 
                }
            }else{
                $this->session->set_flashdata('error', 'Please enter valid input!');
                redirect(base_url('classes/show/'.$class_id));
            }
        }        
    }


    public function enroll_user(){
        $data = $this->segmentURL();
        $this->classes_model->userEnroll($data['class_id'], $data['user_id'], 'MEMBER');
        $this->show($data['class_id']);
    }


    private function segmentURL(){
		$segmentedURL = array(
			'user_id' => $this->uri->segment(4),
			'class_id' => $this->uri->segment(5),
		);
		return $segmentedURL;
	}
}   