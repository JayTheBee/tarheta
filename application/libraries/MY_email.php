<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_email extends CI_Email{
	
    /**
    * Function for sending email using tarheta
    *
    * @param       array  		$data_arg  		 	email information
    * @param       html   		$template_arg  	 	html template
    * @param       string 		$data_arg  		 	user email
    * @return      none
    */
 	public function send_email($data_arg, $template_arg , $email_arg){
		/*
	 		* Changed the email sending. It now builds on this: https://www.youtube.com/watch?v=ctUUxx0Klng
			 	but it loads a php file rather than a string.
		*/
 		$CI =& get_instance();
		$to = $email_arg;
		$subject = $data_arg['subject'];
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

		$this->message($CI->load->view($template_arg, $data_arg, TRUE));
		$this->send();
	}
 	public function contact_us($data_arg, $template_arg){
		/*
	 		* Changed the email sending. It now builds on this: https://www.youtube.com/watch?v=ctUUxx0Klng
			 	but it loads a php file rather than a string.
		*/
 		$CI =& get_instance();
		$to = env('EMAIL');
		$subject = $data_arg['subject'];
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

		$this->message($CI->load->view($template_arg, $data_arg, TRUE));
		$this->send();
	}
}

?>
