<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('classes_model');
    }

    function check_page($page, $data){
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
        $data = $this->check_page($page, $data);

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
                    $user_id = $_SESSION['Profile']['user_id'];
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


    function show($class_id){
        $data['class'] = $this->classes_model->showClass($class_id);
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
                $user_id = $_SESSION['Profile']['user_id'];
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
}

