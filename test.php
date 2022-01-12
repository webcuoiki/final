
<?php 

require_once("./connect_db.php");
    $id = $_REQUEST['id'];
    $conn = connection();
    $sql = "SELECT * FROM task WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows != 1) {
        die('<h1>Task không tồn tại</h1>');
    } else {
        $row = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style.css">
</head>

<body>
<div class="container d-flex justify-content-center">
        <table class="table table-hover table-bordered mt-4 col-8">
    
            <tbody>
                <tr>
                    <td class="font-weight-bold">ID</td>
                    <td><?= $row['id'] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" >Tên nhiệm vụ</td>
                    <td><?= $row['name'] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Mô tả</td>
                    <td><?= $row['description'] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Người nhận</td>
                    <td>Thanh Tiến</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Trạng thái</td>
                    <td>New</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Đánh giá</td>
                    <td>New</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Đính kèm</td>
                    <td>New</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Thời hạn</td>
                    <td>12-01-2022</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Actions</td>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
</div>
</body>

</html>