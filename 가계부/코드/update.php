<?php
error_reporting (E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  session_start();
  $userid =  $_GET['userid']??'';
  $expense_id = $_GET['id'];
  echo $userid;
  echo $expense_id;

// mysql 접속 계정 정보 설정
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pw = '091405';
$mysql_dbname = 'think';

// 입력받은 내용 화면에 출력 (테스트용)
header("Content-Type: text/html; charset=utf-8");
$userid = $_POST['userid']??'';
$date = $_POST['date']??'';
$time = $_POST['time']??'';
$date_time = (string)$date ." " .(string)$time;
$category_value = $_POST['category']??'';
//echo $category_value;
switch($category_value){
    case 1: {
        $division_id = 1;
        $division_name = '식비'; 
        global $division_id, $division_name;
        break;
        }
    case 2: {
        $division_id = 2;
        $division_name = '생활용품'; 
        global $division_id, $division_name;
        break;}   
    case 3: {
        $division_id = 3;
        $division_name = '교통비'; 
        global $division_id, $division_name;
        break;}
    case 4: {
        $division_id = 4;
        $division_name = '의류'; 
        global $division_id, $division_name;
        break;}
    case 5: {
        $division_id = 5;
        $division_name = '저축'; 
        global $division_id, $division_name;
        break;}
}
$price = $_POST['price']??'';
$content = $_POST['content']??'';
$method_value = $_POST['method']??'';

//Create connection
$conn =  mysqli_connect("localhost", "root", "091405", "think", 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// db연결
//$db_conn = mysqli_select_db($conn, $mysql_dbname);
mysqli_set_charset($conn, 'utf8'); 

// 쿼리문
$updateQuery = "UPDATE expenses SET division_id='$division_id', method='$method_value', prices='$price', contents = '$content', date_time = '$date_time' WHERE expenses_id = '$expense_id'";
//echo $insertQuery;
//$insertDvisionQuery = "insert into division (division_id, division_name)"." values('$division_id', '$division_name')";
$expense_result = mysqli_query($conn, $updateQuery) or die(mysqli_error($conn));
//$division_result = mysqli_query($conn, $updateQuery);


if($expense_result)
{
    session_start();
    $_SESSION['userId'] = $userid;
    print_r($_SESSION);
    echo $_SESSION['userId'];
    
?>
    <script>
        alert("업데이트 되었습니다.");
        location.href = "daily.php";
    </script>
<?php

}


?>