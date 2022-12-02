<?php
include_once 'lasweetmodel.php';
class incrdislikecontrol extends lasweetmodel
{
    private $id;
    private $username;
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    //increases dislike  for replies in a comment
    public function setDislike()
    {
        $newlike = $this->getReplyDislikes($this->id) + 1;
        $getUsers = $this->getReplyDislikeList($this->id) . "," . $this->username;

        try {
            $this->addToReplyDislike($this->id, $getUsers, $newlike);
        } catch (PDOException $th) {
            echo "AN ERROR HAS OCCURED KINDLY REFRESH YOUR PAGE. IF THE ERROR PERSIST PLEASE CONTACT SUPPORT";
        }
    }
}
