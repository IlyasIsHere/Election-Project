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
    <title>Admin Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-primary text-white">

        <div class="container-fluid">
            <h1>Elections (Admin)</h1>
            <!-- Links -->
            <ul class="navbar-nav gap-3">
                <li class="nav-item bg-secondary">
                    <a class="nav-link text-white" href="../Authentication/logout.php">Logout</a>
                </li>
            </ul>
        </div>

    </nav>

    <div class="container mt-5">
        <?php if (isset($_GET['success_edit'])) { ?>
            <div class="alert alert-success">Election edited successfully</div>
        <?php } ?>
        <?php if (isset($_GET['success_delete'])) { ?>
            <div class="alert alert-danger">Election deleted</div>
        <?php } ?>
        <?php if (isset($_GET['success_create'])) { ?>
            <div class="alert alert-success">Election created successfully</div>
        <?php } ?>

        <a href="createElection.php" class="btn btn-primary">Create a new election</a>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Edit Election</th>
                <th>Close Election</th>
            </tr>
            <?php
            $stmt = $pdo->prepare('SELECT * FROM elections');
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $election_id = $row['election_id'];
                $election_title = $row['title'];
                $election_description = $row['description'];
                $election_startdate = $row['start_date'];
                $election_enddate = $row['end_date'];

                echo "<tr>";
                echo "<td>$election_title</td>";
                echo "<td>$election_description</td>";
                echo "<td>$election_startdate</td>";
                echo "<td>$election_enddate</td>";
                echo "<td><a class='btn btn-success' href='editElection.php?id=$election_id'>Edit</a></td>";
                echo "<td><a class='btn btn-danger' href='closeElection.php?id=$election_id'>Close</a></td>";
                echo "</tr>";
            }




            ?>
        </table>
    </div>
</body>
</html>