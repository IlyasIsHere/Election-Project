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
    <title>Votes Report</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <?php include '../Include/userNavbar.php'; ?>
    <div class="container mt-5">
        <?php
        $stmt1 = $pdo->prepare("SELECT * FROM elections");
        $stmt1->execute();
        while ($election = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $election_id = $election['election_id'];
            $election_name = $election['title'];
            echo "<h3>$election_name</h3>";
            echo "<table class='table table-bordered table-striped'><tr><th>Candidate Name</th><th>Number of Votes</th></tr>";
            $stmt2 = $pdo->prepare("SELECT name, COUNT(*) as cnt FROM votes V INNER JOIN candidates C ON vote = candidate_id WHERE V.election_id = $election_id GROUP BY vote");

            $stmt2->execute();
            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $name = $row['name'];
                $count = $row['cnt'];

                echo "<tr>";
                echo "<td>$name</td>";
                echo "<td>$count</td>";
                echo "</tr>";
            }
            echo "</table>";
        }


        ?>
    </div>
</body>
</html>
