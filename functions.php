<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $x = new PDO("mysql:host=$servername;dbname=chat", $username, $password);

  $x->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}




?>