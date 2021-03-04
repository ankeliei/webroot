<?php

require_once "../php/Dbcon.php";
$con = new Dbcon();

$id = $_REQUEST['id'];
$sql = "select count(*) as count from users";

$con->setSql($sql);
$res = $con->getRes();
$row = $res->fetch_assoc();

echo $row['count'];