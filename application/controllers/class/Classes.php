<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('classes_model');
    }

    public function view($page = 'index'){
        if(!file_exists(APPPATH.'views/classes/'.$page.'.php')){
            show_404();
        }

        $data['result'] = $this->classes_model->getData();
        $data['title'] = ucfirst($page);

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
                    $invite = bin2hex(openssl_random_pseudo_bytes(10));
                    $school = $this->input->post('school');
                    $data = array(
                        'class_name'=> $class_name,
                        'description'=> $description,
                        'invite_code' => $invite,
                        'school'=> $school,
                        
                    );
                    $user_id = $_SESSION['Profile']['user_id'];
                    $data['class_id'] = $this->classes_model->insertclasses($data, $user_id);
                    $this->session->set_userdata('classes',$data);
                    echo $data;
                    $this->session->set_flashdata('success','Classes successfully created!');
                    redirect(base_url('classes/index'));
                }
            else{
				$this->session->set_flashdata('error','Class Name is Required');
				redirect(base_url('classes/index'));
			}
        }
    }
    // function for showing i guess?
}

