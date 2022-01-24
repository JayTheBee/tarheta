<?php
    /* 
        This would now be the default controller for the navigation eme.
        Watch this to learn more: https://www.youtube.com/watch?v=I752ofYu7ag&list=PLillGF-RfqbaP_71rOyChhjeK1swokUIS&index=4&t=8s
    */
    class Pages extends CI_Controller{

        public function __construct(){
          parent::__construct();
            $this->load->model('notification_model');
        }

        public function view($page = 'home'){
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);
            $data = $this->_check_session($page, $data);


            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

        /* Function to check if the user has access to the specified page via SESSION else redirects them */
        private function _check_session($page_arg, $data_arg){
            switch($page_arg){
                case 'editprofile':
                    if (!isset($_SESSION['sess_login'])){
                        $this->session->set_flashdata('error', 'Please Login First');
                        redirect(base_url('login'));
                    }
                    break;
                case 'profile':
                    if (!isset($_SESSION['sess_login'])){
                        $this->session->set_flashdata('error', 'Please Login First');
                        redirect(base_url('login'));
                    }
                    break;
                case 'reset-password':
                    if (!isset($_SESSION['sess_reset_pass'])){
                        redirect(base_url('home'));
                    }
                    break;
                case 'login':
                    $this->_unset_type();
                    $this->_login_check('profile');
                    break;
                case 'signup':
                    $this->_login_check('home');
                    if (!isset($_SESSION['sess_user_type'])){
                        redirect(base_url('account-type'));
                    }
                    break;
                case 'account-type':
                    $this->_login_check('home');
                    break;
                case 'notif':
                    if (!isset($_SESSION['sess_login'])){
                        $this->session->set_flashdata('error', 'Please Login First');
                        redirect(base_url('login'));
                    }
                    $data_arg['notifications'] = $this->notification_model->get_notifications($_SESSION['sess_profile']['user_id']);
                    break;
                default:
                    break;
            }
            return $data_arg;
        }

        private function _unset_type(){
            if (isset($_SESSION['sess_user_type'])){
                unset($_SESSION['sess_user_type']);
            }
        }
        private function _login_check($redirect){
            if (isset($_SESSION['sess_login'])){
                $this->_unset_type();
                redirect(base_url($redirect));
            }
        }
    }