<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SESSION['role'] != 'admin') {
    header('Location: ../404.php');
    exit();
}

if (isset($_REQUEST['id'])) {
    require_once("../connect_db.php");
    $id = $_REQUEST['id'];
    $conn = connection();
    $sql = "SELECT * FROM account WHERE eid = $id";
    $result = $conn->query($sql);
    if($result->num_rows != 1) {
        die('<h1>user không tồn tại</h1>');
    }else{
        $row = $result->fetch_assoc();
    }
} else {
    header('Location: ../404.php');
}
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
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header-panel">
        <ul class="header-ul">
            <li><a class="logo" href=""><img src="../src/img/logo.png"></a></li>
            <li><a href="./phongban.php">Quản Lý Phòng Ban</a></li>
            <li><a href="">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Lịch</a></li>
            <li class="nav-item active"><a id="thongke" href="./admin/info.php">Thông Tin</a></li>
            <li class="nav-item active"><a id="logout" href="../logout.php">Đăng xuất</a></li>
        </ul>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="row bg-light">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <img class="card-img-top bg-dark rounded-circle" style="max-width:200px" src="../uploads/<?= $row['avatar'] ?>" alt="Avatar">
            </div>
            <div class="card col-6 bg-light" style="width: 400px">
                <div class="card-body">
                    <h3 class="card-title text-center">Thông tin nhân viên</h3>
                    <p class="card-text font-weight-bold">
                        Mã số: <span class='eid'><?= $row['eid'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Họ và tên: <span class='name'><?= $row['fullname'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Ngày sinh: <span class='birthday'><?= $row['birthday'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Giới tính: <span class='gender'><?= $row['gender'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Email: <span class='email'><?= $row['email'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Số điện thoại: <span class='phone'><?= $row['phone'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Địa chỉ: <span class='address'><?= $row['address'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Chức vụ: <span class='role'><?= $row['level'] == 2 ? 'Nhân viên': 'Trưởng phòng' ?></span>
                    </p>

                    <?php 
                        $phongban = $row['phongban'];
                        $sql = "SELECT name FROM department WHERE id= $phongban";
                        $result = $conn->query($sql);
                        $data = $result->fetch_assoc();
                    ?>
                    <p class="card-text font-weight-bold">
                        Phòng ban: <span class='department'><?= $data['name'] ?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>