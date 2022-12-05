<?php
//use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/class.phpmailer.php';
require 'PHPMailer/class.smtp.php';
class mailer{
	public static function Forward($addAttch, $attach = '', $subj, $bodyHTML = '', $bodyText = '', $fromName, $toEmail, $toName, $replyEmail = '', $replyName = ''){
		/**
		* 
		* @var 
		* $replyEmail == is the email for the reply of the mail
		* $addAttch == is a number (0 or 1) to confirm if an attachment is added
		* $bodyHtml = is the url of the html file to be sent
		* 
		*/
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Host = 'tls://smtp.gmail.com:587';
		$mail->Host = 'smtp.gmail.com';
		
		/*
		$mail->Host = 'crypto-zone.org';
		$mail->Port = 465;
		$mail->Host = 'ssl://crypto-zone.org:465';
		$mail->Host = 'crypto-zone.org';
		*/
		
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$mail->Priority = 1;
		$mail->WordWrap = 900;
		//$mail->Username = 'mailer.digitalplazas@gmail.com';
		//$mail->Password = 'contra1964';
		$mail->Username = 'mailer.digitalplazas@gmail.com';
		$mail->Password = 'contra1964';
		
		if(!empty($replyEmail)){
			$mail->setFrom('mailer.digitalplazas@gmail.com', $fromName);
			$mail->addReplyTo($replyEmail, $replyName);
		}else{
			$mail->setFrom('mailer.digitalplazas@gmail.com', $fromName);
		}

		if(is_array($toEmail)){
			$i = 0;
			foreach($toEmail as $to){				
				$mail->addAddress($to, $toName[$i]);
				$i += 1;
			}
			
		}else{
			$mail->addAddress($toEmail, $toName);
		}
		
		$mail->Subject = $subj;

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('image.html'), __DIR__);
		
		if($bodyHTML == ''){
			$mail->msgHTML(false);
			$mail->Body = $bodyText;
		}else{
			$mail->isHTML(true);
			if(file_exists($bodyHTML)){
				$msg = file_get_contents($bodyHTML, __DIR__);
				$mail->msgHTML($msg);
				$mail->altBody = strip_tags($msg);
			}else{
				$mail->msgHTML($bodyHTML);
				$mail->altBody = strip_tags($bodyHTML);
			}
		}
		
		if($addAttch == 1){
			//Attach an image file
			$mail->addAttachment($attach);
		}
		//send the message, check for errors
		if(!$mail->send()){
			$error = "Mailer Error: " . $mail->ErrorInfo;
			return array(FALSE, $error);
		} else{
			return(TRUE);
			//echo "Message sent!";
	
		}
		//$mail->close();
	}
}

?>