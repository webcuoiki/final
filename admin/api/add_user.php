<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
require('../../connect_db.php');

$json = file_get_contents('php://input');
$data = json_decode($json);
$user = $data->user;
$fullname = $data->fullname;
$phongban = intval($data->phongban);
$birthday = $data->birthday;
$gender = $data->gender;
$email = $data->email;
$phone = $data->phone;
$address = $data->address;

$result = register($user, $user, $fullname, $phongban, $birthday, $gender, $email, $phone, $address);
echo json_encode($result);
?>