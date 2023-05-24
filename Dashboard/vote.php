<?php
require_once '../DB Config/pdo.php';
require_once '../Include/userSession.php';

if (isset($_GET['election_id'])) {
    $voted_msg = '';

    $election_id = $_GET['election_id'];
    $user_id = $_SESSION['USER_ID'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cid = $_POST['candidate'];
        $stmt3 = $pdo->prepare('INSERT INTO votes (election_id, user_id, vote, TIMESTAMP) VALUES (?, ?, ?, ?)');

        if ($stmt3->execute([$election_id, $user_id, $cid, time()])) {
            $voted_msg = 'You voted successfully.';
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
    <title>Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <?php include '../Include/userNavbar.php'; ?>

    <div class="container mt-5">
        <h3>Vote in Election:
            <?php
            $stmt1 = $pdo->prepare("SELECT title FROM elections WHERE election_id = ?");
            $stmt1->execute([$election_id]);
            echo $stmt1->fetch(PDO::FETCH_ASSOC)['title'];
            ?>
        </h3>
        <form action="" method="POST">
            <label class="form-label">Select the candidate you want to vote on:</label>
            <select class="form-select" name="candidate">
                <?php
                $stmt2 = $pdo->prepare("SELECT * FROM candidates WHERE election_id = ?");
                $stmt2->execute([$election_id]);
                while ($candidate = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $candidateName = $candidate['name'];
                    $candidateID = $candidate['candidate_id'];
                    echo "<option value='$candidateID'>$candidateName</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Vote</button>
        </form>
        <?php
            if ($voted_msg != '') {
                echo "<div class='alert alert-success'>$voted_msg</div>";
            }

        ?>

    </div>
</body>
</html>


<?php } ?>