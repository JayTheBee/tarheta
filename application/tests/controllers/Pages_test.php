<?php
/**
 * @test
 * 
 **/
class Pages_test extends TestCase {
	public function test_home(){
		$output = $this->request('GET', '/');
		$this->assertStringContainsString('<div class="card-header text-center"> Home Page </div>', $output);
	}
	public function test_404(){
		$this->request('GET', 'notfound');
		$this->assertResponseCode(404);
	}
	public function test_account_type_function(){
		$output = $this->request('GET', 'account-type');		
		$this->assertStringContainsString('signups/set_teacher', $output);
	}
	public function test_signup_redirect(){
		$this->request('GET', 'signup');
		$this->assertRedirect(base_url('account-type'));
	}
	public function test_login_function(){
		$output = $this->request('GET', 'login');
		$this->assertStringContainsString('logins/login', $output);
	}
	public function test_profile_redirect(){
		$this->request('GET', 'profile');
		$this->assertRedirect(base_url('login'));
	}
}