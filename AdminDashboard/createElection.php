<?php
require_once '../DB Config/pdo.php';
require_once '../Include/adminSession.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create an election</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>

    <form action="" method="POST" class="container mt-5">
        <div class="mb-3">
            <label for="input1" class="form-label">Election Title</label>
            <input required type="text" class="form-control" id="input1" name="title">
        </div>
        <div class="mb-3">
            <label for="input2" class="form-label">Election Description</label>
            <input type="text" class="form-control" id="input2" name="description">
        </div>
        <div class="mb-3">
            <label for="input3" class="form-label">Start Date</label>
            <input required type="date" class="form-control" id="input3" name="startdate">
        </div>
        <div class="mb-3">
            <label for="input4" class="form-label">End Date</label>
            <input required type="date" class="form-control" id="input4" name="enddate">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $pdo->prepare("INSERT INTO elections (title, description, start_date, end_date) VALUES (?, ?, ?, ?)");
        $title = $_POST["title"];
        $description = $_POST["description"];
        $startDate = $_POST["startdate"];
        $endDate = $_POST["enddate"];

        $success = $stmt->execute([$title, $description, $startDate, $endDate]);

        if ($success) {
            header("Location: adminDashboard.php?success_create=true");
            exit();
        }
    }
    ?>
</body>
</html>