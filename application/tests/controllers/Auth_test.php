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
        $response = $this->request('POST', 'logins/login', $credential);
        echo $response;
        $this->assertRedirect(base_url('profile'));
    }
    public function test_Login_false(){
        $credential = [
            'email' => 'tarheta_wrong_test@mail.com',
            'password' => 'wrongpass'
        ];
        $response = $this->request('POST', 'logins/login', $credential);
        $this->assertStringContainsString('Incorrect Email or Password', $response);
    }
    public function test_resetpassword_true(){
        $email = 'tarheta_test@mail.com';
        $response = $this->request('POST', 'resetpasswords/sendPassReset', $email);
        $this->assertRedirect(base_url('login'));
    }   
    // public function test_resetpassword_false(){
    //     $email = 'tarheta_test_wrong@mail.com';
    //     $output = $this->request('POST', 'resetpasswords/sendPassReset', $email);
    //     $this->assertStringContainsString('Email not registered!', $output);
    // }   
}