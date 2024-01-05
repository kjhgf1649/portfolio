<?php
  error_reporting (E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  session_start();
  $userid =  $_GET['userid']??'';
  $expense_id = $_GET['id'];
  echo $userid;
  echo $expense_id;
  header("Content-Type: text/html; charset=utf-8");
// $expense_id = id값 받아오기

//Create connection
  $conn = mysqli_connect("localhost", "root", "091405", "think", 3306);

// Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// db연결
//$db_conn = mysqli_select_db($conn, $mysql_dbname);
mysqli_set_charset($conn, 'utf8'); 

// 쿼리문
$deleteQuery = "DELETE FROM expenses WHERE expenses_id='$expense_id'";

$expense_result = mysqli_query($conn, $deleteQuery) or die(mysqli_error($conn));
if($expense_result)
{
    session_start();
    $_SESSION['userId'] =$userid;
    print_r($_SESSION);
    echo $_SESSION['userId'];
    
?>
    <script>
        alert("삭제가 되었습니다.")
        location.href = "daily.php";
    </script>
<?php
}
?>