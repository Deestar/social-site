<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
} else if (!isset($_GET['id'])) {
    $username = $_SESSION['username'];
    header("location:lasuiteprofile.php?uname=$username");
} else {
    include_once 'autoload.php';
    $id = $_GET['id'];
    $username = $_SESSION['username'];
    $object = new deleterpycontrol($id, $username);
    $object->deleteRpy();
}
