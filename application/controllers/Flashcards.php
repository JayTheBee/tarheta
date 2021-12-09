<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Flashcards extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('email');
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->model('flashcard_model');
        }

        public function index(){
            $data['title'] = "View Flashcards";
            $data['flashcards'] = $this->flashcard_model->get_flashcards();
            $this->load->view('templates/header');
            $this->load->view('flashcards/index', $data);
            $this->load->view('templates/footer');
        }


        public function view($page = 'index'){
            if(!file_exists(APPPATH.'views/flashcards/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);

            $this->load->view('templates/header');
            $this->load->view('flashcards/'.$page, $data);
            $this->load->view('templates/footer');
        }


        private function create_flashcards_clean(){
    
            $name = $this->input->post('name', TRUE);
            $description = $this->input->post('description', TRUE);
            $type = $this->input->post('type', TRUE);
            $visibility = $this->input->post('visibility', TRUE);
    
            $data = array (
                'creator_id' => $_SESSION['Profile']['user_id'],
                'name' => $name,
                'description' => $description,
                'type' => $type,
                'visibility' => $visibility,
            );
    
            $data['flashcard_id'] = $this->flashcard_model->insert_flashcard($data);
            $this->session->set_userdata('Current_Flashcard',$data);
        }


        public function create_flashcards(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('name','Name','required');
                $this->form_validation->set_rules('description','Description');
                $this->form_validation->set_rules('type','Type');
                $this->form_validation->set_rules('visibility','Visibility');
                
                if($this->form_validation->run()==TRUE){
                    $this->create_flashcards_clean();
                    
                    $this->view('create-questions');
                }
                else{
                    $this->view('create');
                }
                // $this->view('index');
            }
        }
        public function create_questions(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('name','Name','required');
                $this->form_validation->set_rules('description','Description');
                $this->form_validation->set_rules('type','Type');
                $this->form_validation->set_rules('visibility','Visibility');
            }
        }
    }