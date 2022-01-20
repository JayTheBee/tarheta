<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


/* Scoring routes */
$route['flashcards/score-user/(:any)/(:any)'] = 'flashcard/scorings/score_user/$1/$2';
$route['flashcards/ranking/(:any)/(:any)'] = "flashcard/scorings/ranking/$1/$2";


/* Flashcards routes */
$route['flashcards/result/(:any)/(:any)'] = 'flashcard/scorings/result/$1/$2';
$route['flashcards/submit-answer'] = 'flashcard/flashcards/submit_answer';
$route['flashcards/get-data/(:any)'] = 'flashcard/flashcards/get_data/$1';
$route['flashcards/answer/(:any)'] = 'flashcard/flashcards/answer/$1';
$route['flashcards/delete-question/(:any)'] = 'flashcard/flashcards/delete_question/$1';

$route['flashcards/edit/(:any)/(:any)'] = 'flashcard/flashcards/edit/$1/$2';
$route['flashcards/update/flashcard/(:any)'] = 'flashcard/flashcards/update_flashcard/$1';

$route['flashcards/share/(:any)'] = 'flashcard/flashcards/share/$1';
$route['flashcards/show/(:any)'] = 'flashcard/flashcards/show/$1';
$route['flashcards/questions'] = 'flashcard/flashcards/questions';
$route['flashcards/save_question'] = 'flashcard/flashcards/save_question';
$route['flashcards/create_flashcards'] = 'flashcard/flashcards/create_flashcards';
$route['flashcards/reopen/(:any)'] = 'flashcard/flashcards/reopen/$1';
$route['flashcards/updateTime/(:any)'] = 'flashcard/flashcards/updateTime/$1';
$route['flashcards/create_set'] = 'flashcard/flashcards/create_set/';
$route['flashcards/(:any)'] = 'flashcard/flashcards/view/$1';


$route['classes/join'] = 'class/classes/join';
$route['classes/index/'] = 'class/classes/index/';
$route['classes/create_classes'] = 'class/classes/create_classes';
$route['classes/show/(:any)'] = 'class/classes/show/$1';
$route['classes/(:any)'] = 'class/classes/view/$1';


$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
