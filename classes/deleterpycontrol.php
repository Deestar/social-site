<?php
include_once 'lasweetmodel.php';
class deleterpycontrol extends lasweetmodel
{
    private $id;
    private $username;
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    public function deleteRpy()
    {
        $this->deleteReply($this->id, $this->username);
    }
}
