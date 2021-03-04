<?php
    require_once "../php/Dbcon.php";
    $con = new Dbcon();

    $kind = $_REQUEST['kind'];

    $sql = "select * from news where (kind = ?)";
    $newsList = array();

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kind);
    $stmt->execute();
    $res = $stmt->get_result();

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
    else echo "NoNews";