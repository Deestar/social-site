<?php
if (!isset($_POST['submit'])) {
    header("location:signlasuite.php?error=access");
} else {
    include "autoload.php";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['p_word'];
    $object = new lasweetcontrol($username, $email, $password);
    $object->main();
}
