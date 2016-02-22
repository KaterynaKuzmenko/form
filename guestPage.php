<?php
error_reporting(E_ALL);
define('ROOT',dirname(__FILE__));
define('DS',DIRECTORY_SEPARATOR);
include_once "lib.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="parent">
    <div class="form">
        <form action="guestPage.php" method="post">
            <p>Enter your name:</p>
            <input name="userName" type="text">
            <p>Leave your comment:</p>
            <textarea name="userMessage" cols="30" rows="6"></textarea>
            <br>
            <input type="submit" name="submit" value="submit">
          </form>
    </div>
    <hr>
    <?php
    $messages = getContent();
    $messages = addComment($messages);
    $message = antiMat($messages);
    showContent($message);
    ?>

</div>

</body>

</html>