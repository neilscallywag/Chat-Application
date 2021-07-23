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


	function generatetoken() {
		if(!isset($_SESSION["token"])){
	$_SESSION['token'] = bin2hex(random_bytes(32));
	$token = $_SESSION["token"];
		}
		else {
        // Reuse the token
        $token = $_SESSION["token"];
    }
    return $token;
		
	}



?>