<?php
/**
 * @group controller
 * 
 **/
class Pages_test extends TestCase {
	public function test_home(){
		$output = $this->request('GET', '/');
		$this->assertContains('<div class="card-header text-center"> Home Page </div>', $output);
	}
	public function test_404(){
		$this->request('GET', 'notfound');
		$this->assertResponseCode(404);
	}
	// public function test_signup(){
	// 	$output = $this->request('GET', 'signup');
	// 	$this->assertContains('Register as a', $output);
	// }
}