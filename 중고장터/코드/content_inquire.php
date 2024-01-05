<?php
    require_once("dbconfig.php");
    
    $sql = "SELECT * FROM contents ORDER BY content_id DESC";
    $data = array();
    $res = $db->query($sql);

    //db에서 데이터들 들고 와서 $data 변수에 집어 넣기. $res 객체의 길이만큼
    for($i = 0;$i<$res->num_rows;$i++){
        $content_row = $res->fetch_array(MYSQLI_ASSOC);
        array_push($data,$content_row);
    }

    //data가 null이 아니라면 json형태로 출력
    if($data != null){
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
    }else{

        //db내에 값이 없으면 false 출력
        echo false;
    }

    //db 닫기
    mysqli_close($db);

?>