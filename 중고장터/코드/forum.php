<?php
ob_start();
$contentidInput= $_GET["contentid"];

require_once("dbconfig.php"); // 항상 맨 앞줄에 추가

$sql = "SELECT * FROM contents WHERE content_id = '$contentidInput'";

// 최종결과
$data = array();

// 실행결과는 $res에 저장
$res = $db->query($sql);
$row = $res->fetch_assoc();

echo json_encode($row, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);

mysqli_close($db);

?> 