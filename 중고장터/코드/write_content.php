<?php
ob_start();
require_once("dbconfig.php"); 

$prevPage = $_SERVER['HTTP_REFERER'];// 이전 페이지

//컨텐츠 데이터들
$title = $_POST["title"];
$category = $_POST["category"];
$content = $_POST["content_text"];
$file_name = $_FILES["content_image"]['name'];
$filepath = "./Image/".$file_name;

//파일 임시저장 될 경로
$temp_file = $_FILES['content_image']['tmp_name'];

echo "제목 : ".$title, "카테고리 :".$category, "컨텐츠 : ".$content, "파일 이름 : ".$file_name, "파일 패스 : ".$filepath;

if(!move_uploaded_file($temp_file, $filepath)){
    echo '파일의 업로드에 문제가 있습니다';
}

$sql = "INSERT INTO contents(content_title,content_text,category,imagepath,imagename,writed_date)
    VALUES('$title','$content','$category','$filepath','$file_name',NOW());";

$res = $db->query($sql); 

if(!$res){
    print_r ("쿼리 오류!".mysqli_error($db));
    header('location:'.$prevPage);
}
else {
    mysqli_close($db);

    header("Location: index.html");
    exit();
}
ob_end_flush();
 //print_r($row);

// $sql = "INSERT INTO `forum` (`id`, `title`,`category`,`content`) 
// VALUES ('$idInput','$titleInput','$categoryInput','$contentInput')";
// s
// $res = $db->query($sql); 
// $forumid = $res->insert_id;

// print_r($row);

// if ($forumid === null) { 
//     echo false;
// } else {   
//     echo true;
// }