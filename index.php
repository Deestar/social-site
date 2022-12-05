<!DOCTYPE html>
<html lang="en">
<head>
    <?php
session_start();
include_once "autoload.php";
//if user is loggedin the profile side menu should link to the profile page
function profilelnk()
{
    if (!isset($_SESSION['id'])) {
        echo '<a href="signlasuite.php">Profile</a>';
    } else {
        $username = $_SESSION['username'];
        echo '<a href="lasuiteprofile.php?uname=' . $username . '">Profile</a>';
    }
}
if (isset($_GET['replyid'])) {
    $id = $_GET['replyid'];
    if ($id == null) {
        header('location:index.php');
    } else {
        setcookie('nested', "", time() - 10000000);
        setcookie('replyid', $id);
    }

}
if (isset($_GET['nestid'])) {
    $id = $_GET['nestid'];
    if ($id == null) {
        header('location:index.php');
    } else {
        setcookie('replyid', "", time() - 1000000);
        setcookie('nested', $id);
    }

}
if (isset($_GET['nestid'])) {
    $id = $_GET['nestid'];
    if ($id != null && $id < 20000) {
        header("location:index.php?replyid=$id");
    }

}
//for the number of comments
function getCommentNo($id)
{
    $object = new lasweetview;
    $no = $object->getCmtNo($id);
    return $no;
}
//For main comment and the first replies
function showReplies()
{
    if (isset($_GET['replyid'])) {
        $id = $_GET['replyid'];
        if ($id == null) {
            header('location:index.php');
        } else {
            $object = new lasweetview;
            $replyInfo = $object->getReplies($id);
            echo '<div class="replies_main_cont">
        <header>
            <div>&larr;</div>
            <b>TWEET</b>
        </header>
        <!-- The main body that contain comment and reply-->
        <div class="reply_body_cont">
        <!-- The main main comment container The inner html will be same as clicked element-->
            <div class="comment_cont" id="' . $id . '">
            </div>';
            $no = count($replyInfo);
            for ($i = 0; $i < $no; $i++) {
                echo ' <div class="reply_main_cont" id="' . $replyInfo[$i]['replyid'] . '">
            <!-- The  cont for each reply and prof img-->
                    <div class="reply_cont">
                    <div class="prof_img_cont">
                        <div class="reply_prof" style="--reply_prof:url(/projects/lasu_project/' . $replyInfo[$i]['profimg'] . ');"></div>
                    </div>
                    <div class="reply">
                        <div class="reply_name">' . $replyInfo[$i]['username'] . '</div>
                        <div class="reply_text">' . $replyInfo[$i]['reply'] . '</div>
                        <div class="reply_img"> <img src="' . $replyInfo[$i]['replyimg'] . '"></div>
                        <div class="reply_reaction" id="' . $replyInfo[$i]['replyid'] . '">
                        <i class="' . checkRLike($replyInfo[$i]['replyid']) . '">' . $replyInfo[$i]['likes'] . '</i>
                                <i class="fa-regular fa-comment">' . getCommentNo($replyInfo[$i]['replyid']) . '</i>
                                <i class="' . checkRDislike($replyInfo[$i]['replyid']) . '">' . $replyInfo[$i]['dislike'] . '</i>
                        </div>
                    </div>
                    </div>
                </div>';
            }
            echo '</div>
        <footer>
        <form method="POST" enctype="multipart/form-data"  action="lasulikes.c.php?id=' . $id . '">
        <textarea name="comment" placeholder="Whats Happening?" maxlength="140"></textarea>
        <label><i class="fa-regular fa-image"></i>
            <input type="file"  name="img">
            <input type ="hidden" name="cmtid" value = "' . $id . '">
        </label>
            <button type="submit" name="submit">Post</button>
        </form>
        </footer>
        </div>';
        }
    }
}
//FOR THE REPLIES IN A COMMENT
function showNestedReplies()
{
    if (isset($_GET['nestid'])) {
        $id = $_GET['nestid'];
        if ($id == null) {
            header('location:index.php');
        } else {
            $object = new lasweetview;
            $replyInfo = $object->getReplies($id);
            $maincmt = $object->getMainReply($id);
            $cmtno = count($maincmt);
            for ($i = 0; $i < $cmtno; $i++) {
                echo '<div class="replies_main_cont">
            <header>
                <div>&larr;</div>
                <b>TWEET</b>
            </header>
            <!-- The main body that contain comment and reply-->
            <div class="reply_body_cont">
            <!-- The main main comment container The inner html will be same as clicked element-->
                <div class="comment_cont">
                    <div class="main_cmt_info" id="' . $maincmt[$i]['replyid'] . '">
                        <div class="main_cmt_prof" style="--main_cmt_prof:url(/projects/lasu_project/' . $maincmt[$i]['profimg'] . ');"></div>
                    </div>
                    <div class= "main_extra">
                    <b>' . $maincmt[$i]['username'] . '</b>
                    <div class="main_cmt_text">' . $maincmt[$i]['reply'] . '</div>
                    <div class="reply_reaction" id="' . $maincmt[$i]['replyid'] . '">
                    <i class="' . checkRLike($maincmt[$i]['replyid']) . '">' . $maincmt[$i]['likes'] . '</i>
                            <i class="fa-regular fa-comment">' . getCommentNo($maincmt[$i]['replyid']) . ' </i>
                            <i class="' . checkRDislike($maincmt[$i]['replyid']) . '">' . $maincmt[$i]['dislike'] . '</i>
                    </div>
                    </div>
                </div>';
            }

            $no = count($replyInfo);
            for ($i = 0; $i < $no; $i++) {
                echo ' <div class="reply_main_cont" id="' . $replyInfo[$i]['replyid'] . '">
            <!-- The  cont for each reply and prof img-->
                    <div class="reply_cont">
                    <div class="prof_img_cont">
                        <div class="reply_prof" style="--reply_prof:url(/projects/lasu_project/' . $replyInfo[$i]['profimg'] . ');"></div>
                    </div>
                    <div class="reply">
                        <div class="reply_name">' . $replyInfo[$i]['username'] . '</div>
                        <div class="reply_text">' . $replyInfo[$i]['reply'] . '</div>
                        <div class="reply_img"> <img src="' . $replyInfo[$i]['replyimg'] . '"></div>
                        <div class="reply_reaction" id="' . $replyInfo[$i]['replyid'] . '">
                        <i class="' . checkRLike($replyInfo[$i]['replyid']) . '">' . $replyInfo[$i]['likes'] . '</i>
                                <i class="fa-regular fa-comment">' . getCommentNo($replyInfo[$i]['replyid']) . '</i>
                                <i class="' . checkRDislike($replyInfo[$i]['replyid']) . '">' . $replyInfo[$i]['dislike'] . '</i>
                        </div>
                    </div>
                    </div>
                </div>';
            }
            echo '</div>
        <footer>
        <form method="POST" enctype="multipart/form-data"  action="">
        <textarea name="comment" placeholder="Whats Happening?" maxlength="140"></textarea>
        <label><i class="fa-regular fa-image"></i>
            <input type="file"  name="img">
        </label>
            <button type="submit" name="submit">Post</button>
        </form>
        </footer>
        </div>';
        }
    }
}
function displayComments()
{
    $object = new lasweetview;
    $results = $object->receiveComment();
    $no = count($results);
    for ($i = 0; $i < $no; $i++) {
        $getTime = $results[$i]["time"];
        $d = date(DATE_ISO8601, $getTime);
        $spl = substr($d, 2, 11);
        $rep = str_replace("-", "/", $spl);
        $date = str_replace("T", " ", $rep);
        $hrs = $date . "hr";
        echo '<div class="main_laswuit_cont" id="' . $results[$i]["id"] . '">
        <div class="laswuit_img_cont">
    <div class="laswuit_img" style="--lasweet_prof:url(/projects/lasu_project/' . $results[$i]["profile"] . ');"></div>
</div>
<!-- THE CONTAINER FOR THE USERNAME TEXT IMAGE AND LIKES -->
<div class="laswuit_cont" id="' . $results[$i]["id"] . '">
<div class="laswuit_info"><b>' . $results[$i]["username"] . '</b><span>.' . $hrs . '</span></div>
<div class="laswuit">' . $results[$i]["usercomment"] . '</div>
<div class="text_img"><img src="' . $results[$i]["commentpic"] . '" alt=""> </div>
<div class="reactions" >
    <i class="' . checkLike($results[$i]["id"]) . '"> ' . $results[$i]["likes"] . '</i>
    <i class="fa-regular fa-comment "> ' . getCommentNo($results[$i]["id"]) . '</i>
    <i class="' . checkDislike($results[$i]["id"]) . '"> ' . $results[$i]["dislike"] . '</i>
</div>
</div>
</div>
';
    }
}
//assigns a class after checking the array from dtabase
function checkDislike($id)
{
    if (!isset($_SESSION['id'])) {
        return 'fa-regular fa-thumbs-down dislike';
    } else {
        $object = new lasweetview;
        $username = $_SESSION['username'];
        $array = $object->getdislikeusers($id);
        if (in_array($username, $array)) {
            return 'fa-solid fa-thumbs-down disliked';
        } else {
            return 'fa-regular fa-thumbs-down dislike';
        }
    }
}
//Dislike for nested replies
function checkRDislike($id)
{
    if (!isset($_SESSION['id'])) {
        return 'fa-regular fa-thumbs-down Rdislike';
    } else {
        $object = new lasweetview;
        $username = $_SESSION['username'];
        $array = $object->getReplydislikeusers($id);
        if (in_array($username, $array)) {
            return 'fa-solid fa-thumbs-down disliked';
        } else {
            return 'fa-regular fa-thumbs-down Rdislike';
        }
    }
}
//for nested likes
function checkRLike($id)
{
    if (!isset($_SESSION['id'])) {
        return 'fa-regular fa-heart Rlike';
    } else {
        $object = new lasweetview;
        $username = $_SESSION['username'];
        $array = $object->getReplylikeusers($id);
        if (in_array($username, $array)) {
            return 'fa-solid fa-heart liked';
        } else {
            return 'fa-regular fa-heart Rlike ';
        }
    }
}
function checkLike($id)
{
    if (!isset($_SESSION['id'])) {
        return 'fa-regular fa-heart like';
    } else {
        $object = new lasweetview;
        $username = $_SESSION['username'];
        $array = $object->getlikedusers($id);
        if (in_array($username, $array)) {
            return 'fa-solid fa-heart liked';
        } else {
            return 'fa-regular fa-heart like ';
        }
    }
}
function getLike()
{
    if (!isset($_SESSION['id'])) {
        echo "";
    } else { $object = new lasweetview;
        $id = $_SESSION['id'];
        $totalLikes = $object->totalLikes($id);
        echo '  Total Likes: <span> ' . $totalLikes . '</span>';
    }
}
function btn()
{
    if (isset($_SESSION['id'])) {
        echo '<a href="logoutlasuite.c.php" class="button">LOGOUT</a>';
    } else {
        echo '<a href="signlasuite.php" class="button">Sign in / Sign up</a>';
    }
}
//places login or logout based on session
function Mobilebtn()
{
    if (isset($_SESSION['id'])) {
        echo '   <a href="logoutlasuite.c.php" class="button" style="font-size:20px;">Logout</a>';
    } else {
        echo '   <a href="signlasuite.php" class="button" style="font-size:20px;">Login</a>';
    }
}
// var_dump($_SESSION['id']);
?>
<script src="https://kit.fontawesome.com/a4859f6e24.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only Lasweets</title>
    <link rel="stylesheet" href="css/laswuit.css">
