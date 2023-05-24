<?php
require_once '../DB Config/pdo.php';
require_once '../Include/userSession.php';

function isCandidate($id, $election_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM candidates WHERE candidate_id = ? AND election_id = ?");
    $stmt->execute([$id, $election_id]);
    if ($stmt->rowCount() > 0) {
        $isApproved = $stmt->fetch(PDO::FETCH_ASSOC)['is_approved'];
        if ($isApproved) {
            return array('candidated'=>true, 'approved'=>true);
        } else {
            return array('candidated'=>true, 'approved'=>false);
        }

    } else {
        return array('candidated'=>false, 'approved'=>false);
    }
}

function hasVoted($id, $election_id) {
    global $pdo;
    $stmt5 = $pdo->prepare("SELECT * FROM votes WHERE election_id = ? AND user_id = ?");
    $stmt5->execute([$election_id, $id]);
    if ($stmt5->rowCount() > 0) {
        return true;
    }
    else {
        return false;
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
    <title>User Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <?php include '../Include/userNavbar.php'; ?>

    <div class="container mt-5">
        <?php if (isset($_GET['candidate_requested'])) { ?>
            <div class="alert alert-success">Candidature requested successfully</div>
        <?php } ?>

        <table class="table table-bordered table-striped">
            <tr>
                <th>Election Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
                <th></th>
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

                $info = isCandidate($_SESSION['USER_ID'], $election_id);
                $candidated = $info['candidated'];
                $approved = $info['approved'];


                echo "<tr>";
                echo "<td>$election_title</td>";
                echo "<td>$election_description</td>";
                echo "<td>$election_startdate</td>";
                echo "<td>$election_enddate</td>";

                if ($election_enddate >= date('Y-m-d')) {

                    if (! $candidated) {
                        echo "<td><a class='btn btn-primary' href='candidate.php?election_id=$election_id'>Candidate</a></td>";
                    } else {
                        if ($approved) {
                            echo "<td>Candidature Approved</td>";
                        } else {
                            echo "<td>Candidature Pending</td>";
                        }
                    }

                    if (hasVoted($_SESSION['USER_ID'], $election_id)) {
                        echo "<td>Already Voted</td>";
                    }
                    else {
                        echo "<td><a class='btn btn-success' href='vote.php?election_id=$election_id'>Vote</a></td>";
                    }


                } else {
                    echo "<td>Already ended</td>";
                    echo "<td></td>";
                }
                echo "</tr>";
            }




            ?>
        </table>
    </div>
</body>
</html>