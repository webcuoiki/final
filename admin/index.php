<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

if($_SESSION['role'] != 'admin') {
    header('Location: ../404.php');
    exit();
}

require_once("../connect_db.php");
$data = get_departments();
$departments = $data['data'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí nhân viên</title>
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
            <li class="nav-item active"><a id="thongke" href="info.php">Thông Tin</a></li>
            <li class="nav-item active"><a id="logout" href="../logout.php">Đăng xuất</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="container mt-2 col-8">
            <h2 class="mt-3 mb-3">Danh sách nhân viên</h2>
            <button onclick="handleAddUser()" class="btn btn-primary" data-toggle="modal" data-target="#confirm-add-user">
                Thêm nhân viên
            </button>

            <table class="table table-hover mt-4 table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Phòng ban</th>
                        <th>Chức vụ</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
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

    <div id="add-show-mess" class="modal fade" role="dialog">
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

    <div id="confirm-add-user" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="add-user-form" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm nhân viên mới</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="full-name">Họ và tên</label>
                            <input type="text" name="full-name" class="form-control" id="full-name" required />
                        </div>
                        <div class="form-group">
                            <label for="user-name">Username</label>
                            <input type="text" name="user-name" class="form-control" id="user-name" required />
                        </div>
                        <div class="form-group">
                            <label for="user-birthday">Ngày sinh</label>
                            <input type="date" name="user-birthday" min="01-01-1950" class="form-control" id="user-birthday" required />
                        </div>
                        <div class="form-group">
                            <label for="user-gender">Giới tính</label>
                            <select class="form-control" name="user-gender" id="user-gender">
                                <option value="nam">Nam</option>
                                <option value="nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user-email">Email</label>
                            <input type="email" name="user-email" class="form-control" id="user-email" required/>
                        </div>
                        <div class="form-group">
                            <label for="user-phone">Số điện thoại</label>
                            <input type="number" name="user-phone" class="form-control" id="user-phone" required/>
                        </div>
                        <div class="form-group">
                            <label for="user-address">Address</label>
                            <textarea class="form-control" name="user-address" id="user-address" rows="2" required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="phongban">Phòng ban</label>
                            <select class="form-control" name="phongban" id="phongban">
                                <?php
                                // lấy phòng ban từ database
                                foreach ($departments as $department) {
                                ?>
                                    <!-- option -->
                                    <option value="<?= $department['id'] ?>"><?= $department['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
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
</body>

</html>