</head>
<body>
<!-- TEXT BOX -->
<form  method="POST" enctype="multipart/form-data" class="textarea_cont">
<div class="post_header">
    <i> &times; </i>
   <label><i class="fa-regular fa-image"></i>
    <input type="file"  name="img">
</label>
    <button type="submit" name="submit">Post</button>
</div>
<div class="user_txt"><textarea name="comment" class="area" placeholder="What's Happening?" maxlength="140"></textarea></div>
</form>
<div class="main_cont">
<header>
    <div class="main_prof_img" style="--main_prof:url(/imgbck.jpg);"></div>
        <div class="title">
            <b>LASWUIT</b>
    </div>
        <div class="bck_change">
        <!-- <i class="fa-solid fa-sun"></i> -->
        <i class="fa-solid fa-moon" id="mode"></i>
        </div>
</header>

<div class="gen_laswite_cont" >


<?php
displayComments();
?>
        </div>
<footer>
    <i class="fa-solid fa-house"></i>
    <i class="fa-regular fa-heart"></i>
    <i class="fa-solid fa-magnifying-glass"></i>
    <i class="fa-solid fa-bell"></i>
</footer>
    </div>
    <!-- TWEET BUTTON -->
<div class="tweet">
    +
</div>
<!-- SIDE MENU -->
<div class="main_side_menu">
    <div class="sidemenu_cont">
        <div class="user_info_cont">
            <div class="side_prof_img" style="  --side_prof:url(/imgbck.jpg);"></div>
            <div class="user_info"><?php
