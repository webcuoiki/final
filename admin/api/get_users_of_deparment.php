<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
require_once '../../connect_db.php';

$json = file_get_contents('php://input');
$data = json_decode($json);
$id = $data->id;

$result = get_users_of_department($id);
die(json_encode($result));
?>