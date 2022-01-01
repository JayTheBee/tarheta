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

        private function check_page($page, $data){
            if ($page == "index"){
                $data['title'] = "View Flashcards";
                $data['flashcards'] = $this->flashcard_model->get_flashcards();
            }
            if ($page == 'edit'){
                $data['questions'] = $this->flashcard_model->get_questions($_SESSION['Current_Flashcard']['flashcard_id']);
                $data['multi_choices'] = $this->flashcard_model->get_choices($data['questions']);
            }
            
            return $data;
        }


        public function view($page = 'index'){
            if(!file_exists(APPPATH.'views/flashcards/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);

            $data = $this->check_page($page, $data);

            $this->load->view('templates/header');
            $this->load->view('flashcards/'.$page, $data);
            $this->load->view('templates/footer');
        }

        // Function wherein it displays the specific flashcard from the flashcards tab.
        public function show($flashcard_id){
            $data = $this->get_data($flashcard_id);

            $this->load->view('templates/header');
            $this->load->view('flashcards/show', $data);
            $this->load->view('templates/footer');
        }

        public function edit($flashcard_id){
            $data = $this->get_data($flashcard_id);

            $this->load->view('templates/header');
            $this->load->view('flashcards/edit', $data);
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
            return $data['flashcard_id'];
        }


        public function create_flashcards(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('name','Name','required');
                $this->form_validation->set_rules('description','Description');
                $this->form_validation->set_rules('type','Type');
                $this->form_validation->set_rules('visibility','Visibility');
                
                if($this->form_validation->run()==TRUE){
                    $flashcard_id = $this->create_flashcards_clean();
                    // $this->view('edit');
                    redirect(base_url('flashcards/edit/'.$flashcard_id));
                }
                else{
                    $this->view('create');
                }
                // $this->view('index');
            }
        }
        public function questions(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('question-type','Question Type','required');

                if($this->form_validation->run()==TRUE){
                    $_SESSION['Current_Question']['question_type'] = $this->input->post('question-type', TRUE);
                    $this->view('add-question');
                }
                else{
                    $this->view('edit');
                }

            }
        }
        public function save_question(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('question','Question','required');

                if($this->form_validation->run()==TRUE){
                    $this->clean_question();
                }
                // $this->view('edit');
                redirect(base_url('flashcards/edit/'.$_SESSION['Current_Flashcard']['flashcard_id']));

            }
        }

        private function clean_question(){

            $question = $this->input->post('question', TRUE);
            $answer = $this->input->post(strtolower($_SESSION['Current_Question']['question_type'])."-answer", TRUE);
            if($_SESSION['Current_Question']['question_type'] == 'CHOICE'){
                $answer = $this->input->post(strtolower($_SESSION['Current_Question']['question_type'])."-answer-".$answer, TRUE);
            }

            $data = array(
                'flashcard_id' => $_SESSION['Current_Flashcard']['flashcard_id'],
                'choice_id' => -1,
                'question_type' => $_SESSION['Current_Question']['question_type'],
                'question' => $question,
                'answer' => $answer,
            );

            $question_id = $this->flashcard_model->insert_question($data);
            
            //after ma save ng question retrieve the id and send it here
            if($_SESSION['Current_Question']['question_type'] == 'CHOICE'){
                $this->save_choices($question_id);
            }

        }
        private function save_choices($question_id){
            $choiceA = $this->input->post('choice-answer-a', TRUE);
            $choiceB = $this->input->post('choice-answer-b', TRUE);
            $choiceC = $this->input->post('choice-answer-c', TRUE);
            $choiceD = $this->input->post('choice-answer-d', TRUE);

            $data = array(
                'question_id' => $question_id,
                'choiceA' => $choiceA,
                'choiceB' => $choiceB,
                'choiceC' => $choiceC,
                'choiceD' => $choiceD
            );

            $choice_id = $this->flashcard_model->insert_choices($data);
            $this->flashcard_model->set_question_choice_id($choice_id, $question_id);
        }

        public function share($flashcard_id){
            $email = $this->input->post('email', TRUE);
            $status = $this->flashcard_model->flashcard_share($flashcard_id, $email);
            if($status){
                $this->session->set_flashdata('success', 'Shared');
            }
            else{
                $this->session->set_flashdata('error', 'User not found');
            }
            redirect(base_url('flashcards/show/'.$flashcard_id));
        }

        public function delete_question($question_id){
            $this->flashcard_model->delete_question($question_id);
            redirect(base_url('flashcards/edit/'.$_SESSION['Current_Flashcard']['flashcard_id']));
        }

        public function answer($flashcard_id){
            $data = $this->get_data($flashcard_id);

            $this->session->set_userdata('Current_Answering',$data['questions']);
            $this->session->set_userdata('Current_Number', 0);
            // shuffle($_SESSION['Current_Answering']);
            // shuffle($data['questions']);
            $this->load->view('templates/header');
            $this->load->view('flashcards/answer', $data);
            $this->load->view('templates/footer');
        }

        // This is a public function since it will be used by the ajax
        public function get_data($flashcard_id){
            $data['flashcard'] = $this->flashcard_model->get_flashcard_data($flashcard_id);
            $data['questions'] = $this->flashcard_model->get_questions($flashcard_id);
            $data['multi_choices'] = $this->flashcard_model->get_choices($data['questions']);

            if ($_SERVER['REQUEST_METHOD']=='POST'){
                echo json_encode($data);
            }
            return $data;
        }
    }