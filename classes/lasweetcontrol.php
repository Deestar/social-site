<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
require 'phpmailer/vendor/autoload.php';
include "lasweetmodel.php";
class lasweetcontrol extends lasweetmodel
{
    private $username;
    private $email;
    private $password;
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    private function empt()
    {
        if (empty($this->username) || empty($this->email) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function getEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function valUsername()
    {
        if (!preg_match("/[A-Za-z0-9]/", $this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function pwd_len()
    {
        if (!strlen($this->password) > 6) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function existsUname()
    {
        if (!$this->unique_username($this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function existsmail()
    {
        if (!$this->unique_mail($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function genRand()
    {
        $str = "0123456789";
        $rand = str_shuffle($str);
        $num = substr($rand, 4, 7);
        return $num;
    }
    private function sendmail($rand)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 1; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.hostinger.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'user@example.com'; //SMTP username
            $mail->Password = 'secret'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('doyinsolafuwape@gmail.com', 'deestar');
            $mail->addAddress('joe@example.net', 'Joe User'); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'This is supposed to send your password';
            $mail->Body = 'Here is your token <b>Token in bold</b>';
            $mail->AltBody = 'For plain text';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    public function main()
    {
        if (!$this->empt()) {
            header("location:signlasuite.php?error=emp_value");
        } else if (!$this->getEmail()) {
            header("location:signlasuite.php?error=mail_err");
        } else if (!$this->valUsername()) {
            header("location:signlasuite.php?error=input_err");
        } else if (!$this->pwd_len()) {
            header("location:signlasuite.php?error=pwd_weak");
        } else if (!$this->existsUname()) {
            header("location:signlasuite.php?error=uname");
        } else if (!$this->existsmail()) {
            header("location:signlasuite.php?error=mail");
        } else if (!$this->clearToken($this->email)) {
            header("location:signlasuite.php?error=clrtkn");
        } else {
            $sec = time() + 7200;
            $exp = date("H", $sec);

            $this->confirm_mail($this->username, $this->email, $this->password, $this->genRand(), $exp);
        }
    }
}
// $object = new lasweetcontrol("eniola", 1, 2);
// var_dump($object->genRand());
