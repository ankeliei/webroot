<?php
$sessionid = $_COOKIE['JSESSIONID'];
session_id($sessionid);
session_start();    //恢复session

$openid = $_SESSION['openid'];

$ip = $_SESSION['ip'];

$seconds = $_GET['seconds'];

require_once "php/Dbcon.php";
$con = new Dbcon();

$sql = "update history set totalTime = totalTime + ".$seconds." where openid = '".$openid."' and ip = '".$ip."'";

$con->setSql($sql);
$res = $con->getRes();
echo $sql;

echo $res;