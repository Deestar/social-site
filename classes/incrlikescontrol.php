<?php
include_once 'lasweetmodel.php';
class incrlikescontrol extends lasweetmodel
{
    private $id;
    private $username;
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    //increases likes for replies in a comment
    public function setLike()
    {
        $newlike = $this->getReplyLikes($this->id) + 1;
        $getUsers = $this->getReplyLikeList($this->id) . "," . $this->username;
        try {
            $this->addToReplyLike($this->id, $getUsers, $newlike);
        } catch (PDOException $th) {
            echo "AN ERROR HAS OCCURED KINDLY REFRESH YOUR PAGE!! IF THIS ERROR PERSIST PLEASE CONTACT SUPPORT";
        }

    }
}
