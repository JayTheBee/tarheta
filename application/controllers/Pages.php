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
            $data = $this->checkSessions($page, $data);


            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

        /* Function to check if the user has access to the specified page via SESSION else redirects them */
        private function checkSessions($page, $data){
            switch($page){
                case 'editprofile':
                    if (!isset($_SESSION['UserLoginSession'])){
                        $this->session->set_flashdata('error', 'Please Login First');
                        redirect(base_url('login'));
                    }
                    break;
                case 'profile':
                    if (!isset($_SESSION['UserLoginSession'])){
                        $this->session->set_flashdata('error', 'Please Login First');
                        redirect(base_url('login'));
                    }
                    break;
                case 'reset-password':
                    if (!isset($_SESSION['resetpassword'])){
                        redirect(base_url('home'));
                    }
                    break;
                case 'login':
                    $this->unsetUserType();
                    $this->isUserLogedIn('profile');
                    break;
                case 'signup':
                    $this->isUserLogedIn('home');
                    if (!isset($_SESSION['usertype'])){
                        redirect(base_url('account-type'));
                    }
                    break;
                case 'account-type':
                    $this->isUserLogedIn('home');
                    break;
                // case 'notif':
                //     if (!isset($_SESSION['UserLoginSession'])){
                //         $this->session->set_flashdata('error', 'Please Login First');
                //         redirect(base_url('login'));
                //     }
                //     $data['notifications'] = $this->notification_model->getNotifs($_SESSION['Profile']['user_id']);
                //     break;
                default:
                    break;
            }

            if($page == 'notif'){
              $data['notifications'] = $this->notification_model->getNotifs($_SESSION['Profile']['user_id']);
            }
            // if($page == 'join'){

            // }
            return $data;
        }

        private function unsetUserType(){
            if (isset($_SESSION['usertype'])){
                unset($_SESSION['usertype']);
            }
        }
        private function isUserLogedIn($redirect){
            if (isset($_SESSION['UserLoginSession'])){
                $this->unsetUserType();
                redirect(base_url($redirect));
            }
        }
    }