<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
require 'phpmailer/vendor/autoload.php';
function sendmail()
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 3; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'Doyinsolaafuwape2@gmail.com'; //SMTP username
        $mail->Password = 'hswhghjlbusuwqst'; //SMTP password
        $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('doyinsolafuwape2@gmail.com');
        $mail->addAddress('adeyiisreal3@gmail.com
        ', 'Adeyi0'); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Your validation token';
        $mail->Body = 'Here is your token <b>143650</b>';
        $mail->AltBody = 'For plain text';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
sendmail();
