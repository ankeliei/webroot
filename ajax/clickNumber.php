<?php

require_once "../php/Dbcon.php";
$sql = "select time from clickHistory";
$con = new Dbcon();
$con->setSql($sql);
$res = $con->getRes();

$n = 0;
$arr = array();
$arr['code'] = 0;
$arr['msg'] = "";
$arr['data'] = array();

$t = array();

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        array_push($t, $row['time']);
    }
} else {
    $arr['sql'] = $sql;
}

$arr['t'] = $t;

$days = 0;
$number = 0;
$firstDay = date_create($t[0]);
date_time_set($firstDay,0,0,0);
for($i = 0; $i<$res->num_rows; $i++){

    if(date_timestamp_get(date_create($t[$i])) < date_timestamp_get($firstDay)+3600*24 ){
        $number++;
        if($i == $res->num_rows-1){
            array_push($arr['data']
                ,array(date_timestamp_get($firstDay),$number
                ));
        }
    }
    else{
        array_push($arr['data'],array(date_timestamp_get($firstDay),$number));
        date_add($firstDay,date_interval_create_from_date_string("1 day"));
        $number = 0;
        $days++;
        $i--;
    }
}
$arr['count'] = $days+1;

echo json_encode($arr);