<?php
    /* 
        This would now be the default controller for the navigation eme.
        Watch this to learn more: https://www.youtube.com/watch?v=I752ofYu7ag&list=PLillGF-RfqbaP_71rOyChhjeK1swokUIS&index=4&t=8s
    */
    class Pages extends CI_Controller{
        public function view($page = 'home'){
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);

            $this->checkSessions($page);

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

        /* Function to check if the user has access to the specified page via SESSION else redirects them */
        private function checkSessions($page){
            switch($page){
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
                    $this->unsetUserType();
                    $this->isUserLogedIn('profile');
                    break;
                case 'signup':
                    $this->isUserLogedIn('home');
                    if (!isset($_SESSION['sess_user_type'])){
                        redirect(base_url('account-type'));
                    }
                    break;
                case 'account-type':
                    $this->isUserLogedIn('home');
                    break;
            }
        }
        private function unsetUserType(){
            if (isset($_SESSION['sess_user_type'])){
                unset($_SESSION['sess_user_type']);
            }
        }
        private function isUserLogedIn($redirect){
            if (isset($_SESSION['sess_login'])){
                $this->unsetUserType();
                redirect(base_url($redirect));
            }
        }
    }