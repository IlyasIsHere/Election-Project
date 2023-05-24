<?php
session_start();
require_once '../DB Config/pdo.php';

if (isset($_SESSION["USER_ID"])) {
    header('location: ../index.php');
    exit();
}

$err = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);

    if ($stmt->rowCount() == 0) {
        $err = "There is no account with this username or email.";
    }
    else {
        $user_row = $stmt->fetch();
        $hash = $user_row["password"];
        if (! password_verify($pass, $hash)) {
            $err = "Incorrect password.";
        }
        else {
            $_SESSION["USER_ID"] = $user_row["user_id"];
            $_SESSION["USER_EMAIL"] = $user_row["email"];
            $_SESSION["is_admin"] = $user_row["is_admin"];
            $_SESSION['USERNAME'] = $user_row["username"];

            header('location: ../index.php');
            exit();
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="loginStyle.css">
    <link rel="stylesheet" href="../Include/input-style.css">

</head>
<body>
<div class="login-card">
    <h2>Login</h2>
    <form method="post">
        <div class="form-container">
            <div class="form-row">
                <label for="username">Username or Email</label>
                <input type="text" name="username" id="username" value="<?php echo $_POST['username'] ?? ''; ?>" required>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-row err">
                <?php echo $err; ?>
            </div>
            <div class="form-row">
                <input type="submit" value="Login">
            </div>
            <div class="form-row create-acc">
                <p>New here? <a href="register.php">Create an account</a></p>
            </div>
        </div>
    </form>

</div>
</body>
</html>