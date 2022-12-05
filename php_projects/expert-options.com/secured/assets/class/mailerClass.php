<?php
//use PHPMailer\PHPMailer\PHPMailer;
use Egulias\EmailValidator\EmailValidator;
        use Egulias\EmailValidator\Validation\RFCValidation;

class mailer
{
    public static function sendViaPhpmailer($addAttch, $attach = '', $subj, $bodyHTML = '', $bodyText = '', $fromName, $toEmail, $toName, $replyEmail = '', $replyName = '')
    {

        require 'PHPMailer/class.phpmailer.php';
        require 'PHPMailer/class.smtp.php';

        /**
         * 
         *
         * @var
         * $replyEmail == is the email for the reply of the mail
         * $addAttch == is a number (0 or 1) to confirm if an attachment is added
         * $bodyHtml = is the url of the html file to be sent
         *
         */
        $mail = new PHPMailer(true);
        $mail->SetLanguage('en', 'PHPMailer/language/');
        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->Host = 'smtp.gmail.com';

        /*
        $mail->Host = 'scp67.hosting.reg.ru';
        $mail->Port = 465;
        $mail->Host = 'ssl://scp67.hosting.reg.ru:465';
        $mail->Host = 'scp67.hosting.reg.ru';
        $mail->Port = 465;
         */

        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );
        $mail->Priority = 1;
        $mail->WordWrap = 900;
        //$mail->Username = 'mailer.digitalplazas@gmail.com';
        //$mail->Password = 'contra1964';
        $mail->Username = 'mailer.digitalplazas@gmail.com';
        $mail->Password = 'contra1964';

        if (!empty($replyEmail)) {
            $mail->setFrom('mailer.digitalplazas@gmail.com', $fromName);
            $mail->addReplyTo($replyEmail, $replyName);
        } else {
            $mail->setFrom('mailer.digitalplazas@gmail.com', $fromName);
        }

        if (is_array($toEmail)) {
            $i = 0;
            foreach ($toEmail as $to) {
                //var_dump($toName)            ; var_dump($toEmail); die();
                $mail->addAddress($to, $toName[$i]);
                $i += 1;
            }
        } else {
            $mail->addAddress($toEmail, $toName);
        }

        $mail->Subject = $subj;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('image.html'), __DIR__);

        if ($bodyHTML == '') {
            $mail->msgHTML(false);
            $mail->Body = $bodyText;
        } else {
            $mail->isHTML(true);
            if (file_exists($bodyHTML)) {
                $msg = file_get_contents($bodyHTML, __DIR__);
                $mail->msgHTML($msg);
                $mail->altBody = strip_tags($msg);
            } else {
                $mail->msgHTML($bodyHTML);
                $mail->altBody = strip_tags($bodyHTML);
            }
        }

        if ($addAttch == 1) {
            //Attach an image file
            $mail->addAttachment($attach);
        }
        //send the message, check for errors
        if (!$mail->send()) {
            $error = "Mailer Error: " . $mail->ErrorInfo;
            return array(false, $error);
        } else {
            return (true);
            //echo "Message sent!";

        }
        //$mail->close();
    }

    public static function sendViaDefault($company, $to, $title, $msg)
    {
        $subj = $title . ' @ ' . $_SERVER['SERVER_NAME'];
        $headers = array(
            'FROM: "' . $company . '" <engine@' . $_SERVER['SERVER_NAME'] . '>',
            'Reply-To: "DO-NOT-REPLY" <noreply@' . $_SERVER['SERVER_NAME'] . '>',
            'X-Mailer: PHP/' . phpversion(),
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=utf-8',
            'Content-Transfer-Encoding: 7bit',
            
        );
        $headers = implode("\r\n", $headers);

        $messagebody = $msg;
        $message = '';

        $message .= $messagebody . "\r\n";

        $mailsent = mail($to, $subj, $message, $headers);

        if ($mailsent) {
            $result = 1;
        } else {
            $result = 0;
        }

        return ($result);
    }

    public static function sendviaSwift($to_email, $to_name, $from, $subject, $textmail, $htmlmail = null, $attachment = null)
    //public static function sendviaSwift()
    {

        require_once 'swiftmailer/vendor/autoload.php';
        
        $validator = new EmailValidator();

        //require_once 'swiftmailer/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

        // Create the Transport
        $transport = (new Swift_SmtpTransport(SMTP_HOST, 465, 'ssl'))  // gmail usage
        //$transport = (new Swift_SmtpTransport(SMTP_HOST, 587, 'tls'))  // other secure smtp
            ->setUsername(MAIL_USERNAME)
            ->setPassword(MAIL_PASSWORD);
//var_dump($transport); die();
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            
            // Create a message
            $message = (new Swift_Message($subject))
              ->setFrom([$from['email'] => $from['name']])
              ->setBody($textmail)
              ;


              if ($htmlmail != '') {

                //And optionally an alternative body
                $message->addPart($htmlmail, 'text/html');
            }
    
            if ($attachment != '') {
    
                //Optionally add any attachments
                $message->attach(
                    Swift_Attachment::fromPath($attachment)->setDisposition('inline')
                );
            }
              
// Send the message
$failedRecipients = [];
$numSent = 0;
//$to = ['receiver@domain.org', 'other@domain.org' => 'A name'];

if(is_array($to_email)){
$i = 0;
foreach ($to_email as $address)
{
  
    
    if(($validator->isValid($address, new RFCValidation())) == 'true'){
        $message->setTo([$address => $to_name[$i]]);

        $numSent += $mailer->send($message, $failedRecipients);
    }else{
        continue;
    }
    
  ++$i;
}

}else{
    if(($validator->isValid($to_email, new RFCValidation())) == 'true'){
        $message->setTo([$to_email => $to_name]);

        $numSent += $mailer->send($message, $failedRecipients);
    }else{
        //$numSent 
    }
}

//printf("Sent %d messages\n", $numSent);
return $numSent;

}
}
