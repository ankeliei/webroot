<?php
require_once "../php/Dbcon.php";
$con = new Dbcon();

$sql = "select * from headPictures";
$con->setSql($sql);

$res = $con->getRes();

$picturesList = array();

if($res->num_rows > 0){
    while ($row = $res->fetch_assoc()){
        array_push($picturesList, array(
            'id' => $row['id'],
            'url' =>  $row['url'],
            'link' => $row['link']
        ));
    }
    echo json_encode($picturesList);
}
else echo 1;