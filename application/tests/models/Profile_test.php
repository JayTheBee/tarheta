<?php

class Profile_test extends UnitTestCase
{

	public function setUp() : void
	{
		$this->obj = $this->newModel('profile_model');
	}

	public function test_get_profile()
	{
		$email = 'tarheta_mail@mail.com';
		$expected = [
			// "id" => 1,
			// "user_id" => 1,
			'firstname'=>'test',
			'lastname'=>'test',
			'birthdate'=>"0000-00-00",
			'school'=>'test',
			'course'=>'test',
		];
		$list = $this->obj->getProfile($email);
        // fwrite(STDERR, print_r($list, TRUE));
        // IF I WANT TO ITERATE ON ENTIRE OBJECT PROPERTY
		// foreach($list as $key => $value) {
		//     fwrite(STDERR, print_r("$value\n", TRUE));
		// 	$this->assertEquals($value, $expected[$key]);
		// }
		//ASSERTING SPECIFIC PROPERTIES
		$this->assertEquals($list->lastname, $expected['lastname']);
		$this->assertEquals($list->birthdate, $expected['birthdate']);
		$this->assertEquals($list->school, $expected['school']);
		$this->assertEquals($list->course, $expected['course']);	
	}
}