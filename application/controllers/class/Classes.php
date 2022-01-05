<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('classes_model');
    }

    public function view($page = 'index'){
        if(!file_exists(APPPATH.'views/classes/'.$page.'.php')){
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->view('templates/header');
        $this->load->view('classes/'.$page, $data);
        $this->load->view('templates/footer');
    }

    public function create_classes(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->form_validation->set_rules('class_name','Class_Name','required');
            $this->form_validation->set_rules('description','Description');
            //$this->form_validation->set_rules('invite','Invite');
            $this->form_validation->set_rules('school','School');
            
            if($this->form_validation->run()==TRUE){

                    $class_name = $this->input->post('class_name', TRUE);
                    $description = $this->input->post('description');
                   // $invite = $this->input->post('invite');
                    $school = $this->input->post('school');
    
                    $data = array(
                        'creator_id' => $_SESSION['Profile']['user_id'],
                        'class_name'=> $class_name,
                        'description'=> $description,
                        //'invite' => $invite,
                        'school'=> $school,
                        
                    );
    
                    $this->load->model('classes_model');
                    $this->classes_model->insertclasses($data);
                    $this->session->set_userdata('classes',$data);
                    $this->session->set_flashdata('success','Classes successfully created');
                    redirect(base_url('classes/create'));
                }
            else
			 {
				$this->session->set_flashdata('error','Class Name is Required');
				redirect(base_url('classes/create'));
			 }
            }
        }
}

