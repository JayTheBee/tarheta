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

    
    public function score_user($user_id, $flashcard_id){
        $questions = $this->flashcard_model->get_questions($flashcard_id);
        $data['user_scores'] = $this->scoring_model->get_user_score($flashcard_id, $user_id, $questions);

        redirect(base_url('flashcards/result/'.$user_id."/".$flashcard_id));
    }

    
    public function result($user_id, $flashcard_id){
        $data = $this->flashcard_model->get_data($flashcard_id);
        $data['user_scores'] = $this->scoring_model->get_user_score($flashcard_id, $user_id, $data['questions'],FALSE);
        $data['user_answers'] = $this->flashcard_model->get_user_answers($flashcard_id, $user_id, $data['questions']);
        
        $this->load->view('templates/header');
        $this->load->view('flashcards/result', $data);
        $this->load->view('templates/footer');
    }
}