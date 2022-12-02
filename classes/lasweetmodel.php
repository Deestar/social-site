<?php
include "lasweetdbconnect.php";
class lasweetmodel extends pdoConnect
{
    protected function unique_username($username)
    {
        $sql = "SELECT * FROM userdata WHERE username =?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:signlasuite.php?error=stmt_prep");
        } else {
            $stmt->execute([$username]);
            $getNo = $stmt->rowCount();
            if ($getNo > 0) {
                $result = false;
            } else {
                $result = true;
            }
        }
        return $result;
    }
    protected function unique_mail($email)
    {
        $sql = "SELECT * FROM userdata WHERE Gmail =?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:signlasuite.php?error=stmt_prep");
        } else {
            $stmt->execute([$email]);
            $getNo = $stmt->rowCount();
            if ($getNo > 0) {
                $result = false;
            } else {
                $result = true;
            }
        }
        return $result;
    }
    protected function insertData($username, $email, $password)
    {
        $sql = "INSERT into userdata (username,Gmail,password,status) VALUES (?,?,?,'0');";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            $stmt = null;
            header("location:signlasuite.php?error=inserterror");
            exit();
        } else {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$username, $email, $pass]);
            header("location:signlasuite.php?error=none");
        }
    }
    protected function clearToken($email)
    {
        $sql = "DELETE FROM emailvld WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$email]);
            return true;
        }
    }
    protected function confirm_mail($username, $email, $password, $validate, $expiry)
    {
        $sql = "INSERT into emailvld (username,email,PASSWORD,validator,expiry) VALUES (?,?,?,?,?);";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            $stmt = null;
            header("location:signlasuite.php?error=inserterror");
            exit();
        } else {
            $stmt->execute([$username, $email, $password, $validate, $expiry]);
            header("location:validmail.php?user=$username");
        }
    }
    protected function gettoken($username)
    {
        $sql = "SELECT * FROM emailvld where username =?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:signlasuite.php?error=gettknerr");
        } else {
            $result = $stmt->execute([$username]);
            $no = $stmt->rowCount();
            if ($no < 1) {
                header("location:signlasuite.php?err=notkn");
            } else {
                $row = $stmt->fetchAll();
                return $row;
            }
        }
    }
    protected function logUser($usermail, $password)
    {
        $sql = "SELECT * FROM userdata WHERE username =? OR Gmail =?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header('location:signlasuite.php?error=check_logstmt');
        } else {
            $stmt->execute([$usermail, $usermail]);
            $no = $stmt->rowCount();
            if ($no < 1) {
                header('location:signlasuite.php?error=logusermail_exist');
            } else {
                $columns = $stmt->fetchALL();
                var_dump($columns);
                $hashed = $columns[0]['password'];
                $verifyPwd = password_verify($password, $hashed);
                if (!$verifyPwd) {
                    header('location:signlasuite.php?error=logpwd_err');
                } else {
                    session_start();
                    $_SESSION['id'] = $columns[0]['id'];
                    $_SESSION['username'] = $columns[0]['username'];
                    header('location:index.php');
                }
            }
        }
    }
    protected function profStat($userid)
    {
        $sql = "SELECT * FROM userdata WHERE id = $userid";
        $result = $this->connect()->query($sql);
        $column = $result->fetchAll();
        $getStat = $column[0]['status'];
        if ($getStat == "0") {
            $final = false;
        } else {
            $final = $column[0]['profile'];
        }
        return $final;
    }
    protected function insertComment($userId, $Ucomment, $Cpic, $Uprofile, $exp, $username)
    {
        $sec = time();
        $sql = 'INSERT INTO tweets (userId,usercomment,commentpic,profile,expires,username,likes,dislike,time) VALUES (?,?,?,?,?,?,0,0,?)';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:index.php?error=stmtinsrt");
        } else {
            $stmt->execute([$userId, $Ucomment, $Cpic, $Uprofile, $exp, $username, $sec]);
            header("location:index.php?error=none");
        };

    }
    protected function getComments()
    {
        $sql = "SELECT * FROM tweets ORDER BY id DESC";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function getTotalLikes($id)
    {
        $sql = "SELECT * FROM tweets WHERE userId = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function addToLike($id, $username, $incr)
    {
        $sql = "UPDATE tweets SET likes = ?,likelist=? WHERE id = $id";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:lasuite.php?");
        } else { $stmt->execute([$incr, $username]);
            header("location:index.php#$id");
        }
    }
    protected function getLike($id)
    {
        $sql = "SELECT * FROM tweets WHERE id = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll();
        return $result[0]['likes'];
    }
    protected function getLikelist($id)
    {
        $sql = "SELECT * FROM tweets WHERE id = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll();
        return $result[0]['likelist'];
    }
    protected function getDislike($id)
    {
        $sql = "SELECT * FROM tweets WHERE id = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll();
        return $result[0]['dislike'];
    }
    protected function getDislikelist($id)
    {
        $sql = "SELECT * FROM tweets WHERE id = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetchAll();
        return $result[0]['dislikelist'];
    }
    protected function addToDislike($id, $username, $incr)
    {
        $sql = "UPDATE tweets SET dislike = ?,dislikelist=? WHERE id = $id";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:lasuite.php?");
        } else { $stmt->execute([$incr, $username]);
            header("location:index.php#$id");
        }
    }
    //for the replies in a comment
    protected function Ireply($replyid, $userid, $commentid, $username, $profimg, $reply, $replyimg)
    {
        $sql = 'INSERT INTO replies (replyid,userid,commentid,username,profimg,reply,replyimg) VALUES (?,?,?,?,?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:index.php?error=stmtinsrt");
        } else {
            $stmt->execute([$replyid, $userid, $commentid, $username, $profimg, $reply, $replyimg]);
            header("location:index.php?nestid=$commentid");
        };
    }
    protected function getIds()
    {
        $sql = "SELECT replyid FROM replies ORDER BY replyid DESC";
        $result = $this->connect()->query($sql);
        $row = $result->fetch();
        if (!$row) {
            return 20000;
        } else {
            return $row['replyid'];
        }
    }
    protected function returnReplies($id)
    {
        $sql = "SELECT * FROM replies WHERE commentid=$id";
        $result = $this->connect()->query($sql);
        $row = $result->fetchAll();
        if (!$row) {
            return [];
        } else {
            return $row;
        }

    }
    protected function returnReply($id)
    {
        $sql = "SELECT * FROM replies WHERE replyid=$id";
        $result = $this->connect()->query($sql);
        $row = $result->fetchAll();
        if (!$row) {
            return [];
        } else {
            return $row;
        }

    }
    protected function getReplyLikes($id)
    {
        $sql = "SELECT likes FROM replies WHERE replyid = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch();
        return $result['likes'];
    }
    protected function getReplyLikeList($id)
    {
        $sql = "SELECT likelist FROM replies WHERE replyid = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch();
        return $result['likelist'];
    }
    protected function getReplyDislikeList($id)
    {
        $sql = "SELECT dislikelist FROM replies WHERE replyid = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch();
        return $result['dislikelist'];
    }
    protected function getReplyDislikes($id)
    {
        $sql = "SELECT dislike FROM replies WHERE replyid = $id";
        $stmt = $this->connect()->query($sql);
        $result = $stmt->fetch();
        return $result['dislike'];
    }
    protected function addToReplyLike($id, $username, $incr)
    {
        $sql = "UPDATE replies SET likes = ?,likelist=? WHERE replyid = $id";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:lasuite.php?");
        } else { $stmt->execute([$incr, $username]);
            header("location:index.php?nestid=$id");
        }
    }
    protected function addToReplyDislike($id, $username, $incr)
    {
        $sql = "UPDATE replies SET dislike = ?,dislikelist=? WHERE replyid = $id";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt) {
            header("location:lasuite.php?");
        } else { $stmt->execute([$incr, $username]);
            header("location:index.php?nestid=$id");
        }
    }
    protected function getCommentNo($id)
    {
        $sql = "SELECT * FROM replies WHERE commentid = $id";
        $result = $this->connect()->query($sql);
        $no = $result->rowCount();
        return $no;
    }
    protected function getUserProfile($uname)
    {
        $sql = "SELECT `id` FROM `userdata` WHERE username =?;";
        $prepare = $this->connect()->prepare($sql);
        if (!$prepare) {
            header("location:index.php?");
        } else {
            $prepare->execute([$uname]);
            $row = $prepare->fetch();
            $no = $prepare->rowCount();
            if ($no < 1) {
                header("location:index.php?");
            } else {
                return $row;
            }

        }

    }
    protected function getTweets($id)
    {
        $sql = "SELECT * FROM tweets WHERE userId =$id";
        $row = $this->connect()->query($sql);
        $tweets = $row->fetchAll();
        return $tweets;
    }
    protected function userProfImg($id)
    {
        $sql = "SELECT `profile` FROM `userdata` WHERE id =?;";
        $prepare = $this->connect()->prepare($sql);
        if (!$prepare) {
            header("location:index.php?");
        } else {
            $prepare->execute([$id]);
            $row = $prepare->fetch();

            return $row;
        }
    }
    protected function userReplies($id)
    {
        $sql = "SELECT * FROM replies WHERE userid =$id";
        $row = $this->connect()->query($sql);
        $replies = $row->fetchAll();
        return $replies;
    }
    protected function UserTweetNo($id)
    {
        $sql = "SELECT * FROM tweets WHERE userId =$id";
        $result = $this->connect()->query($sql);
        $no = $result->rowCount();
        return $no;
    }
    protected function insertUserImg($id, $img)
    {
        $sql = "UPDATE userdata SET profile =?,status=1 WHERE id=$id";
        $result = $this->connect()->prepare($sql);
        if (!$result) {
            header('location:index.php?insterr');
        } else {
            $result->execute([$img]);
        }
    }
    protected function updprof($id, $img)
    {
        $sql = "UPDATE tweets SET profile =? WHERE userId=$id";
        $result = $this->connect()->prepare($sql);
        if (!$result) {
            header('location:index.php?stmtuplderr');
        } else {
            $result->execute([$img]);
        }

    }
    protected function updprofreply($id, $img)
    {
        $sql = "UPDATE replies SET profimg =? WHERE userid=$id";
        $result = $this->connect()->prepare($sql);
        if (!$result) {
            header('location:index.php?stmtuplderr');
        } else {
            $result->execute([$img]);
        }

    }
    protected function deleteComment($id, $username)
    {
        $sql = "DELETE FROM tweets WHERE id=$id";
        $this->connect()->query($sql);
        header("location:lasuiteprofile.php?uname=$username");

    }
    protected function deleteReply($id, $username)
    {
        $sql = "DELETE FROM replies WHERE replyid=$id";
        $stmt = $this->connect()->query($sql);
        if (!$stmt) {
            header("location:index.php?err");
        } else {
            header("location:lasuiteprofile.php?uname=$username#reply_main_cont");
        }

    }
}

// $object = new lasweetmodel;
// var_dump($object->UserTweetNo(3));
