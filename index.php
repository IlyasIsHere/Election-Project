<?php
session_start();

if (isset($_SESSION['USER_ID'])) {

    if ($_SESSION['is_admin']) {
        header('Location: AdminDashboard/adminDashboard.php');
        exit();
    } else {
        header('Location: Dashboard/dashboard.php');
        exit();
    }
} else {
    header('Location: Authentication/login.php');
    exit();
}

