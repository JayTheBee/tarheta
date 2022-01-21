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


    
}