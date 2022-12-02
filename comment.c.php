<?php

if (!isset($_POST['submit'])) {
    header("location:index.php");
} else {
    session_start();
    //if user hasn't signed up
    if (!isset($_SESSION['id'])) {
        header("location:signlasuite.php");
    } else {
        //if has signed up
        include_once "autoload.php";
        $comment = $_POST['comment'];
        $username = $_SESSION['username'];
        $files = $_FILES['img'];
        $filename = $files['name'];
        $filetemp_path = $files['tmp_name'];
        $filetype = $files['type'];
        $file_error = $files['error'];
        $filesize = $files['size'];
        $userId = $_SESSION['id'];
        $object = new commentcontrol($userId, $comment, $file_error, $filesize, $filetype, $filetemp_path, $username);
        $object->iComment();
    }

}
