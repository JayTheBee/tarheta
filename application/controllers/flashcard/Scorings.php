<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scorings extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('scoring_model');
        $this->load->model('flashcard_model');
    }

    /**
     * Function to call a specific view file.
     */
    private function view($page = 'index', $data = array()){
        if(!file_exists(APPPATH.'views/flashcards/'.$page.'.php')){
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->view('templates/header');
        $this->load->view('flashcards/'.$page, $data);
        $this->load->view('templates/footer');
    }

    
    /**
     * Function that is called after the user is done answering a flashcard.
     * 
     * This function also handles calling the scoring_model functions to save relevant
     * information from the user's answering session.
     */
    public function score_user($user_id, $flashcard_id){
        $questions = $this->flashcard_model->get_questions($flashcard_id);
        $data = $this->scoring_model->get_user_score($flashcard_id, $user_id, $questions);

        //$data['questions'] = $questions;
        $this->scoring_model->update_user_score($flashcard_id, $user_id, $data);
        redirect(base_url('flashcards/result/'.$user_id."/".$flashcard_id));
    }

    
    /**
     * This handles the calling the functions to get relevant data to
     * display the user's performance/result on a specific flashcard.
     * 
     * This function also call the function to load the result.php view. 
     */
    public function result($user_id, $flashcard_id){
        $data = $this->flashcard_model->get_data($flashcard_id);
        $data['user_scores'] = $this->scoring_model->get_user_score($flashcard_id, $user_id, $data['questions'],FALSE);
        $data['user_answers'] = $this->flashcard_model->get_user_answers($flashcard_id, $user_id, $data['questions']);
        
        $this->view('result', $data);
    }


    /**
     * Similar to the result function however this does not retrieve the right and wrong
     * answers of the user, it only retrieves the total score obtained by the user.
     * 
     * This function also call the function to load the score.php view.
     */
    public function score($user_id, $flashcard_id){
        $questions = $this->flashcard_model->get_data($flashcard_id);
        $data['user_scores'] = $this->scoring_model->get_user_score($flashcard_id, $user_id, $questions,FALSE);

        $this->view('score', $data);
    }


    public function ranking($user_id, $flashcard_id){
        $data = $this->flashcard_model->get_data($flashcard_id);
        $data['user_scores'] = $this->scoring_model->get_user_score($flashcard_id, $user_id, $data['questions'],FALSE);

        $result = $this->scoring_model->update_flashcard_ranks($flashcard_id, $user_id, $data['user_scores']['user_score']);
    }
}