<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sets extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('scoring_model');
        $this->load->model('flashcard_model');
        $this->load->model('set_model');
        $this->load->model('notification_model');
    }

    /**
     * Function to handle viewing a specific page
     */
    private function _view($page_arg = 'index', $data_arg = array()){
        if(!file_exists(APPPATH.'views/flashcards/'.$page_arg.'.php')){
            show_404();
        }

        $data_arg['title'] = ucfirst($page_arg);

        // $data = $this->_check_page($page, $data);
        $data2['notif_count'] = $this->notification_model->get_notif_count($_SESSION['sess_profile']['user_id']);

        $this->load->view('templates/header-logged',$data2);
        $this->load->view('flashcards/'.$page_arg, $data_arg);
        $this->load->view('templates/footer');
    }


    /**
     * XSS Filtering for the Flashcard set input
     */
    private function _create_set_clean(){
        $name_var = $this->input->post('name', TRUE);
        $description_var = $this->input->post('description', TRUE);
        $color_var = $this->input->post('color', TRUE);
        $user_id_var = $_SESSION['sess_profile']['user_id'];

        $data_var = array (
            'name' => $name_var,
            'user_id' => $user_id_var,
            'description' => $description_var,
            'color' => $color_var,
        );

        return $data_var;
    }


    /**
     * Create Set
     */
    public function create_set(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->_set_rules();

            if($this->form_validation->run()==TRUE){
                $data_var = $this->_create_set_clean();
                $this->flashcard_model->set_flashcards($data_var);
                redirect(base_url('flashcards/index/'));
            }

            $this->_view('create-set');
        }
    }
    

    /**
     * This is the function that is called when the user presses the 'Edit Set' button
     */
    public function edit_set($set_id_arg){
        if($this->set_model->check_set($set_id_arg)){
            $data_var['set_id'] = $set_id_arg;
            $this->_view('edit-set', $data_var);
        }   
        else{
            redirect(base_url('flashcards/index/'));
        }
            
    }


    /**
     * This is function that actually communicates with the model to update
     * set details
     */
    public function update_set($set_id_arg){
        $this->_set_rules();
        if($this->form_validation->run()==TRUE){
            $data_var = $this->_create_set_clean();
            $this->set_model->update_set_datails($data_var, $set_id_arg);
            redirect(base_url('flashcards/index/'));
        }
    }


    /**
     * Function to set the validation rules for
     * creating and editing a flashcard set
     */
    private function _set_rules(){
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('description','Description','required');
        $this->form_validation->set_rules('color','Color','required');
    }


    /**
     * Function to delete a specific flashcard
     */
    public function delete_set($set_id_arg){
        if($this->set_model->check_set($set_id_arg))
            $this->set_model->delete($set_id_arg);

        redirect(base_url('flashcards/index/'));
    }


    /**
     * Function that is called with the user pressed the view button
     */
    public function show_set($set_id_arg){
        if($this->set_model->check_set($set_id_arg)){
            $data_var['flashcards_with_set'] = $this->set_model->get_flashcards_with_set($_SESSION['sess_profile']['user_id']);
            $data_var['set'] = $this->set_model->get($set_id_arg);
            $this->_view('show-set', $data_var);
        }
        else{
            redirect(base_url('flashcards/index/'));
        }
        
    }
}