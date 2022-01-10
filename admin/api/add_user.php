<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
require('../../connect_db.php');

// $user = $_POST['user'];
// $fullname = $_POST['fullname'];
// $phongban = $_POST['phongban'];
// $level = $_POST['level'];

$json = file_get_contents('php://input');
$data = json_decode($json);
$user = $data->user;
$fullname = $data->fullname;
$phongban = $data->phongban;
$birthday = $data->birthday;
$gender = $data->gender;

$result = register($user, $user, $fullname, $phongban, $birthday, $gender);
echo json_encode($result);
?>