<?php
include_once 'lasweetmodel.php';
class adddislikecontrol extends lasweetmodel
{
    private $id;
    private $username;
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    public function setDislikes()
    {
        $newlike = $this->getDislike($this->id) + 1;
        $getUsers = $this->getDislike($this->id) . "," . $this->username;
        $this->addToDislike($this->id, $getUsers, $newlike);

    }
}
