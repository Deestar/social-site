<?php
if (!isset($_GET['user'])) {
    header('location:signlasuite.php?err=nanuser');
} else {
    function hideVal()
    {
        $user = $_GET['user'];
        echo '  <input type="hidden" name="user" value="' . $user . '">';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/signlasuite.css">
    <link rel="stylesheet" href="css/confirm.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validate mail</title>
</head>
<body>
<div class="welcome">
        A TOKEN HAS BEEN SENT TO YOUR MAIL PLEASE PUT IT IN TO CONFIRM YOUR EMAIL
    </div>
<div class="form_cont">
            <form method="POST" action="validate.c.php">
                    <input name="validate" type="number" placeholder="Input your validation token">
                    <?php hideVal();?>
                    <button name="submit" type="submit" >VALIDATE</button>

            </form>
        </div>
</body>
</html>
