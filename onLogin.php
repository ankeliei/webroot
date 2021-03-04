<?php
session_start();

require_once 'php/Openid.php';

//拿到用户的openid
$openid = new Openid($_GET['code']);
$openid = $openid->getOpenid();
$_SESSION['openid'] = $openid;

$ip = $_SERVER["REMOTE_ADDR"];
$_SESSION['ip'] = $ip;
$r = array();

// 处理ip
//$key = "JHJBZ-7UUED-ILG4U-PU66C-QEOS6-AKB4Y";
//$url = "https://apis.map.qq.com/ws/location/v1/ip?ip=".$ip."&key=".$key;
//$result = file_get_contents($url);
//$arrResult = json_decode($result,true);

require_once "php/Dbcon.php";
$con = new Dbcon();

$sql = "select count(*) as count from users where (openid = ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $openid);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if($row['count'] == 0){
    $sql = "insert into users (openid, history) value (\"".$openid. "\","."0". ")";
    $con->setSql($sql);
    if($con->affected_rows() == 1){
        $r['newOrOld'] = "new";
    }
}
else{
    $r['newOrOld'] = "old";
}
$r['sessionid'] = session_id();
$r['openid'] = $openid;

//echo json_encode($r);
echo session_id();

//$sql = "INSERT INTO clickHistory (id, openid, time, ip, province, city, lat, lng) VALUES ".
//    "(NULL, \"".$openid."\", CURRENT_TIMESTAMP, \"".$ip."\", \"".
//    $arrResult['result']['ad_info']['province']."\", \"".
//    $arrResult['result']['ad_info']['city']."\", \"".
//    $arrResult['result']['location']['lat']."\", \"".
//    $arrResult['result']['location']['lng']."\")";
//$con->setSql($sql);
//$res = $con->getRes();
//
//$sql = "select openid, ip, times from history where openid = '".$openid."' and ip = '".$ip."'";
//$con->setSql($sql);
//$res = $con->getRes();
//
//
//if($res->num_rows == 1){
//    $times = 0;
//    while( $row = $res->fetch_assoc() ){
//        $times = $row['times'];
//    }
//    $times = $times+1;
//    $sql = "update history set times = ".$times." where openid = '".$openid."' and ip = '".$ip."'";
//    $con->setSql($sql);
//    $ress = $con->getRes();
//}
//
//else if($res->num_rows == 0){
//
//    $sql = " INSERT INTO history (historyid, openid, ip, times, province, city, lat, lng) VALUES ".
//    "(NULL, \"".$openid."\", \"".$ip."\", 1, \"".
//        $arrResult['result']['ad_info']['province']."\", \"".
//        $arrResult['result']['ad_info']['city']."\", \"".
//        $arrResult['result']['location']['lat']."\", \"".
//        $arrResult['result']['location']['lng']."\")";
//
//    $con->setSql($sql);
//    $ress = $con->getRes();
//}
