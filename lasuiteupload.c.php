<?php
session_start();
if (!isset($_POST['submit'])) {
    header("location:index.php");
} else if (!isset($_SESSION['id'])) {

    header("location:signlasuite.php");
} else {
    include_once 'autoload.php';
    $username = $_SESSION['username'];
    $files = $_FILES['img'];
    $filename = $files['name'];
    $filetemp_path = $files['tmp_name'];
    $filetype = $files['type'];
    $file_error = $files['error'];
    $filesize = $files['size'];
    $id = $_SESSION['id'];
    $object = new profupldcontrol($id, $username, $file_error, $filesize, $filetype, $filetemp_path);
    $object->moveFile();
}
