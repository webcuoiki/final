<?php 
$pass = 'kancc';
$hashed_pw = password_hash($pass, PASSWORD_DEFAULT);
$random_num = random_int(0, 1000);
$token = md5('kancc' . '+' . $random_num);
echo $token . "\n";
echo $hashed_pw;
?>