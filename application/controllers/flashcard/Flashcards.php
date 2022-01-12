<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Flashcards extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('email');
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->model('flashcard_model');
            $this->load->model('tags_model');
        }

        
        private function check_page($page, $data){
            if ($page == "index"){
                $data['title'] = "View Flashcards";
                $data['flashcards'] = $this->flashcard_model->get_flashcards();
                $data['categories'] = $this->flashcard_model->get_categories();
                $data['category_list'] = $this->flashcard_model->get_category_list($data['flashcards']);
                echo "<pre>";
                print_r($data);
                echo "<\pre>";
                exit();
            }
            if ($page == 'edit'){
                $data['questions'] = $this->flashcard_model->get_questions($_SESSION['Current_Flashcard']['flashcard_id']);
                $data['multi_choices'] = $this->flashcard_model->get_choices($data['questions']);
            }
            if($page == 'create'){
                $data['categories'] = $this->tags_model->fetchCategoryList();
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
            $data['category'] = $this->tags_model->fetchCategory($data['flashcard']['id']);
            if ($this->check_access($flashcard_id)){
                $this->load->view('templates/header');
                $this->load->view('flashcards/show', $data);
                $this->load->view('templates/footer');
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }


        public function edit($flashcard_id){
            $data = $this->get_data($flashcard_id);
            
            if ($data['flashcard']['creator_id'] == $_SESSION['Profile']['user_id'] && $this->check_access($flashcard_id)){
                $this->load->view('templates/header');
                $this->load->view('flashcards/edit', $data);
                $this->load->view('templates/footer');
            }
            else{
                redirect(base_url('flashcards/index'));
            }

            
        }


        // Function that prevents the user from accessing flashcards by manually typing the URL
        private function check_access($flashcard_id){
            if (isset($_SESSION['UserLoginSession']) && isset($_SESSION['Profile'])){
                // Gets all the flashcards that the current user has access to
                $flashcards = $this->flashcard_model->get_flashcards();

                // Check if the requested flashcard is in the list of accessible flashcards of the user
                foreach($flashcards as $card){
                    if ($card['id'] == $flashcard_id)
                        return TRUE;    
                }
                return FALSE;
            }
            else
                return FALSE;
            
        }


        private function create_flashcards_clean(){
    
            $name = $this->input->post('name', TRUE);
            $description = $this->input->post('description', TRUE);
            $type = $this->input->post('type', TRUE);
            $visibility = $this->input->post('visibility', TRUE);
            $time_open = $this->input->post('time-open', TRUE);
            $time_close = $this->input->post('time-close', TRUE);
            $category = $this->input->post('category', TRUE);

            $cat_check = $this->tags_model->checkCategory($category);

            if(!$cat_check){
                 $this->view('create');
            }else{ 
                $data = array (
                    'creator_id' => $_SESSION['Profile']['user_id'],
                    'name' => $name,
                    'description' => $description,
                    'type' => $type,
                    'visibility' => $visibility,
                    'timeopen' => $time_open,
                    'timeclose' => $time_close
                );
                $data['flashcard_id'] = $this->flashcard_model->insert_flashcard($data);
                $this->tags_model->insertCategory($cat_check->id, $data['flashcard_id']);
                $this->session->set_userdata('Current_Flashcard',$data);
                return $data['flashcard_id'];
            }
        }


        public function create_flashcards(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('name','Name','required');
                $this->form_validation->set_rules('description','Description');
                $this->form_validation->set_rules('type','Type');
                $this->form_validation->set_rules('visibility','Visibility');
                $this->form_validation->set_rules('time-open', 'Time-open');
                $this->form_validation->set_rules('time-close', 'Time-close');
                $this->form_validation->set_rules('category', 'Subjects');
               
                
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
                $this->form_validation->set_rules('numpoints', 'NumPoints', 'required');

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
            $numpoints = $this->input->post('numpoints', TRUE);

            $data = array(
                'flashcard_id' => $_SESSION['Current_Flashcard']['flashcard_id'],
                'choice_id' => -1,
                'question_type' => $_SESSION['Current_Question']['question_type'],
                'question' => $question,
                'answer' => $answer,
                'total_points' => $numpoints
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

            if ($this->check_access($flashcard_id)){
                $this->session->set_userdata('Current_Answering',$data['flashcard']);
                $this->session->set_userdata('Current_Number', 0);
                // shuffle($_SESSION['Current_Answering']);
                // shuffle($data['questions']);
                $this->load->view('templates/header');
                $this->load->view('flashcards/answer', $data);
                $this->load->view('templates/footer');
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }


        // This is a public function since it will be used by the ajax
        public function get_data($flashcard_id){
            $data = $this->flashcard_model->get_data($flashcard_id);

            if ($_SERVER['REQUEST_METHOD']=='POST'){
                echo json_encode($data);
            }
            return $data;
        }

        public function submit_answer(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $user_id = $this->input->post('user_id', TRUE);
                $question_id = $this->input->post('question_id', TRUE);
                $answer = $this->input->post('answer', TRUE);
                $total_points = $this->input->post('points', TRUE);

                $judgement = $this->flashcard_model->check_answer($question_id, $answer);
                $points = $this->assign_points($judgement, $total_points);
                $datetime = time();
                $attempt = (int)$this->flashcard_model->check_attempts($question_id, $user_id) + 1;

                $data = array(
                    'user_id' => $user_id,
                    'question_id' => $question_id,
                    'answer' => $answer,
                    'judgement' => $judgement,
                    'points' => $points,
                    'timestamp' => date('Y-m-d H:i:s', $datetime + 1 * 24 * 60 * 60),
                    'attempt' => $attempt,
                );

                $query = $this->flashcard_model->save_answer($data);

                //Placeholder IDK
                if($judgement == 'CORRECT')
                    echo "true";
                else
                    echo "false";
            }
        }

        private function assign_points($judgement, $total_points){
            if($judgement == 'CORRECT')
                return $total_points;
            else
                return 0;
        }

        
    }