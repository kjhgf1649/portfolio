<?php
require_once("dbconfig.php"); 

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$pwInput = password_hash($_POST['pwInput'], PASSWORD_DEFAULT);

$idInput = $_POST["idInput"];
$nameInput = $_POST["nameInput"];
$nicknameInput = $_POST["nicknameInput"];
$phInput = $_POST["phInput"];
$addressInput = $_POST["addressInput"];
//print_r($idInput);
$sql = "SELECT * FROM `user` WHERE id = '$idInput'";

$res = $db->query($sql); 

$row = $res->fetch_array(MYSQLI_ASSOC); 

//print_r($row);

if ($row === null) { 
    $sql = "INSERT INTO `user` (`id`, `pw`,`name`,`nickname`,`phone_number`,`address`) 
        VALUES ('$idInput','$pwInput','$nameInput','$nicknameInput ','$phInput','$addressInput')";
    $db->query($sql); // SQL 실행
    echo true;
} else {   
    echo false;
}

mysqli_close($db);
