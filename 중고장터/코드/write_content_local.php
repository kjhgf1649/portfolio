<?php

    $host = 'localhost';
    $id = 'root';
    $password = 'ZEUS0721';
    $DBname = 'project_database';
    $conn = mysqli_connect($host,$id,$password,$DBname);




    // post한 데이터 매칭
    $title = $_POST["title"];
    $category = $_POST["category"];
    $content = $_POST["content_text"];
    $file_name = $_FILES["content_image"]['name'];
    $filepath = "./Image/".$file_name;
    //파일이 임시저장 될 경로
    $temp_file = $_FILES['content_image']['tmp_name'];

    echo "제목 : ".$title, "카테고리 :".$category, "컨텐츠 : ".$content, "파일 이름 : ".$file_name, "파일 패스 : ".$filepath;

    move_uploaded_file($temp_file,$filepath);

    $sqlQuery = "INSERT INTO contents(content_title,content_text,category,imagepath,imagename,writed_date)
        VALUES('$title','$content','$category','$filepath','$file_name',NOW());";

    if(!mysqli_query($conn,$sqlQuery)){
        echo ("쿼리 오류!".mysqli_error($conn));
    }
        

?>