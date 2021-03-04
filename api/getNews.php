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
            $news['recommend'] = $row['recommend'];
            $news['nodes'] = $row['nodes'];

            if($row['recommend'] != "0"){
                $news['recommend'] = explode(",", $row['recommend']);
            }
            if($row['nodes'] != "0"){
                $news['nodes'] = explode(",", $row['nodes']);
            }
        }
    }
    else return 1;

    //从数据库加载节点
    if($news['nodes'] != "0") {
        $sql = "select * from nodes where (id = ?)";
        for ($i = 0; $i < count($news['nodes']); $i++) {
            $stmt = $con->prepare($sql);
            $int = intval($news['nodes'][$i]);
            $stmt->bind_param("i", $int);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows == 1) {
                while ($row = $res->fetch_assoc()) {
                    $news['nodes'][$i] = array(
                        'id' => $row['id'],
                        'kind' => $row['kind'],
                        'text' => $row['text'],
                    );
                }
            }
        }
    }

//    从数据库加载推荐
    $sql = "select * from news where (id = ?)";
    if($news['recommend'] != "0"){
        for($i=0; $i<count($news['recommend']); $i++){
            $stmt = $con->prepare($sql);
            $int = intval($news['recommend'][$i]);
            $stmt->bind_param("i", $int);
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows == 1){
                while ($row = $res->fetch_assoc()){
                    $news['recommend'][$i] = array(
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'titlePicture' => $row['titlePicture'],
                        'readCount' => $row['readCount'],
                        'author' => $row['author']
                    );
                }
            }
        }
    }


//    从数据库加载前一篇和后一篇
    if($news['previous'] != 0){
        $stmt = $con->prepare($sql);
        $int = intval($news['previous']);
        $stmt->bind_param("i", $int);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 1){
            while ($row = $res->fetch_assoc()){
                $news['previous'] = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                );
            }
        }
    }
    if($news['next'] != 0){
        $stmt = $con->prepare($sql);
        $int = intval($news['next']);
        $stmt->bind_param("i", $int);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 1){
            while ($row = $res->fetch_assoc()){
                $news['next'] = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                );
            }
        }
    }

    echo json_encode($news);