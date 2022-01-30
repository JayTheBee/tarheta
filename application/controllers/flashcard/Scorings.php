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
    private function view($page_arg = 'index', $data_arg = array()){
        if(!file_exists(APPPATH.'views/flashcards/'.$page_arg.'.php')){
            show_404();
        }

        $data_arg['title'] = ucfirst($page_arg);

        $this->load->view('templates/header-logged');
        $this->load->view('flashcards/'.$page_arg, $data_arg);
        $this->load->view('templates/footer');
    }

    
    /**
     * Function that is called after the user is done answering a flashcard.
     * 
     * This function also handles calling the scoring_model functions to save relevant
     * information from the user's answering session.
     */
    public function score_user($user_id_arg, $flashcard_id_arg){
        $questions_var = $this->flashcard_model->get_questions($flashcard_id_arg);
        $data_var = $this->scoring_model->get_user_score($flashcard_id_arg, $user_id_arg, $questions_var);

        $this->scoring_model->update_user_score($flashcard_id_arg, $user_id_arg, $data_var);
        redirect(base_url('flashcards/result/'.$user_id_arg."/".$flashcard_id_arg));
    }

    
    /**
     * This handles the calling the functions to get relevant data to
     * display the user's performance/result on a specific flashcard.
     * 
     * This function also call the function to load the result.php view. 
     */
    public function result($user_id_arg, $flashcard_id_arg){
        $data_var = $this->flashcard_model->get_data($flashcard_id_arg);
        $data_var['user_scores'] = $this->scoring_model->get_user_score($flashcard_id_arg, $user_id_arg, $data_var['questions'],FALSE);
        $data_var['user_answers'] = $this->flashcard_model->get_user_answers($flashcard_id_arg, $user_id_arg, $data_var['questions']);
        
        $this->view('result', $data_var);
    }


    /**
     * Similar to the result function however this does not retrieve the right and wrong
     * answers of the user, it only retrieves the total score obtained by the user.
     * 
     * This function also call the function to load the score.php view.
     */
    public function score($user_id_arg, $flashcard_id_arg){
        $questions_var = $this->flashcard_model->get_data($flashcard_id_arg);
        $data_var['user_scores'] = $this->scoring_model->get_user_score($flashcard_id_arg, $user_id_arg, $questions_var,FALSE);

        $this->view('score', $data_var);
    }

    /**
     * Function to get all the data needed to display the rankings
     * of the user on a specific falshcard
     */
    public function ranking($latest_arg, $flashcard_id_arg){
        $data_var = $this->flashcard_model->get_data($flashcard_id_arg);
        // Just reused a funciton in the flashcard_model but
        // It also gets the questions and multiple choices so
        // I have unset those keys so that It will not be passed to the view.
        unset($data_var['questions']);
        unset($data_var['multi_choices']);

        // Converting string to bool
        $latest_arg = ($latest_arg === "latest") ? TRUE : FALSE;
        
        $data_var['users'] = $this->scoring_model->get_ranking($flashcard_id_arg, $latest_arg);

        $this->view('ranking', $data_var);
    }
}