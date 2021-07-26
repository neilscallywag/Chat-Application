<?php
$servername = "localhost";
$username   = "root";
$password   = "";
try
  {
    $x = new PDO("mysql:host=$servername;dbname=chat", $username, $password);
    $x->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
catch (PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
  }
function generatetoken()
  {
    if (!isset($_SESSION["token"]))
      {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $token             = $_SESSION["token"];
      }
    else
      {
        $token = $_SESSION["token"];
      }
    return $token;
  }
function sendmessage($uid, $username, $message, $token, $x)
  {
    if (isset($message))
      {
        if (isset($token))
          {
            $sql  = "INSERT INTO chat (uid, username, message, timestamp) VALUES (:uid, :username, :message, :time)";
            $stmt = $x->prepare($sql);
            $stmt->bindValue(':uid', $uid);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':message', $message);
            $stmt->bindValue(':time', date('Y-m-d H:i:s'));
            $stmt->execute();
          }
      }
  }
function getmessages($x)
  {
    $sql  = "select * from chat ORDER BY mid ASC;";
    $stmt = $x->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchall();
    return $result;
  }
function latestmessage()
  {
  }
?>