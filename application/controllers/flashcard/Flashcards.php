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

        
        /**
         * Function that gets required data for specific pages.
         * 
         * Called in view($page = 'index', $data = array());
         */
        private function check_page($page, $data){
            if ($page == "index"){
                $data['title'] = "View Flashcards";
                $data['flashcards'] = $this->flashcard_model->get_flashcards();
                $data['categories'] = $this->flashcard_model->get_categories();
                $data['category_list'] = $this->flashcard_model->get_category_list($data['flashcards']);
            }
            if($page == 'create'){
                $data['categories'] = $this->tags_model->fetchCategoryList();
            }
            
            return $data;
        }


        /**
         * Function to be called when you want to load a specific file in view.
         */
        public function view($page = 'index', $data = array()){
            if(!file_exists(APPPATH.'views/flashcards/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);

            $data = $this->check_page($page, $data);

            $this->load->view('templates/header');
            $this->load->view('flashcards/'.$page, $data);
            $this->load->view('templates/footer');
        }


        /**
         * Function wherein it displays the specific flashcard from the flashcards tab.
         */
        public function show($flashcard_id){
            $data = $this->get_data($flashcard_id);
            $data['category'] = $this->tags_model->fetchCategory($data['flashcard']['id']);

            // Setting the variable for the view to check if the user already answered the flashcard
            if(count($data['questions']) != 0){
                $question_id = $data['questions'][0]['id'];
                $user_id = $_SESSION['Profile']['user_id'];
                $data['is_answered'] = $this->flashcard_model->check_already_answered($question_id, $user_id);
            }
            else{
                $data['is_answered'] = FALSE;
            }

            if ($this->check_access($flashcard_id)){
                $this->view('show', $data);
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }


        /**
         * There would be 2 types of edit:
         * edit flashcard - Where you can edit the details of the flashcard (Name, Description, Type, etc.)
         * edit questions - Where you can add or remove questions to the flashcard
         * 
         * $type would handle which view will be loaded
         */
        public function edit($type, $flashcard_id){
            $data = $this->get_data($flashcard_id);
            $data['categories'] = $this->tags_model->fetchCategoryList();
            $data['category'] = $this->tags_model->fetchCategory($flashcard_id);
            
            if ($data['flashcard']['creator_id'] == $_SESSION['Profile']['user_id'] && $this->check_access($flashcard_id)){
                $this->view('edit-'.$type, $data);
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }



        /**
         * Function that prevents the user from accessing flashcards by manually typing the URL.
         */
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


        /**
         * This function is called in when creating a new flashcard.
         * Just applies XSS filtering.
         * Reworked so that this function can used in Editing flashcard details
         * 
         * Called in create_flashcards() & update_flashcard($flashcard_id)
         */
        private function create_flashcards_clean(){
    
            $name = $this->input->post('name', TRUE);
            $description = $this->input->post('description', TRUE);
            $type = $this->input->post('type', TRUE);
            $visibility = $this->input->post('visibility', TRUE);
            $time_open = $this->input->post('time-open', TRUE);
            $time_close = $this->input->post('time-close', TRUE);
            $category = $this->input->post('category', TRUE);
            $qtype = ($type == 'QUIZ') ? $this->input->post('qtype', TRUE) : 'NULL';

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
                    'qtype' => $qtype,
                    'timeopen' => $time_open,
                    'timeclose' => $time_close
                );
                // $data['flashcard_id'] = $this->flashcard_model->insert_flashcard($data);
                // $this->tags_model->insertCategory($cat_check->id, $data['flashcard_id']);
                // $this->session->set_userdata('Current_Flashcard',$data);
                // return $data['flashcard_id'];
                return $data;
            }
        }


        /**
         * This is the function that will be called when you press the +CreateFlashcard in the Navbar
         */
        public function create_flashcards(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->set_flashcard_rules();
               
                if($this->form_validation->run()==TRUE){
                    // $flashcard_id = $this->create_flashcards_clean();
                    // redirect(base_url('flashcards/edit/questions/'.$flashcard_id));
                    $data = $this->create_flashcards_clean();
                    $data['flashcard_id'] = $this->flashcard_model->insert_flashcard($data);

                    $category = $this->input->post('category', TRUE);
                    $cat_check = $this->tags_model->checkCategory($category);
                    $this->tags_model->insertCategory($cat_check->id, $data['flashcard_id']);
                    $this->session->set_userdata('Current_Flashcard',$data);

                    redirect(base_url('flashcards/edit/questions/'.$data['flashcard_id']));

                }
                else{
                    $this->view('create');
                }
            }
        }


        /**
         * Function to handle updating flashcard details.
         */
        public function update_flashcard($flashcard_id){
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->set_flashcard_rules();
                
                if($this->form_validation->run()==TRUE){
                    $data['flashcard'] = $this->create_flashcards_clean();
                    $data['flashcard_id'] = $flashcard_id;

                    // ISSUE - category not yet updating when updating flashcard details

                    $this->flashcard_model->update_flashcard($data);
                    redirect(base_url('flashcards/show/'.$flashcard_id));
                }
            }
        }


        /**
         * Reusable function to set rules for Creating and Editing flashcard details.
         * 
         * Called in create_flashcards() & update_flashcard($flashcard_id)
         */
        private function set_flashcard_rules(){
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('description','Description');
            $this->form_validation->set_rules('type','Type');
            $this->form_validation->set_rules('visibility','Visibility');
            $this->form_validation->set_rules('time-open', 'Time-open');
            $this->form_validation->set_rules('time-close', 'Time-close');
            $this->form_validation->set_rules('category', 'Subjects');
        }


        /**
         * This function is called in the 'edit-questions.php' view when you have selected
         * the type (IDENTIFICATION, TRUEFALSE, CHOICE) of the new flashcard.
         */
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

        /**
         * This function is called by the 'add-question.php' view
         */
        public function save_question(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->form_validation->set_rules('question','Question','required'); 
                $this->form_validation->set_rules('numpoints', 'NumPoints', 'required'); 

                if($this->form_validation->run()==TRUE){
                    $this->clean_question();
                }
                redirect(base_url('flashcards/edit/questions/'.$_SESSION['Current_Flashcard']['flashcard_id']));
            }
        }


        /**
         * Applies XSS filtering to the user's inputs when creating a new question.
         * Also handles passing the filtered input to the flashcard_model for saving.
         * 
         * Called in save_question();
         */
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
            // After saving the question get it's ID and save it in $question_id

            // $question_id will be used when saving the choices if the question is of a CHOICE type.
            if($_SESSION['Current_Question']['question_type'] == 'CHOICE'){
                $this->save_choices($question_id);
            }

        }


        /**
         * Since the multiple choice answers are saved in a different table,
         * this function handles applying XSS filtering to the multiple choice inputs
         * and passes the data to the flashcard_model for saving.
         * 
         * Called in clean_question();
         */
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


        /**
         * Handles giving other users access to your flashcard via email.
         */
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


        /**
         * Deletes a specific question via question id.
         */
        public function delete_question($question_id){
            $this->flashcard_model->delete_question($question_id);
            redirect(base_url('flashcards/edit/questions/'.$_SESSION['Current_Flashcard']['flashcard_id']));
        }


        /**
         * Handles loading the answering view.
         */
        public function answer($flashcard_id){
            $data = $this->get_data($flashcard_id);

            if ($this->check_access($flashcard_id)){
                $this->session->set_userdata('Current_Answering',$data['flashcard']);
                $this->session->set_userdata('Current_Number', 0);
                // shuffle($_SESSION['Current_Answering']);
                // shuffle($data['questions']);

                $this->view('answer', $data);
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }


        /**
         * Handles loading the reopen view.
         */
        public function reopen($flashcard_id){
            $data = $this->get_data($flashcard_id);

            $this->view('reopen', $data);
        }


        /**
         * Called by the 'reopen.php' view.
         * Also handles XSS filtering and passing the data to the flashcard_model for saving.
         */
        public function updateTime($flashcard_id){
            $this->form_validation->set_rules('time-open', 'Time-open','required');
            $this->form_validation->set_rules('time-close', 'Time-close','required');

            if ($_SERVER['REQUEST_METHOD']=='POST'){
          
                if($this->form_validation->run()==TRUE){
                    $time_open = $this->input->post('time-open', TRUE);
                    $time_close =$this->input->post('time-close', TRUE);

                    $data = array(
                        'timeopen' => $time_open,
                        'timeclose' => $time_close,
                    );

                    $this->flashcard_model->timeUpdate($data, $flashcard_id);
                }

            redirect(base_url('flashcards/index'));
            }
        }

        
        /**
         * This gets data from the database and returns it.
         * Set to public for the ajax in the 'answer.php' view calls this function via POST method
         * to retrieve relevant information
         * 
         * $data would contain:
         * 'flashcard' => Array of the Data of the specific flashcard (Name, Description, Type, etc.).
         * 'questions' => Array of all the questions bound to the flashcard ID.
         * 'multi-choices' => Array of the multiple answer choices for the questions that requires it.
         */
        public function get_data($flashcard_id){
            $data = $this->flashcard_model->get_data($flashcard_id);

            if ($_SERVER['REQUEST_METHOD']=='POST'){
                echo json_encode($data);
            }
            return $data;
        }


        /**
         * This function is called by the ajax of the 'answering.php' view.
         * Handles applying XSS filtering and passsing the data to the flashcard_model for saving.
         */
        public function submit_answer(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $user_id = $this->input->post('user_id', TRUE);
                $question_id = $this->input->post('question_id', TRUE);
                $answer = $this->input->post('answer', TRUE);
                $total_points = $this->input->post('points', TRUE);
                $qtype = $this->input->post('qtype', TRUE);

                $judgement = $this->flashcard_model->check_answer($question_id, $answer);
                $points = $this->assign_points($judgement, $total_points);
                $datetime = time();
                $attempt = (int)$this->flashcard_model->check_attempts($question_id, $user_id);
                $attempt = ($qtype != "ASSIGNMENT") ? $attempt + 1 : $attempt; 

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


        /**
         * Called in submit_answer();
         * Handles giving the points to the user's answer.
         */
        private function assign_points($judgement, $total_points){
            if($judgement == 'CORRECT')
                return $total_points;
            else
                return 0;
        }

        
    }