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

function generatekey() 
{
	
	return 	base64_encode(openssl_random_pseudo_bytes(64));
	
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

function sendpmessage($f, $t, $message, $token, $x)
{
    if (isset($message)) {
        if (isset($token) && $token == $_SESSION["token"]) {
	        $item = 'k';
            $fk = uidToname($f, $item, $x);
			$tk = uidToname($t, $item, $x);
			$e = secured_encrypt($message,$fk,$tk);
				
            $sql  = "INSERT INTO privatemsg (f, t, message, timestamp) VALUES (:f, :t, :message,  :time)";
            $stmt = $x->prepare($sql);
            $stmt->bindValue(':f', $f);
            $stmt->bindValue(':t', $t);
            $stmt->bindValue(':message', $e);
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

function checkifexist($uid,$x) {
	
	  $sql = "SELECT COUNT(uid) AS num FROM users WHERE uid = :uid";
            $stmt = $x->prepare($sql);
            $stmt->bindValue(':uid', $uid);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['num'];
	
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
function uidToname($uid,$item, $x)
{
    $sql  = "SELECT ".$item." AS num from users WHERE uid = :uid";
    $stmt = $x->prepare($sql);
    $stmt->bindValue(':uid', $uid);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['num'];
}

function secured_encrypt($data,$k1,$k2)
{
$first_key = base64_decode($k1);
$second_key = base64_decode($k2);   
   
$method = "aes-256-cbc";   
$iv_length = openssl_cipher_iv_length($method);
$iv = openssl_random_pseudo_bytes($iv_length);
       
$first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
$second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
           
$output = base64_encode($iv.$second_encrypted.$first_encrypted);   
return $output;       
}


function secured_decrypt($input,$k1,$k2)
{
$first_key = base64_decode($k1);
$second_key = base64_decode($k2);           
$mix = base64_decode($input);
       
$method = "aes-256-cbc";   
$iv_length = openssl_cipher_iv_length($method);
           
$iv = substr($mix,0,$iv_length);
$second_encrypted = substr($mix,$iv_length,64);
$first_encrypted = substr($mix,$iv_length+64);
           
$data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
   
if (hash_equals($second_encrypted,$second_encrypted_new))
return $data;
   
return false;
}



?>