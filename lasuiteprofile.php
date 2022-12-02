<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/a4859f6e24.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/profile.css">
    <?php
if (!isset($_GET['uname'])) {
    header('location:index.php');
} else if ($_GET['uname'] == null) {
    header('location:index.php');
} else {
    session_start();
    include_once 'autoload.php';
    $object = new getProfile($_GET['uname']);
}
class getProfile
{
    private $username;
    private $id;
    private $object;
    public function __construct($uname)
    {
        $this->username = $uname;
        $this->object = new lasweetview;
        $this->id = $this->object->getUserId($this->username);

    }
    public function user_name()
    {
        echo $this->username;
    }
    public function no_likes()
    {
        $likes = $this->object->totalLikes($this->id);
        echo $likes;
    }
    public function cmt_no()
    {
        $cmt = $this->object->userCmtNo($this->id);
        echo $cmt;
    }
    //No of comment a reply has
    public function getCommentNo($id)
    {
        $no = $this->object->getCmtNo($id);
        return $no;
    }
    //To display the users comment
    public function displayComments()
    {
        $cmtArray = $this->object->getUserTweet($this->id);
        $no = count($cmtArray);
        for ($i = 0; $i < $no; $i++) {
            echo ' <div class="tweet_cont" id="' . $cmtArray[$i]['id'] . '">
            <div class="prof_cont">
        <div class="img_prof" style="--tweet_prof:url(/projects/lasu_project/' . $cmtArray[$i]["profile"] . ');"></div>
            </div>
            <div class="tweet_box">
                <div class="username">
                <div>' . $cmtArray[$i]['username'] . '</div>
                    ' . $this->checkDelete($cmtArray[$i]['id']) . '
                </div>
                <div class="text">' . $cmtArray[$i]['usercomment'] . '</div>
                <div class="img_cont"> <img src="' . $cmtArray[$i]['commentpic'] . '"></div>
                <div class="reactions">
                <i class="' . $this->checkLike($cmtArray[$i]['id']) . '">' . $cmtArray[$i]['likes'] . '</i>
                    <i class="' . $this->checkDislike($cmtArray[$i]['id']) . '">' . $cmtArray[$i]['dislike'] . '</i>
                    <i class="fa-regular fa-comment">' . $this->getCommentNo($cmtArray[$i]['id']) . '</i>
                    </div>
                </div>
            </div>
    ';
        }
    }
    public function displayReplies()
    {
        $replies = $this->object->getUserReplies($this->id);
        $no = count($replies);
        for ($i = 0; $i < $no; $i++) {
            echo '<div class="reply tweet_cont"  id= "' . $replies[$i]['replyid'] . '">
            <div class="prof_cont">
            <div class="img_prof" style="--tweet_prof:url(/projects/lasu_project/' . $replies[$i]["profimg"] . ');"></div>
            </div>
            <div class="tweet_box">
                <div class="username">
                    <div>' . $replies[$i]['username'] . '</div>
                    ' . $this->checkRDelete($replies[$i]['replyid']) . '
            </div>
                <div class="text">' . $replies[$i]['reply'] . '</div>
                <div class="img_cont"> <img src="' . $replies[$i]['replyimg'] . '"></div>
                <div class="reactions">
                <i class="' . $this->checkRLike($replies[$i]['replyid']) . '">' . $replies[$i]['likes'] . '</i>
                    <i class="' . $this->checkRDislike($replies[$i]['replyid']) . '">' . $replies[$i]['dislike'] . '</i>
                    <i class="fa-regular fa-comment">' . $this->getCommentNo($replies[$i]['replyid']) . '</i>
                </div>
            </div>
        </div>';
        }
    }
    public function checkUpload()
    {
        if (!isset($_SESSION['username'])) {
            echo "";
        } else if ($_SESSION['username'] != $this->username) {
            echo "";
        } else {
            echo '  <form action="lasuiteupload.c.php" method="POST" enctype="multipart/form-data">
            <label><i class="fa-solid fa-image"></i>
            <input type="file" name="img"></label>
            <button type="submit" name="submit">&larr; upload profile pic</button>
           </form>';
        }

    }
    public function checkstatus()
    {
        if (!isset($_SESSION['username'])) {
            echo "";
        } else if ($_SESSION['username'] != $this->username) {
            echo "";
        } else {
            echo '<a >upload status</a>';
        }

    }
    public function checkDelete($id)
    {
        if (!isset($_SESSION['username'])) {
            echo "";
        } else if ($_SESSION['username'] != $this->username) {
            echo "";
        } else {
            return "<a href='deletecmt.c.php?id=$id' class='delete'>Delete</a>";
        }

    }
    public function checkRDelete($id)
    {
        if (!isset($_SESSION['username'])) {
            echo "";
        } else if ($_SESSION['username'] != $this->username) {
            echo "";
        } else {
            return "<a href='deleterpy.c.php?id=$id' class='delete'>Delete</a>";
        }

    }
    public function checkLike($id)
    {
        if (!isset($_SESSION['id'])) {
            return 'fa-regular fa-heart like';
        } else {
            $username = $_SESSION['username'];
            $array = $this->object->getlikedusers($id);
            if (in_array($username, $array)) {
                return 'fa-solid fa-heart liked';
            } else {
                return 'fa-regular fa-heart like ';
            }
        }
    }
    public function checkDislike($id)
    {
        if (!isset($_SESSION['id'])) {
            return 'fa-regular fa-thumbs-down dislike';
        } else {
            $username = $_SESSION['username'];
            $array = $this->object->getdislikeusers($id);
            if (in_array($username, $array)) {
                return 'fa-solid fa-thumbs-down disliked';
            } else {
                return 'fa-regular fa-thumbs-down dislike';
            }
        }
    }
    //for nested likes
    public function checkRDislike($id)
    {
        if (!isset($_SESSION['id'])) {
            return 'fa-regular fa-thumbs-down Rdislike';
        } else {
            $username = $_SESSION['username'];
            $array = $this->object->getReplydislikeusers($id);
            if (in_array($username, $array)) {
                return 'fa-solid fa-thumbs-down disliked';
            } else {
                return 'fa-regular fa-thumbs-down Rdislike';
            }
        }
    }

