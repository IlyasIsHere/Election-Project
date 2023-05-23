<?php

require_once '../DB Config/pdo.php';
require_once '../Include/userSession.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidate to the election</title>
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
</body>
</html>
