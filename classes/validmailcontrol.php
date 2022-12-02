<?php
include_once 'lasweetmodel.php';
class validmailcontrol extends lasweetmodel
{
    private $token;
    private $user;
    public function __construct($validate, $user)
    {
        $this->token = $validate;
        $this->user = $user;
    }
    private function confirm()
    {
        $row = $this->gettoken($this->user);
        $sec = time();
        $hr = date('H', $sec);
        if ($this->token != $row[0]['validator']) {
            return false;
        } else if ($row[0]['expiry'] < $hr) {
            return false;
        } else {
            return true;
        }

    }
    public function finalSign()
    {
        if (!$this->confirm()) {
            header('location:signlasuite.php?error=wrngtkn');
        } else {
            $row = $this->gettoken($this->user);
            $username = $row[0]['username'];
            $password = $row[0]['PASSWORD'];
            $email = $row[0]['email'];
            $this->insertData($username, $email, $password);
            $this->clearToken($email);
            header('location:signlasuite.php?error=none');
        }
    }
}
