<?php
require_once "../php/Dbcon.php";
$sql = "select time from history";
$con = new Dbcon();
$con->setSql($sql);
$res = $con->getRes();

$arr = array();
$arr['code'] = 0;
$arr['msg'] = "";
$arr['data'] = array();
$arr['count'] = $res->num_rows;

if($res->num_rows > 0){
    while ($row = $res->fetch_assoc()){
        array_push($arr['data'], $row['time']);
    }
}
else{
    $arr['sql'] = $sql;
}
echo json_encode($arr);