<?php
require_once "../php/Dbcon.php";
$con = new Dbcon();

$sql = "select * from news";
$con->setSql($sql);

$res = $con->getRes();

$newsList = array();

if($res->num_rows > 0){
    while ($row = $res->fetch_assoc()){
        array_push($newsList,array(
            'id' => $row['id'],
            'title' => $row['title'],
            'titlePicture' => $row['titlePicture'],
            'kind' => $row['kind'],
            'author' => $row['author'],
            'time' => $row['time'],
            'readCount' => $row['readCount'],
            'likeCount' => $row['likeCount'],
            'starCount' => $row['starCount']));
    }
    echo json_encode($newsList);
}
else echo 1;