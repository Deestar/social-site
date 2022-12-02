<?php
if (!isset($_GET['id'])) {
    header("location:signlasuite.php");
} else {
    session_start();
    if (!isset($_SESSION['id'])) {
        header("location:signlasuite.php");
    } else {
        //if has signed up
        include_once "autoload.php";
        $reply = $_POST['comment'];
        $username = $_SESSION['username'];
        $files = $_FILES['img'];
        $filename = $files['name'];
        $filetemp_path = $files['tmp_name'];
        $filetype = $files['type'];
        $file_error = $files['error'];
        $filesize = $files['size'];
        $userid = $_SESSION['id'];
        $id = $_GET['id'];
        $object = new replycontrol($userid, $id, $username, $reply, $file_error, $filesize, $filetype, $filetemp_path);
        $object->main();
    }
}