if (!isset($_SESSION['id'])) {
    echo "Welcome Guest";
} else {echo $_SESSION['username'];}
?>
</div>
            <div class="likes_no">
        <?php getLike();?>
        </div>
        </div>
        <div class="menu">
            <?php profilelnk();
?>
            <a href="" class="advert">Advertize product</a>
            <a href="">Settings & Privacy</a>
            <a href="">Help Center</a>
        </div>
        <div class="others">
            <?php btn()?>
        </div>
    </div>
</div>
<!-- REPLIES DIV BOX -->
<?php
showReplies();
showNestedReplies();
?>

<!-- LARGE SCREEN DEVICES........ -->
<div class="desk_main_cont">
    <!-- THE SIDE MENU -->
    <div class="side_menu_cont">
        <!-- SIDE MENU HEADER -->
        <div class="desk_side_header_cont">
            <div class="desk_main_prof" style="--desk_main_prof:url(/imgbck.jpg);"></div>
            <div class="desk_user">THE USERNAME HERE</div>
            <div class="desk_likes">Total Likes:
                <span>60</span></div>
        </div>
        <!-- SIDE MENU MENUS -->
        <div class="desk_menu">
        <a href="">Profile</a>
            <a href="" class="advert">Advertize product</a>
            <a href="">Settings & Privacy</a>
            <a href="">Help Center</a>
        </div>
        <!-- LOGOUT/LOGIN -->
        <div class="desk_button">
         <?php Mobilebtn();?>
        </div>
    </div>
    <!-- THE TWEETS BODY -->
    <div class="desk_main_body_cont">
        <!-- THE HEADER FOR DESKTOP BODY -->
        <div class="desk_body_head_cont">
            <div class="desk_title">
                <b >LASWUIT</b>
                <i class="fa-solid fa-moon"></i>
            </div>
            <!-- MENU ICONS OPTION -->
            <div class="desk_icons">
            <i class="fa-solid fa-house"></i>
            <i class="fa-regular fa-heart"></i>
            <i class="fa-solid fa-magnifying-glass"></i>
            <i class="fa-solid fa-bell"></i>
            </div>
        </div>
        <!-- THE MAIN TWEET CONTAINER FOR THE CONTAINERS FOR TWEETS...... -->
        <div class="desk_body_cont">
            <!-- CONTAINERS FOR THE DESKTOP TWEETS AND PROFILE PICS-->
            <div class="desk_lasweet_cont">
                <!-- PROFILE IMG CONT -->
                <div class="desk_prof_cont">
                    <div class="desk_prof" style="--desk_lasweet_prof:url(/upload/profile14.jpg);"></div>
                </div>
                <!-- THE USERNAME TEXT AND REACTIONS -->
                <div class="desk_lasweet">
                    <div class="desk_lasweet_info">
                    <b>THE USERNAME IN BOLD TEXT</b><span>.10hrs</span>
                    </div>
                    <div class="desk_text">   This is the first laswuit in existence and ill make sure theres a lot more</div>
                    <div class="desk_text_img">
                        <img alt="" src="/upload/enemy0.jfif">
                    </div>
                    <div class="desk_reactions">
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-comment"></i>
                    <i class="fa-regular fa-thumbs-down"></i>
                    </div>
                </div>
            </div>
            <div class="desk_lasweet_cont">
                <!-- PROFILE IMG CONT -->
                <div class="desk_prof_cont">
                    <div class="desk_prof" style="--desk_lasweet_prof:url(/upload/profile14.jpg);"></div>
                </div>
                <!-- THE USERNAME TEXT AND REACTIONS -->
                <div class="desk_lasweet">
                    <div class="desk_lasweet_info">
                    <b>THE USERNAME IN BOLD TEXT</b><span>.10hrs</span>
                    </div>
                    <div class="desk_text">This is the first laswuit in existence and ill make sure theres a lot more This is the first laswuit in existence and ill make sure theres a lot more This is the first laswuit in existence and ill make sure theres a lot more</div>
                    <div class="desk_text_img">
                        <img alt="" src="">
                    </div>
                    <div class="desk_reactions">
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-comment"></i>
                    <i class="fa-regular fa-thumbs-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/projects/lasu_project/js/lasuite.js"></script>
</html>
