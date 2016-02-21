<?php
include_once "lib.php";
?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <form action="adminPage.php" method="post">
    <p>Add deprecated word: </p>
    <input type="text" name="word">
    <input type="submit" name="add" value="add">
</form>
</body>
<?php

$depWord = getDeprecatedWords();
$depWord = addDeprecatedWords($depWord);
showDeprecatedWord($depWord);

?>

</html>