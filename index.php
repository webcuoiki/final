<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] == 'admin') {
    header("Location: ./admin/index.php");
} else if ($_SESSION['role'] == 'manager') {
    header("Location: ./manager/index.php");
} else {
    header("Location: ./user/index.php");
}
