<?php
include_once "lasweetmodel.php";
class lasweetview extends lasweetmodel
{
    public function receiveComment()
    {
        $result = $this->getComments();
        return $result;
    }
    public function totalLikes($id)
    {
        $likes = 0;
        $result = $this->getTotalLikes($id);
        $no = count($result);
        for ($i = 0; $i < $no; $i++) {

            $likes += $result[$i]["likes"];

        }
        return $likes;
    }
    public function getlikedusers($id)
    {
        $usersArray = $this->getLikelist($id);
        $array = explode(",", $usersArray);
        return $array;
    }
    public function getdislikeusers($id)
    {
        $usersArray = $this->getDislikelist($id);
        $array = explode(",", $usersArray);
        return $array;
    }
    public function getReplydislikeusers($id)
    {
        $usersArray = $this->getReplyDislikeList($id);
        $array = explode(",", $usersArray);
        return $array;
    }
    public function getReplylikeusers($id)
    {
        $usersArray = $this->getReplyLikeList($id);
        $array = explode(",", $usersArray);
        return $array;
    }
    public function getReplies($id)
    {
        $Allreply = $this->returnReplies($id);
        return $Allreply;
    }
    public function getMainReply($id)
    {
        $Allreply = $this->returnReply($id);
        return $Allreply;
    }
    public function getCmtNo($id)
    {
        $no = $this->getCommentNo($id);
        return $no;
    }
    public function getUserId($uname)
    {
        $id = $this->getUserProfile($uname);
        return $id['id'];
    }
    public function getUserTweet($id)
    {
        $tweets = $this->getTweets($id);
        return $tweets;
    }
    public function getUserReplies($id)
    {
        $replies = $this->userReplies($id);
        return $replies;
    }
    public function getProfLink($id)
    {
        $imgLink = $this->userProfImg($id);
        if (strlen($imgLink['profile']) == 0) {
            return '/lasuprofiles/default.jpg';
        } else {
            return $imgLink['profile'];
        }

    }
    public function userCmtNo($id)
    {
        $num = $this->UserTweetNo($id);
        return $num;
    }
}

// $object = new lasweetview;
// var_dump($object->getUserTweet(6));