    public function checkRLike($id)
    {
        if (!isset($_SESSION['id'])) {
            return 'fa-regular fa-heart Rlike';
        } else {
            $username = $_SESSION['username'];
            $array = $this->object->getReplylikeusers($id);
            if (in_array($username, $array)) {
                return 'fa-solid fa-heart liked';
            } else {
                return 'fa-regular fa-heart Rlike ';
            }
        }
    }
    public function getLink()
    {
        $lnk = $this->object->getProfLink($this->id);
        echo ' <div class="prof_img" style="--tweet_prof:url(/projects/lasu_project/' . $lnk . ');"></div>';
    }
}
?>
</head>
<body>
<div class="main_cont">
    <!-- THE CONTAINER FOR USER PROFILE ETC.. -->
 <div class="prof_info">
    <header>
  <div>&larr;</div>
    <?php $object->checkUpload();?>
    </header>
    <div class="user_info">
         <?php $object->getLink();?>
        <div class="user_name"><?php $object->user_name()?></div>
    </div>
    <div class="cmt_like">
        <div class="likeno">No of likes: <span><?php $object->no_likes()?></span></div>
        <div class="cmtno">No of comment:<span><?php $object->cmt_no()?></span></div>
    </div>
    <div class="u_status">
        <div class="status">STUDENT</div>
        <?php $object->checkstatus();?>
    </div>
 </div>
 <!-- THE CONTAINER FOR BUTTONS THAT SWITCH -->
 <div class="switch">
 <a href="#tweet_main_cont">Lasweets</a>
 <a href="#reply_main_cont">Replies</a>
 </div>
 <!-- THE GENERAL CONTAINER OF TWEETS AND REPLIES BOX -->
<div class="gen_tweet_cont">
       <!-- CONTAINING EACH TWEET AND PROFILE -->
    <div id="tweet_main_cont">
        <?php $object->displayComments();?>
        </div>
        <div id="reply_main_cont">
            <?php $object->displayReplies();?>
    </div>
    </div>
    <footer>
    <i class="fa-solid fa-house"></i>
    <i class="fa-regular fa-heart"></i>
    <i class="fa-solid fa-magnifying-glass"></i>
    <i class="fa-solid fa-bell"></i>
</footer>

</div>



</body>
<script src="js/lasuprofile.js"></script>
</html>
