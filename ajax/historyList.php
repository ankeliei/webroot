<?php
require_once "../php/Dbcon.php";
$sql = "select * from history";
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
        array_push($arr['data'], array(
            'historyid'=>$row['historyid'],
            'openid'=>$row['openid'],
            'ip'=>$row['ip'],
            'times'=>$row['times'],
            'time'=>$row['time'],
            'totalTime'=>$row['totalTime'],
            'province'=>$row['province'],
            'city'=>$row['city']
        ));
    }
}
else{
    $arr['sql'] = $sql;
}
echo json_encode($arr);
