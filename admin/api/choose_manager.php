<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PATCH");
header('Content-Type: application/json');

require('../../connect_db.php');
$raw = file_get_contents('php://input');
$data = json_decode($raw);
$id = intval($data->id);
$user_id = intval($data->userId);

$result = choose_manager($id, $user_id);
echo json_encode($result);
?>