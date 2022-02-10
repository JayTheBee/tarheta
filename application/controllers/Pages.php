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

            if(isset($_SESSION['sess_login'])){
                $data2['notif_count'] = $this->notification_model->get_notif_count($_SESSION['sess_profile']['user_id']);
                $headervar = 'header-logged';
            }else{
                $headervar = 'header';
            }

            $this->load->view('templates/'.$headervar, $data2);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

        /* Function to check if the user has access to the specified page via SESSION else redirects them */
        private function _check_session($page_arg, $data_arg){

            // Add dito yung page na gusto nyo mag redirrect sa login pag nde pa nakalog in si user.
            $redirect_to_login = array(
                'editprofile',
                'profile',
                'notif',
                'dashboard-student',
                'dashboard-teacher',
            );

            if (in_array($page_arg, $redirect_to_login)){
                if (!isset($_SESSION['sess_login'])){
                    $this->session->set_flashdata('error', 'Please Login First');
                    redirect(base_url('login'));
                }

                if ($page_arg == 'notif'){
                    $data_arg['notifications'] = $this->notification_model->get_notifications($_SESSION['sess_profile']['user_id']);
                }
            }
            else if ($page_arg == 'login'){
                // $this->_unset_type();
                $this->_login_check('profile');
            }
            else if ($page_arg == 'signup'){
                $this->_login_check('home');
                if (!isset($_SESSION['sess_user_type'])){
                    redirect(base_url('account-type'));
                }
            }
            else if ($page_arg == 'account-type'){
                $this->_login_check('home');
            }
            elseif ($page_arg == 'home' && isset($_SESSION['sess_login'])){
                redirect(base_url(($_SESSION['sess_user_type']['type'] == 'STUDENT') ? 'dashboard-student' : 'dashboard-teacher'));
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
                //Ginamit ko for determining kung saang dashbaord ireredirect si user.
                // $this->_unset_type(); 
                redirect(base_url($redirect));
            }
        }
    }