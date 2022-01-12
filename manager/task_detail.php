<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SESSION['role'] != 'manager') {
    header('Location: ../404.php');
    exit();
}

if (isset($_REQUEST['id'])) {
    require_once("../connect_db.php");
    $id = $_REQUEST['id'];
    $conn = connection();
    $sql = "SELECT * FROM task WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows != 1) {
        die('<h1>Task không tồn tại</h1>');
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
    <title>Chi tiết nhiệm vụ</title>
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
            <li><a href="">Danh sách nhiệm vụ</a></li>
            <li><a href="./nhanvien.php">Danh sách nhân viên</a></li>
            <li><a href="#">Quản Lý Lịch</a></li>
            <li class="nav-item"><a id="thongke" href="./info.php">Thông Tin</a></li>
            <li class="nav-item"><a id="logout" href="../logout.php">Đăng xuất</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="container mt-2 col-8">
            <h2 class="mt-3 mb-3">Chi tiết nhiệm vụ</h2>
            <button onclick="handleAddTask()" class="btn btn-primary" data-toggle="modal" data-target="#confirm-add-task">
                Thêm nhiệm vụ mới
            </button>

            <table class="table table-hover table-bordered mt-4">

                <tbody>
                    <!-- // list tasks  -->
                    <tr>
                        <td class="font-weight-bold">ID</td>
                        <td><?= $row['id'] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Tên nhiệm vụ</td>
                        <td><?= $row['name'] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Mô tả</td>
                        <td><?= $row['description'] ?></td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Người nhận</td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Trạng thái</td>
                        <td>
                            <?php
                            $state = $row['state'];
                            if ($state == 0) {
                                echo "New";
                            } else if ($state == 1) {
                                echo 'In progress';
                            } else if ($state == 3) {
                                echo 'Canceled';
                            } else if ($state == 4) {
                                echo "Waiting";
                            } else if ($state == 5) {
                                echo "Rejected";
                            } else if ($state == 6) {
                                echo "Completed";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Đánh giá</td>
                        <td>
                            <?php
                            $rate = $row['rate'];
                            if ($rate == 0) {
                                echo "";
                            } else if ($rate == 1) {
                                echo "Good";
                            }
                            if ($rate == 2) {
                                echo "OK";
                            }
                            if ($rate == 3) {
                                echo "Bad";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Đính kèm</td>
                        <td>
                            <span><?= $row['attach'] ?></span>
                            <a href="../uploads/<?= $row['attach'] ?>" class="btn btn-primary" download>
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Thời hạn</td>
                        <td><?= $row['expire'] ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Actions</td>
                        <td>
                            <?php
                            $state = $row['state'];
                            $id = $row['id'];
                            if ($state == 0) {
                                echo ("<a href='cancel_task.php?id=$id' class='btn btn-primary'>
                                            <i class='fas fa-minus-circle'></i>
                                            </a>");
                            } else if ($state == 4) {
                                echo ("<a href='accept_task.php?id=$id' class='btn btn-primary'>
                                            <i class='fas fa-check-square'></i>
                                            </a>");
                                echo ("<a href='reject_task.php?id=$id' class='btn btn-primary'>
                                            <i class='fas fa-window-close'></i>
                                            </a>");
                            } else {
                                echo ("<a href='rating_task.php?id=$id' class='btn btn-primary'>
                                            <i class='fas fa-window-close'></i>
                                            </a>");
                            }
                            ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>



    <div id="reset-password-confirm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset mật khẩu</h5>
                    </div>
                    <div class="modal-body">
                        <p>
                            Bạn có muốn reset mật khẩu về mặc định
                            <strong id="reset-name"></strong> ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button id="close-button" type="button" class="btn btn-primary" data-dismiss="modal">
                            Thoát
                        </button>
                        <button id="reset-button" type="button" class="btn btn-danger">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="show-user-info" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card">
                    <img src="../src/img/beard.png" class="card-img-top mx-auto" alt="avatar" style="max-width: 100px;" />
                    <div class="card-body">
                        <h5 class="card-title">Thông tin nhân viên</h5>
                        <p class="card-text">
                            Mã số: <span class='eid'></span>
                        </p>
                        <p class="card-text">
                            Họ và tên: <span class='name'></span>
                        </p>
                        <p class="card-text">
                            Ngày sinh: <span class='birthday'></span>
                        </p>
                        <p class="card-text">
                            Giới tính: <span class='gender'></span>
                        </p>
                        <p class="card-text">
                            Email: <span class='email'></span>
                        </p>
                        <p class="card-text">
                            Số điện thoại: <span class='phone'></span>
                        </p>
                        <p class="card-text">
                            Địa chỉ: <span class='address'></span>
                        </p>
                        <p class="card-text">
                            Chức vụ: <span class='role'></span>
                        </p>
                        <p class="card-text">
                            Phòng ban: <span class='department'></span>
                        </p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="show-mess" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">Thông báo</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p id='mess'></p>
                </div>
            </div>
        </div>
    </div>

    <div id="confirm-add-task" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="add-user-form" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm nhiệm vụ mới</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="task-name">Tên nhiệm vụ</label>
                            <input type="text" name="task-name" class="form-control" id="task-name" required />
                        </div>
                        <div class="form-group">
                            <label for="task-title">Tiêu đề</label>
                            <input type="text" name="task-title" class="form-control" id="task-title" required />
                        </div>
                        <div class="form-group">
                            <label for="task-title">Mô tả</label>
                            <textarea class="form-control" name="task-title" id="task-title" rows="2" required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="task-receiver">Người nhận</label>
                            <select class="form-control" name="task-receiver" id="task-receiver">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="task-deadline">Thời hạn</label>
                            <input type="date" name="task-deadline" class="form-control" id="task-deadline" required />
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="task-attach">
                            <label class="custom-file-label" for="task-attach">Đính kèm</label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary exit" data-dismiss="modal">
                                Thoát
                            </button>
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </div>
                        <p id='add-form-alert' class="alert alert-danger text-center d-none">Vui lòng điền thông tin đầy
                            đủ, không sử dụng các kí tự như ~,.-+= ...</p>
                </form>
            </div>
        </div>
    </div>

    <script src='../main.js'></script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>