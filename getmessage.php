<?php
session_start();
include ("functions.php");

header('Content-Type: application/json');

$sql  = "select * from chat ORDER BY mid ASC;";
$stmt = $x->prepare($sql);

$stmt->execute();

$result = $stmt->fetchall(PDO::FETCH_ASSOC);
if (isset($_SESSION["uid"])) {
    foreach ($result as $key    => $value) {
        $result[$key]['sessionid']        = $_SESSION["uid"];
    }
}
else {
    foreach ($result as $key    => $value) {
        $result[$key]['sessionid']        = null;
    }
}
echo json_encode($result, JSON_PRETTY_PRINT);

?>
