<?php
include_once 'lasweetmodel.php';
class deletecmtcontrol extends lasweetmodel
{
    private $id;
    private $username;
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    public function deleteCmt()
    {
        $this->deleteComment($this->id, $this->username);

    }
}
