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
    <title>Candidates Management</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <?php include '../Include/adminNavbar.php'; ?>

    <div class="container mt-5">
        <h2>Pending Candidatures</h2>
        <?php
        if (isset($_GET['success'])) {
            echo "<div class='alert alert-success'>Candidature approved successfully.</div>";
        }

        ?>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Candidate Username</th>
                <th>Election Title</th>
                <th></th>
            </tr>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM candidates INNER JOIN users ON candidate_id = user_id NATURAL JOIN elections WHERE is_approved = false");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $candidateName = $row['username'];
                $electionName = $row['title'];
                $cid = $row['candidate_id'];
                $election_id = $row['election_id'];

                echo "<tr>";
                echo "<td>$candidateName</td>";
                echo "<td>$electionName</td>";
                echo "<td><a class='btn btn-success' href='approve.php?cid=$cid&election_id=$election_id'>Approve</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>