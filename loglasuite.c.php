<?php
if (!isset($_POST['submit'])) {
    header("location:signlasuite.php?error=access");
} else {
    include_once 'autoload.php';
    $usermail = $_POST['username'];
    $password = $password = $_POST['p_word'];
    $object = new loglasuitecontrol($usermail, $password);
    $object->main();
}
