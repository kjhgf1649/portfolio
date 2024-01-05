<?php
require_once("dbconfig.php"); 

$_POST = JSON_DECODE(file_get_contents("php://input"), true);

$idInput = $_POST["id"];
$pwInput = $_POST["pwInput"];

$sql = "SELECT * FROM `user` WHERE id = '$idInput'";

$res = $db->query($sql); 
$row = $res->fetch_array(MYSQLI_ASSOC); 
$hashedPassword = $row['pw'];

$passwordResult = password_verify($pwInput, $hashedPassword);
//print_r($row);

if ($passwordResult) { 
    echo true;
} else {   
    echo false;
}
mysqli_close($db);