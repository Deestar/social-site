<?php
include_once 'lasweetmodel.php';
class addLikescontrol extends lasweetmodel
{
    private $id;
    private $username;
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    //Increases no of likes by getting previous likes and adds username from the gotten username list with a comma
    public function setLikes()
    {
        $newlike = $this->getLike($this->id) + 1;
        $getUsers = $this->getLikelist($this->id) . "," . $this->username;
        $this->addToLike($this->id, $getUsers, $newlike);

    }
}
