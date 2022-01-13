<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
require_once('../connect_db.php');

$result = get_user(1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
<div class="header-panel">
        <ul class="header-ul">
         <li><a class="logo" href=""><img src="../src/img/logo.png"></a></li>
            <li><a href="../index.php">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Lịch</a></li>
            <li class="nav-item active"><a id="thongke" href="info.php">Thông Tin</a></li>
            <li class="nav-item active"><a id="logout" href="./logout.php">Đăng xuất</a></li>
        </ul>
    </div>
    <div class="container">
        <!-- // include navbar here -->
        <div class="col-8">
            <h1 class="text-center">Thông tin giám đốc</h1>

        </div>
    </div>
</body>
<script src="../main.js"></script>
</html>