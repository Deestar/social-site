<?php
if (!isset($_POST['submit'])) {
    header('location:signlasuite.php');
} else {
    include_once 'autoload.php';
    $validate = $_POST['validate'];
    $user = $_POST['user'];
    $object = new validmailcontrol($validate, $user);
    $object->finalSign();
}
