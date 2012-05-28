<?php
class Aula_Model_Mailing extends Aula_Model_Default {
	
	public function sendHTMLMail($contents = array( ), $email = ZARCON_EMAIL_INFO, $subject = ZARCON_SITE_DOMAIN) {
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: " . ZARCON_SITE_DOMAIN . " <" . ZARCON_EMAIL_WEBMASTER . ">\r\n"; //define constants
		$headers .= 'Bcc: email1@msn.com, email2@yahoo.com, email3@aol.com' . "\r\n";
		
		$message = '<html><head><title>' . ZARCON_SITE_TITLE . '</title></head><body> <table>';
		
		foreach ( $contents as $key => $value ) {
			$message .= '<tr><td>' . $key . $value . '</td></tr>';
		}
		
		$message .= '</table></body></html>';
		
		return mail ( $email, $subject, $message, $headers );
	
	}
	
	public function sendNewPass($user, $email, $pass) {
		$from = "From: " . ZARCON_SITE_DOMAIN . " <" . ZARCON_EMAIL_WEBMASTER . ">"; //your constants name
		$subject = "Your new password";
		$body = $user . ",\n\n" . "We've generated a new password for you at your " . "request, you can use this new password with your " . "username to log in our site.\n\n" . "Username: " . $user . "\n" . "New Password: " . $pass . "\n\n" . "- Your Site";
		
		return mail ( $email, $subject, $body, $from );
	}
}