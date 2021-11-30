<?php

class Pages_test extends TestCase {
	public function test_home(){
		$output = $this->request('GET', '/');
		$this->assertContains('Home Page', $output);
	}
}