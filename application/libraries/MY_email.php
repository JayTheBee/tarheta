<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_email extends CI_Email{
	

 	function send_email($data, $emailTemplate, $email){
		/*
	 		* Changed the email sending. It now builds on this: https://www.youtube.com/watch?v=ctUUxx0Klng
			 	but it loads a php file rather than a string.
		*/
 		$CI =& get_instance();
		$to = $email;
		$subject = $data['subject'];
		$from = env('EMAIL');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_timeout'] = '60';
		
		$config['smtp_user'] = env('EMAIL');
		$config['smtp_pass'] = env('EMAIL_PASSWORD');
		
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE;

		$this->initialize($config);
		$this->set_mailtype("html");
		$this->from($from);
		$this->to($to);
		$this->subject($subject);

		$this->message($CI->load->view($emailTemplate,$data,true));
		$this->send();
	}
}

?>
