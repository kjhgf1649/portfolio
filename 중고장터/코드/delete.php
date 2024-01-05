<?php
ob_start();
$contentidInput= $_GET["contentid"];

require_once("dbconfig.php"); // 항상 맨 앞줄에 추가

$sql = "DELETE FROM contents WHERE content_id = '$contentidInput'";

// 최종결과
$data = array();

// 실행결과는 $res에 저장
$res = $db->query($sql);
if(!$res){
    echo null;
}
else echo true;
// fetch_array는 한번 실행될때마다 한 행씩 뱉어내므로
// 원하는 걸 모두 얻으려면 반복문 사용해야함.

mysqli_close($db);

?> 