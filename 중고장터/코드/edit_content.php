<?php
ob_start();
require_once("dbconfig.php"); 


$contentidInput= $_POST["idresive"];
$title = $_POST["title"];
$category = $_POST["category"];
$content = $_POST["content_text"];
$file_name = $_FILES["content_image"]['name'];
$filepath = "./Image/".$file_name;
$temp_file = $_FILES['content_image']['tmp_name'];

//print_r($title);
if(!move_uploaded_file($temp_file,$filepath)){
    echo '파일의 업로드에 문제가 있습니다';
}


$sql = "UPDATE contents SET content_title='$title',content_text='$content', category='$category',imagepath='$filepath',imagename='$file_name',writed_date=NOW() WHERE content_id= $contentidInput";

$res = $db->query($sql); 

//print_r($row);

if ($res === null) { 
    print_r ("쿼리 오류!".mysqli_error($res));
    header('location:'.$prevPage);
} else {   
    mysqli_close($db);
    header("Location: index.html");
    exit();
}

ob_end_flush();