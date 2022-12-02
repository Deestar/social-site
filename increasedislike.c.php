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
        $object = new incrdislikecontrol($id, $username);

        try {
            $object->setDislike();
        } catch (PDOException $th) {
            echo "<h1 >AN ERROR HAS OCCURED KINDLY REFRESH YOUR PAGE!! IF THIS ERROR PERSIST PLEASE CONTACT SUPPORT</h1>";
        }
    }
}
