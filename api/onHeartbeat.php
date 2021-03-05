<?php
$sessionid = $_COOKIE['JSESSIONID'];
session_id($sessionid);
session_start();    //恢复session
$openid = $_SESSION['openid'];
$ip = $_SESSION['ip'];

require_once "../php/Dbcon.php";
$con = new Dbcon();

$sql = "update users set minutes = minutes+1 where (openid = ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $openid);
$stmt->execute();

echo 0;