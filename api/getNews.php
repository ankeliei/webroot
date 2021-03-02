<?php
    require_once "../php/Dbcon.php";
    $con = new Dbcon();

    $id = $_REQUEST['id'];
    $sql = "select * from news where (id = ?)";

    $news = array();

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows == 1){
        while ($row = $res->fetch_assoc()){
            $news['id'] = $row['id'];
            $news['title'] = $row['title'];
            $news['titlePicture'] = $row['titlePicture'];
            $news['kind'] = $row['kind'];
            $news['author'] = $row['author'];
            $news['time'] = $row['time'];
            $news['commentCount'] = $row['commentCount'];
            $news['readCount'] = $row['readCount'];
            $news['likeCount'] = $row['likeCount'];
            $news['starCount'] = $row['starCount'];
            $news['next'] = $row['next'];
            $news['previous'] = $row['previous'];
            $news['recommed'] = $row['recommend'];
            $news['nodes'] = explode(",", $row['nodes']);
        }
    }
    else return 1;

    $sql = "select * from nodes where (id = ?)";
    for($i=0; $i<count($news['nodes']); $i++){
        $stmt = $con->prepare($sql);
        $int = intval($news['nodes'][$i]);
        $stmt->bind_param("i", $int);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 1){
            while ($row = $res->fetch_assoc()){
                $news['nodes'][$i] = array(
                    'id' => $row['id'],
                    'kind' => $row['kind'],
                    'text' => $row['text'],
                );
            }
        }
    }

    echo json_encode($news);