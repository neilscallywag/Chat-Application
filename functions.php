<?php
$servername = "localhost";
$username   = "root";
$password   = "";
try {
    $x = new PDO("mysql:host=$servername;dbname=chat", $username, $password);
    $x->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
function generatetoken()
{
    if (!isset($_SESSION["token"])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $token             = $_SESSION["token"];
    } else {
        $token = $_SESSION["token"];
    }
    return $token;
}
function sendmessage($uid, $username, $message, $token, $fi, $n, $x)
{
    if (isset($message) OR isset($fi)) {
        if (isset($token) && $token == $_SESSION["token"]) {
	

            $sql  = "INSERT INTO chat (uid, username, message, file, file_name, timestamp) VALUES (:uid, :username, :message, :fi, :fn, :time)";
            $stmt = $x->prepare($sql);
            $stmt->bindValue(':uid', $uid);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':message', $message);
			$stmt->bindValue(':fi', $fi);
			$stmt->bindValue(':fn', $n);
            $stmt->bindValue(':time', date('Y-m-d H:i:s'));
            $stmt->execute();
        }
    }
}
function getmessages($x)
{
    $sql  = "SELECT * from chat ORDER BY mid ASC;";
    $stmt = $x->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchall();
    return $result;
}
function latestmessage()
{
}
function getprivatemsg($s, $r, $x)
{
    $sql  = "SELECT * from privatemsg WHERE (f = :f AND t = :t) OR (f = :t AND t = :f) ORDER BY id;";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':f', $s);
    $stmt->bindValue(':t', $r);
    $stmt->execute();
    $result = $stmt->fetchall();
    return $result;
}
function redirect($location)
{
    header('Location: ' . $location . '');
    die();
}
function uidToname($uid, $x)
{
    $sql  = "SELECT username from users WHERE uid = :uid";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':uid', $uid);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['username'];
}
?>