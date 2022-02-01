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
            $this->load->model('notification_model');
            $this->load->model('set_model');
        }

        
        /**
         * Function that gets required data for specific pages.
         * 
         * Called in view($page = 'index', $data = array());
         */
        private function _check_page($page_arg, $data_arg){
            if ($page_arg == "index"){
                $data_arg['title'] = "View Flashcards";
                $data_arg['flashcards'] = $this->flashcard_model->get_flashcards();
                $data_arg['categories'] = $this->flashcard_model->get_categories();
                $data_arg['category_list'] = $this->flashcard_model->get_category_list($data_arg['flashcards']);
                $data_arg['sets'] = $this->set_model->get_sets($_SESSION['sess_profile']['user_id']);
                // $data['flashcards_with_set'] = $this->set_model->get_flashcard_with_set($_SESSION['sess_profile']['user_id']);
            }
            if($page_arg == 'create'){
                $data_arg['categories'] = $this->tags_model->fetchCategoryList();
                $data_arg['sets'] = $this->set_model->get_sets($_SESSION['sess_profile']['user_id']);
            }
            
            return $data_arg;
        }


        /**
         * Function to be called when you want to load a specific file in view.
         */
        public function view($page_arg = 'index', $data_arg = array()){
            if(!file_exists(APPPATH.'views/flashcards/'.$page_arg.'.php')){
                show_404();
            }

            $data_arg['title'] = ucfirst($page_arg);

            $data_arg = $this->_check_page($page_arg, $data_arg);

            $this->load->view('templates/header-logged');
            $this->load->view('flashcards/'.$page_arg, $data_arg);
            $this->load->view('templates/footer');
        }


        /**
         * Function wherein it displays the specific flashcard from the flashcards tab.
         */
        public function show($flashcard_id_arg){
            $data_var = $this->get_data($flashcard_id_arg);
            $data_var['category'] = $this->tags_model->fetchCategory($data_var['flashcard']['id']);

            // Setting the variable for the view to check if the user already answered the flashcard
            if(count($data_var['questions']) != 0){
                $question_id_var = $data_var['questions'][0]['id'];
                $user_id_var = $_SESSION['sess_profile']['user_id'];
                $data_var['is_answered'] = $this->flashcard_model->check_already_answered($question_id_var, $user_id_var);
            }
            else{
                $data_var['is_answered'] = FALSE;
            }

            if ($this->_check_access($flashcard_id_arg)){
                $this->view('show', $data_var);
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
        public function edit($type_arg, $flashcard_id_arg){
            $data_var = $this->get_data($flashcard_id_arg);
            $data_var['categories'] = $this->tags_model->fetchCategoryList();
            $data_var['category'] = $this->tags_model->fetchCategory($flashcard_id_arg);
            $data_var['sets'] = $this->set_model->get_sets($_SESSION['sess_profile']['user_id']);
            
            if ($data_var['flashcard']['creator_id'] == $_SESSION['sess_profile']['user_id'] && $this->_check_access($flashcard_id_arg)){
                $this->view('edit-'.$type_arg.'-current', $data_var);
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }



        /**
         * Function that prevents the user from accessing flashcards by manually typing the URL.
         */
        private function _check_access($flashcard_id){
            if (isset($_SESSION['sess_login']) && isset($_SESSION['sess_profile'])){
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
        private function _create_flashcards_clean(){
    
            $name_var = $this->input->post('name', TRUE);
            $description_var = $this->input->post('description', TRUE);
            $type_var = $this->input->post('type', TRUE);
            $visibility_var = $this->input->post('visibility', TRUE);
            $time_open_var = $this->input->post('time-open', TRUE);
            $time_close_var = $this->input->post('time-close', TRUE);
            $category_var = $this->input->post('category', TRUE);
            $qtype_var = ($type_var == 'QUIZ') ? $this->input->post('qtype', TRUE) : 'NULL';

            $cat_check_var = $this->tags_model->checkCategory($category_var);

            if(!$cat_check_var){
                 $this->view('create');
            }else{ 
                $data_var = array (
                    'creator_id' => $_SESSION['sess_profile']['user_id'],
                    'name' => $name_var,
                    'description' => $description_var,
                    'type' => $type_var,
                    'visibility' => $visibility_var,
                    'qtype' => $qtype_var,
                    'timeopen' => $time_open_var,
                    'timeclose' => $time_close_var
                );
                
                return $data_var;
            }
        }


        /**
         * This is the function that will be called when you press the +CreateFlashcard in the Navbar
         */
        public function create_flashcards(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $this->_set_flashcard_rules();
               
                if($this->form_validation->run()==TRUE){
                    // $flashcard_id = $this->_create_flashcards_clean();
                    // redirect(base_url('flashcards/edit/questions/'.$flashcard_id));
                    $data_var = $this->_create_flashcards_clean();
                    $data_var['flashcard_id'] = $this->flashcard_model->insert_flashcard($data_var);

                    $category_var = $this->input->post('category', TRUE);
                    $cat_check_var = $this->tags_model->checkCategory($category_var);
                    $this->tags_model->insertCategory($cat_check_var->id, $data_var['flashcard_id']);
                    
                    $set_id_var = $this->input->post('sets', TRUE);
                    $this->set_model->insert_flashcard_sets($set_id_var, $data_var['flashcard_id']);

                    $this->session->set_userdata('sess_current_flashcard',$data_var);

                    redirect(base_url('flashcards/edit/questions/'.$data_var['flashcard_id']));

                }
                else{
                    $this->view('create');
                }
            }
        }


        /**
         * Function to handle updating flashcard details.
         */
        public function update_flashcard($flashcard_id_arg){
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->_set_flashcard_rules();
                
                if($this->form_validation->run()==TRUE){
                    $data_var['flashcard'] = $this->_create_flashcards_clean();
                    $data_var['flashcard_id'] = $flashcard_id_arg;
                    $set_id_var = $this->input->post('sets', TRUE);

                    // ISSUE - category not yet updating when updating flashcard details

                    $this->flashcard_model->update_flashcard($data_var);
                    $this->set_model->update_set_list($flashcard_id_arg, $set_id_var);
                    redirect(base_url('flashcards/show/'.$flashcard_id_arg));
                }
            }
        }


        /**
         * Reusable function to set rules for Creating and Editing flashcard details.
         * 
         * Called in create_flashcards() & update_flashcard($flashcard_id)
         */
        private function _set_flashcard_rules(){
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
                    $_SESSION['sess_current_question']['question_type'] = $this->input->post('question-type', TRUE);
                    $this->view('add-question-default');
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

                if($this->form_validation->run()==TRUE){
                    $this->_clean_question();
                }
                redirect(base_url('flashcards/edit/questions/'.$_SESSION['sess_current_flashcard']['flashcard_id']));
            }
        }


        /**
         * Applies XSS filtering to the user's inputs when creating a new question.
         * Also handles passing the filtered input to the flashcard_model for saving.
         * 
         * Called in save_question();
         */
        private function _clean_question(){

            $question_var = $this->input->post('question', TRUE);
            $question_type_var = $this->input->post('question-type', TRUE);

            $answer_var = $this->input->post(strtolower($question_type_var)."-answer", TRUE);
            if($_SESSION['sess_current_question']['question_type'] == 'CHOICE')
                $answer_var = $this->input->post(strtolower($question_type_var)."-answer-".$answer_var, TRUE);

            $numpoints_var = $this->input->post('points-show', TRUE);
            $time_var = $this->input->post('time-show', TRUE);

            $data_var = array(
                'flashcard_id' => $_SESSION['sess_current_flashcard']['flashcard_id'],
                'choice_id' => -1,
                'question_type' => $question_type_var,
                'question' => $question_var,
                'answer' => $answer_var,
                'time' => $time_var,
                'total_points' => (int) $numpoints_var
            );

            $question_id_var = $this->flashcard_model->insert_question($data_var);
            // After saving the question get it's ID and save it in $question_id

            // $question_id will be used when saving the choices if the question is of a CHOICE type.
            if($_SESSION['sess_current_question']['question_type'] == 'CHOICE'){
                $this->_save_choices($question_id_var);
            }

        }


        /**
         * Since the multiple choice answers are saved in a different table,
         * this function handles applying XSS filtering to the multiple choice inputs
         * and passes the data to the flashcard_model for saving.
         * 
         * Called in _clean_question();
         */
        private function _save_choices($question_id_arg){
            $choice_a_var = $this->input->post('choice-answer-a', TRUE);
            $choice_b_var = $this->input->post('choice-answer-b', TRUE);
            $choice_c_var = $this->input->post('choice-answer-c', TRUE);
            $choice_d_var = $this->input->post('choice-answer-d', TRUE);

            $data_var = array(
                'question_id' => $question_id_arg,
                'choiceA' => $choice_a_var,
                'choiceB' => $choice_b_var,
                'choiceC' => $choice_c_var,
                'choiceD' => $choice_d_var
            );

            $choice_id_var = $this->flashcard_model->insert_choices($data_var);
            $this->flashcard_model->set_question_choice_id($choice_id_var, $question_id_arg);
        }


        /**
         * Handles giving other users access to your flashcard via email.
         */
        public function share($flashcard_id_arg){
            $email_var = $this->input->post('email', TRUE);
            $status_var = $this->flashcard_model->flashcard_share($flashcard_id_arg, $email_var);
            if($status_var){
                $this->session->set_flashdata('success', 'Shared');
                $text = 'Your have been assigned a flashcard!';
                $refID = $this->notification_model->reference($text, NULL, $flashcard_id_arg, NULL);
                $this->notification_model->notify('flashcard.user', $refID, $status_var);
                    
            }
            else{
                $this->session->set_flashdata('error', 'User not found');
            }
            redirect(base_url('flashcards/show/'.$flashcard_id_arg));
        }


        /**
         * Deletes a specific question via question id.
         */
        public function delete_question($question_id_arg){
            $this->flashcard_model->delete_question($question_id_arg);
            redirect(base_url('flashcards/edit/questions/'.$_SESSION['sess_current_flashcard']['flashcard_id']));
        }


        /**
         * Handles loading the answering view.
         */
        public function answer($flashcard_id_arg){
            $data_var = $this->get_data($flashcard_id_arg);

            if ($this->_check_access($flashcard_id_arg)){
                $this->session->set_userdata('Current_Answering',$data_var['flashcard']);
                $this->session->set_userdata('Current_Number', 0);
                // shuffle($_SESSION['Current_Answering']);
                // shuffle($data['questions']);

                $this->view('answer', $data_var);
            }
            else{
                redirect(base_url('flashcards/index'));
            }
        }


        /**
         * Handles loading the reopen view.
         */
        public function reopen($flashcard_id_arg){
            $data_var = $this->get_data($flashcard_id_arg);

            $this->view('reopen', $data_var);
        }


        /**
         * Called by the 'reopen.php' view.
         * Also handles XSS filtering and passing the data to the flashcard_model for saving.
         */
        public function update_time($flashcard_id_arg){
            $this->form_validation->set_rules('time-open', 'Time-open','required');
            $this->form_validation->set_rules('time-close', 'Time-close','required');

            if ($_SERVER['REQUEST_METHOD']=='POST'){
          
                if($this->form_validation->run()==TRUE){
                    $time_open_var = $this->input->post('time-open', TRUE);
                    $time_close_var =$this->input->post('time-close', TRUE);

                    $data_var = array(
                        'timeopen' => $time_open_var,
                        'timeclose' => $time_close_var,
                    );

                    $this->flashcard_model->time_update($data_var, $flashcard_id_arg);
                    $text = 'Flashcard has been reopened!';
                    $refID = $this->notification_model->reference($text, NULL, $flashcard_id_arg, NULL);
                    $this->notification_model->notify_flashcard_access('flashcard.reopen', $refID, $flashcard_id_arg);
            
                }

            redirect(base_url('flashcards/show/'.$flashcard_id_arg));
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
        public function get_data($flashcard_id_arg, $has_sets_arg=FALSE){
            $data_var = $this->flashcard_model->get_data($flashcard_id_arg, $has_sets_arg);

            if ($_SERVER['REQUEST_METHOD']=='POST'){
                echo json_encode($data_var);
            }
            return $data_var;
        }


        /**
         * This function is called by the ajax of the 'answering.php' view.
         * Handles applying XSS filtering and passsing the data to the flashcard_model for saving.
         */
        public function submit_answer(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $user_id_var = $this->input->post('user_id', TRUE);
                $question_id_var = $this->input->post('question_id', TRUE);
                $answer_var = $this->input->post('answer', TRUE);
                $total_points_var = $this->input->post('points', TRUE);
                $qtype_var = $this->input->post('qtype', TRUE);

                $judgement_var = $this->flashcard_model->check_answer($question_id_var, $answer_var);
                $points_var = $this->_assign_points($judgement_var, $total_points_var);
                $datetime_var = time();
                $attempt_var = (int)$this->flashcard_model->check_attempts($question_id_var, $user_id_var);
                $attempt_var = ($qtype_var != "ASSIGNMENT") ? $attempt_var + 1 : $attempt_var; 

                $data_var = array(
                    'user_id' => $user_id_var,
                    'question_id' => $question_id_var,
                    'answer' => $answer_var,
                    'judgement' => $judgement_var,
                    'points' => $points_var,
                    'timestamp' => date('Y-m-d H:i:s', $datetime_var + 1 * 24 * 60 * 60),
                    'attempt' => $attempt_var,
                );

                $query_var = $this->flashcard_model->save_answer($data_var);

                //Placeholder IDK
                if($judgement_var == 'CORRECT')
                    echo "true";
                else
                    echo "false";
            }
        }


        /**
         * Called in submit_answer();
         * Handles giving the points to the user's answer.
         */
        private function _assign_points($judgement_arg, $total_points_arg){
            if($judgement_arg == 'CORRECT')
                return $total_points_arg;
            else
                return 0;
        }

    }