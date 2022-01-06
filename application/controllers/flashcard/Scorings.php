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
        $data = $this->scoring_model->get_user_score($flashcard_id, $user_id, $questions);
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit();
    }
}