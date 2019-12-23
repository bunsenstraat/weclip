<?php

	class WECLIP_MAILER {
		
		public function __construct() {
			require_once('PHPMailerAutoload.php');
		}
	
		public function template($file) {
			if (substr($file,0,1) != '/') {
				$file = ABSPATH . 'wp-content/themes/weclip/email/' . $file;
			}
			if (!file_exists($file)) {
				die('Template file does not exist');
			}
			return str_replace('"', '\"', str_replace('\\', '\\\\', file_get_contents($file)));
		}
		
		public function send($to,$subject,$message,$from=false, $server) {
			
			if (!is_array($to) || !isset($to['email'])) {
				die('Invalid receipient');
			}
			if (is_array($from)) {
				if (!isset($from['email'])) {
					die('Invalid sender');
				}
				$from['name'] = ($from['name']) ? $from['name'] : $from['email'];
			} else {
				$from = array(
					'email' => 'info@weclip.nl',
					'name' => 'WeClip.nl'
				);
			}
			$to['name'] = ($to['name']) ? $to['name'] : $to['email'];
			
			$mail = new PHPMailer();
			#$mail->isSendmail();
			$mail->setFrom($from['email'], $from['name']);
			#$mail->addReplyTo('replyto@example.com', 'First Last');
			$mail->addAddress($to['email'], $to['name']);
			$mail->Subject = $subject;
			$mail->msgHTML($message, ABSPATH);
			$mail->AltBody = $mail->normalizeBreaks($mail->html2text($message, false));
			
			//server settings
			if($server->smtp){
			$mail->IsSMTP();
			$mail->Host = $server->host;
			$mail->SMTPAuth = $server->smtp;
			$mail->Port = $server->port;
			$mail->Username   = $server->username; // SMTP account username
			$mail->Password   = $server->password;  
			}
			//$mail->addAttachment('images/phpmailer_mini.gif');

			if (!$mail->send()) {
				die("Mailer Error: " . $mail->ErrorInfo);
			}
			
			return true;
		}
		
	}
