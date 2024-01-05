<?php

$conn = mysqli_connect("localhost", "root", "091405", "think", 3306);
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
//echo $hashedPassword;
$sql = "
    INSERT INTO user
    (user_id, pw)
    VALUES('{$_POST['email']}', '{$hashedPassword}'
    )";
$result = mysqli_query($conn, $sql);
//echo $sql;
if ($result === false) {
?>
    <script>
        alert("아이디가 중복되었습니다");
        location.href = "signup.php";
    </script>
<?php
} else {
?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "login.php";
    </script>
<?php
}
?>