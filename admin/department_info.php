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
    $sql = "SELECT * FROM department WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows != 1) {
        die('<h1>Phòng ban không tồn tại</h1>');
    } else {
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
    <title>Thông tin phòng ban</title>
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
            <li><a class="logo" href="#"><img src=""></a></li>
            <li><a href="./phongban.php">Quản Lý Phòng Ban</a></li>
            <li><a href="">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Lịch</a></li>
            <li class="nav-item active"><a id="thongke" href="./admin/info.php">Thông Tin</a></li>
            <li class="nav-item active"><a id="logout" href="../logout.php">Đăng xuất</a></li>
        </ul>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="row bg-light">
            <div class="card bg-light" style="width: 400px">
                <div class="card-body">
                    <h3 class="card-title text-center">Thông tin phòng ban</h3>
                    <p class="card-text font-weight-bold">
                        Mã số: <span class='eid'><?= $row['ma_so'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Tên phòng ban: <span class='name'><?= $row['name'] ?></span>
                    </p>
                    <p class="card-text font-weight-bold">
                        Mô tả: <span class='email'><?= $row['description'] ?></span>
                    </p>
                    <?php
                    if(isset($row['manager'])){
                        $manager_id = $row['manager'];
                        $sql = "SELECT fullname FROM account WHERE eid= $manager_id";
                        $result = $conn->query($sql);
                        $data = $result->fetch_assoc();
                        $manager_name = $data['fullname'];
                    }else{
                        $manager_name = 'Chưa có trưởng phòng';
                    }
                    ?>
                    <p class="card-text font-weight-bold">
                        Trưởng phòng: <span class='phone'><?= $manager_name ?></span>
                    </p>

                    <a href="phongban.php" class="card-link btn btn-primary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>