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
            if ($page == 'create-questions'){
                $data['questions'] = $this->flashcard_model->get_questions($_SESSION['Current_Flashcard']['flashcard_id']);
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
        public function questions(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('question-type','Question Type','required');

                if($this->form_validation->run()==TRUE){
                    $_SESSION['Current_Question']['question_type'] = $this->input->post('question-type', TRUE);
                    // $data = array(
                    //     'question-type' => $this->input->post('question-type', TRUE)
                    // );
                    // $this->session->set_userdata('Current_Question',$data);
                    $this->view('add-question');
                }
                else{
                    $this->view('create-questions');
                }

            }
        }
        public function save_question(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('question','Question','required');

                if($this->form_validation->run()==TRUE){
                    $this->clean_question();
                }
                $this->view('create-questions');

            }
        }

        private function clean_question(){

            $question = $this->input->post('question', TRUE);
            $answer = $this->input->post(strtolower($_SESSION['Current_Question']['question_type'])."-answer", TRUE);
            // In the case of a multiple question the value that would be saved in the database would be "A" "B" "C" or "D"
            // I think JavaScript is needed to retrieve the value from the other input field.
            // For now this would do.

            $data = array(
                'flashcard_id' => $_SESSION['Current_Flashcard']['flashcard_id'],
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
    }