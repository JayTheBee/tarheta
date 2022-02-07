<?php
/**
 *Functional Tests for Login System
 * 
 **/
class Auth_test extends TestCase {
    public function test_Login_true(){
        $credential = [
            'email' => 'tarheta_test@mail.com',
            'password' => 'testpass'
        ];
        $response = $this->request('POST', 'auth/logins/login', $credential);
        $this->assertRedirect(base_url('profile'));
    }
    public function test_Login_false(){
        $credential = [
            'email' => 'tarheta_wrong_test@mail.com',
            'password' => 'wrongpass'
        ];
        $response = $this->request('POST', 'auth/logins/login', $credential);
        $this->assertStringContainsString('Log In to Tarheta', $response);
    }
    public function test_Login_missing(){
        $credential = [
            'email' => 'tarheta_wrong_test@mail.com',
        ];
        $response = $this->request('POST', 'auth/logins/login', $credential);
        $this->assertStringContainsString('Log In to Tarheta', $response);
    }
    public function test_resetpassword_true(){
        $email = 'tarheta_test@mail.com';
        $this->request('POST', 'auth/reset_passwords/send_pass_email', $email);
        $this->assertRedirect(base_url('login'));
    }   
    public function test_resetpassword_false(){
        $this->request->setCallable(
            function ($CI) {
                // Get mock object
                $validation = $this->getDouble(
                    'CI_Form_validation',
                    [
                        'set_rules' => NULL,
                        'run' => FALSE,
                    ]
                );
                // Verify invocations
                $this->verifyInvokedOnce($validation, 'set_rules');
                $this->verifyInvokedOnce($validation, 'run');
                // Inject mock object
                $CI->form_validation = $validation;
            }
        );
        $email = 'tarheta_test_wrong@mail.com';
        $this->request('POST', 'auth/reset_passwords/send_pass_email', $email);
        $this->assertRedirect(base_url('login'));
    }  

    // reset password main fucks with DB driver for some reason
    public function test_resetpassword_main_false(){
            $this->request->setCallable(
            function ($CI) {
                // Get mock object
                $validation = $this->getDouble(
                    'CI_Form_validation',
                    [
                        'set_rules' => NULL,
                        'run' => FALSE,
                    ]
                );
                // Verify invocations
                $this->verifyInvokedMultipleTimes($validation, 'set_rules', 2);
                $this->verifyInvokedOnce($validation, 'run');
                // Inject mock object
                $CI->form_validation = $validation;
            }
        );
        $pass = 'newpass123';
        $response = $this->request('POST', 'auth/reset_passwords/reset_main', $pass);
        $this->assertStringContainsString('Enter new password', $response);

    }

    public function test_signup_false(){
        $this->request->setCallable(
            function ($CI) {
                // Get mock object
                $validation = $this->getDouble(
                    'CI_Form_validation',
                    [
                        'set_rules' => NULL,
                        'run' => FALSE,
                    ]
                );
                // Verify invocations
                $this->verifyInvokedMultipleTimes($validation, 'set_rules', 4);
                $this->verifyInvokedOnce($validation, 'run');
                // Inject mock object
                $CI->form_validation = $validation;
            }
        );
        $credential = [
            'username' => 'new_user',
            'email' => 'tarheta_new_test@mail.com',
            'password' => 'newpass',
            'g-recaptcha-response' => TRUE,

        ];
        $_SESSION['sess_user_type'] = "TEACHER";
        $response = $this->request('POST', 'auth/signups/signup', $credential, $_SESSION);
        $this->assertStringContainsString("CREATE ACCOUNT", $response);
    }
    public function test_signup_true(){
        $credential = [
            'username' => 'new_user',
            'email' => 'tarheta_new_test@mail.com',
            'password' => 'newpass',
            'confirm_password' => 'newpass',
            'g-recaptcha-response' => TRUE,

        ];
        $_SESSION['sess_user_type'] = "TEACHER";
        $response = $this->request('POST', 'auth/signups/signup', $credential, $_SESSION);
        $this->assertRedirect(base_url('login'));
    }

    public function test_set_account_teacher_true(){
        $_SESSION['sess_user_type'] = "TEACHER";
        $response = $this->request('POST', 'auth/signups/set_teacher', $_SESSION);
        $this->assertRedirect(base_url('signup'));
    }

    public function test_set_account_student_true(){
        $_SESSION['sess_user_type'] = "STUDENT";
        $response = $this->request('POST', 'auth/signups/set_student', $_SESSION);
        $this->assertRedirect(base_url('signup'));
    }

    public function test_Logout(){
       $_SESSION['sess_profile'] =[ 
            'id' => 2, 
            'user_id' => 2, 
            'avatar' => 'DEFAULT',
            'birthdate' => '0000-00-00',
            'firstname' => '',
            'lastname' => '',
            'school' => '',
            'course' => '',
        ];
        $_SESSION['sess_login'] = [ 
            'username' => 'test', 
            'email' => 'tarheta_test@mail.com ',
            'password' => env('TEST_PASSWORD'),
        ];
        $_SESSION['sess_user_type'] = [ 
            'id' => 2, 
            'user_id'=> 2, 
            'type' => 'TEACHER' 
        ];
        $this->request('GET', 'auth/logins/logout', $_SESSION);
        $this->assertRedirect(base_url());
    }   
}