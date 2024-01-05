<?php
error_reporting (E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);

$conn = mysqli_connect("localhost", "root", "091405", "think", 3306);
//아이디 비교와 비밀번호 비교가 필요한 시점이다.
// 1차로 DB에서 비밀번호를 가져온다 
// 평문의 비밀번호와 암호화된 비밀번호를 비교해서 검증한다.
$userid = $_POST['userid']??'';
$pw = $_POST['pw']??'';

// DB 정보 가져오기 
$sql = "SELECT * FROM user WHERE `user_id` ='$userid'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;

$row = mysqli_fetch_array($result) or die(mysqli_error($conn));
$hashedPassword = $row['pw'];
$row['user_id'];
/*
foreach((array)$row as $key => $r){
    echo "{$key} : {$r} <br>";
}*/
// echo $row['id'];
// DB 정보를 가져왔으니 
// 비밀번호 검증 로직을 실행하면 된다.
$passwordResult = password_verify($pw, $hashedPassword);

if ($passwordResult === true) {
    // 로그인 성공
    // 세션에 id 저장
    
    session_start();
    $_SESSION['userId'] =$row['user_id'];;
    print_r($_SESSION);
    echo $_SESSION['userId'];
    
?>
    <script>
        
        alert("로그인에 성공하였습니다.")
        location.href = "daily.php";
/*
        <a href="expenditureInput.htm?userid=<? echo $_SESSION['userId'] ?>"> 전송 </a>
        alert("로그인에 성공하였습니다.")
        location.href = "expenditureInput.htm?";
*/
    </script>
<?php
} else {
    // 로그인 실패 
?>
    <script>
        alert("로그인에 실패하였습니다");
        location.href = "login.php";
    </script>
<?php
}
?>

