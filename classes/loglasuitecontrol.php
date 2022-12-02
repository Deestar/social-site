<?php
include_once 'lasweetmodel.php';
class loglasuitecontrol extends lasweetmodel
{
    private $usermail;
    private $password;
    public function __construct($usermail, $password)
    {
        $this->usermail = $usermail;
        $this->password = $password;
    }
    private function empt()
    {
        if (empty($this->usermail) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    public function main()
    {
        if (!$this->empt()) {
            header('location:signlasuite.php?error=empt_log');
        } else {
            $this->logUser($this->usermail, $this->password);
        }
    }
}
