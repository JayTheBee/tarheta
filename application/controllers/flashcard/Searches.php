<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Searches extends CI_Controller{
        public function __construct(){
            parent::__construct();
            // $this->load->library('email');
            // $this->load->library('form_validation');
            $this->load->helper('security');
            // $this->load->model('flashcard_model');
            // $this->load->model('tags_model');
            // $this->load->model('notification_model');
            // $this->load->model('set_model');
            $this->load->model('search_model');
        }

        public function suggestions(){
            if($this->input->is_ajax_request()){
                $search_var = $this->input->post('keyword', TRUE);
                $user_id_var = $_SESSION['sess_profile']['user_id'];
                $data_var = $this->search_model->get_suggestions($search_var, $user_id_var);
                            
                // echo "<pre>";
                // var_dump ($data_var);
                // echo "</pre>";
                // exit();

                echo json_encode($data_var);
            }
        }

        public function open_search(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $search_var = $this->input->post('search-bar', TRUE);
                $flashcard_id_var = $this->search_model->get_flashcard($search_var);

                if ($flashcard_id_var)
                    redirect(base_url('flashcards/show/'.$flashcard_id_var));
                else
                    redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }