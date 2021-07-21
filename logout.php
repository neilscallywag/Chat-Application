
<?php
session_start();
unset($_SESSION["uid"]);
header("Location:login.php");
?>

