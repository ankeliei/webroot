<?php

require_once "../php/Dbcon.php";
$sql = "select times, totalTime from history";
$con = new Dbcon();
$con->setSql($sql);
$res = $con->getRes();

$n = 0;
$arr = array();
$arr['code'] = 0;
$arr['msg'] = "";
$arr['data'] = array();

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if($row['totalTime'] != 0) {
            array_push($arr['data'], array(
                $row['times'],
                $row['totalTime']
            ));
            $n = $n + 1;
        }
    }
    $arr['count'] = $n;
} else {
    $arr['sql'] = $sql;
}
echo json_encode($arr);