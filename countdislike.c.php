<?php
session_start();
if (!isset($_GET['id'])) {
    header("location:index.php");
} else {
    if (!isset($_SESSION['id'])) {
        header("location:signlasuite.php");
    } else {
        include_once 'autoload.php';
        $id = $_GET['id'];
        $username = $_SESSION['username'];
        $object = new adddislikecontrol($id, $username);
        $object->setDislikes();
    }
}
