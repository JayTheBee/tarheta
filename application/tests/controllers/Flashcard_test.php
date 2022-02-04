<?php
/**
 * @test
 * 
 **/
class Flashcard_test extends TestCase {
    public function test_Flaschard_show_fail(){
        $flashcard_id_var = 1;
        $this->request('GET', 'flashcard/flashcards/show/'.$flashcard_id_var);
        $this->assertRedirect(base_url('flashcards/index'));
    }
    public function test_Flaschard_show_true(){
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
        $flashcard_id_var = 1;
        $response = $this->request('GET', 'flashcard/flashcards/show/'.$flashcard_id_var);
        $this->assertStringContainsString("<!-- Flashcard Creator Available Buttons -->", $response);
    }


    public function test_Flaschard_create_false(){
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
                $this->verifyInvokedMultipleTimes($validation, 'set_rules', 7);
                $this->verifyInvokedOnce($validation, 'run');
                // Inject mock object
                $CI->form_validation = $validation;
            }
        );

        $_SESSION['sess_profile']['user_id'] = 2;
        $_SESSION['sess_user_type'] = [ 
            'id' => 2, 
            'user_id'=> 2, 
            'type' => 'TEACHER' 
        ];
        $response = $this->request('POST', 'flashcard/flashcards/create_flashcards', $_SESSION);
        $this->assertStringContainsString("CREATE A FLASHCARD", $response);

    }
         // cant ascertain the input for time_open
    // public function test_Flaschard_create_true(){
    //     $flashcard = [
    //         'name' => 'new_Flashcard',
    //         'description' => 'new_Flashcard_desc',
    //         'type' => 'REVIEWER',
    //         'visibility' => 'PRIVATE',
    //         'time_open' => '0000-00-00',
    //         'time_close' => '0000-00-00',
    //         'category' => 'Spanish',

    //     ];
    //     $_SESSION['sess_profile']['user_id'] = 2;
    //     $_SESSION['sess_user_type'] = [ 
    //         'id' => 2, 
    //         'user_id'=> 2, 
    //         'type' => 'TEACHER' 
    //     ];
    //     $response = $this->request('POST', 'flashcard/flashcards/create_flashcards', $flashcard, $_SESSION);
    //     $this->assertStringContainsString("QUESTIONS", $response);
    // }
      
}