<?php
require_once '../DB Config/pdo.php';
session_start();

if (isset($_SESSION["USER_ID"])) {
    header('location: ../index.php');
    exit();
}

$err = '';
?>

<?php

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $err = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Invalid email format.";
    } elseif ($password != $confirm_password) {
        $err = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);



        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, false)");
        $res = $stmt->execute([$username, $email, $hashed_password]);
        $user_id = $pdo->lastInsertId();

        if ($res) {
            $_SESSION['USER_ID'] = $user_id;
            $_SESSION['USER_EMAIL'] = $email;
            $_SESSION['is_admin'] = false;
            $_SESSION['USERNAME'] = $username;

            header('Location: ../Dashboard/dashboard.php');
            exit();
        }
        else {
            $err = 'An Error Occured';
        }

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="registerStyle.css">
    <link rel="stylesheet" href="../Include/input-style.css">


</head>
<body>
<div class="register-card">
    <h2>Register</h2>
    <div style="color: red;"><?php echo $err ?></div>
    <form method="post" action="">
        <div class="form-container">
            <div class="form-row">
                <label>Username:</label>
                <input type="text" name="username">
            </div>
            <div class="form-row">
                <label>Email:</label>
                <input type="email" name="email">
            </div>
            <div class="form-row">
                <label>Password:</label>
                <input type="password" name="password">
            </div>
            <div class="form-row">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password">
            </div>
            <div class="form-row">
                <input type="submit" name="register" value="Register">
            </div>
            <div class="form-row signin">
                <p>You already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </form>
</div>

</body>
</html>
