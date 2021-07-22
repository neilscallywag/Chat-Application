
<?php
session_start();
unset($_SESSION["uid"]);
clearstatcache();	
header("Location:login.php");
?>

