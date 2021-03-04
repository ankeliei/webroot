<?php
    require_once "../php/Dbcon.php";
    $con = new Dbcon();

    $sql = "SELECT kind as kind,COUNT(*) as count FROM news GROUP BY kind ORDER BY count DESC";
    $newsCount = array();

    $con->setSql($sql);
    $res = $con->getRes();

    if($res->num_rows > 0){
        while ($row = $res->fetch_assoc()){
            array_push($newsCount, array(
                'text' => $row['kind'],
                'newsCount' => $row['count'],
                'url' => ""
            ));
        }
    }
    echo json_encode($newsCount);