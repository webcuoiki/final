<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
require_once '../../connect_db.php';

$json = file_get_contents('php://input');
$data = json_decode($json);
$name = $data->name;

$result = get_users_of_department($name);
die(json_encode($result));
?>