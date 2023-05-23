<?php
session_start();

if (! isset($_SESSION['USER_ID'])) {
    header('Location: ../Authentication/login.php');
    exit();
}
else {
    if (! $_SESSION['is_admin']) {
        header('Location: ../Dashboard/dashboard.php');
        exit();
    }
}