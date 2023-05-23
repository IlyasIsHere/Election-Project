<?php
require_once '../DB Config/pdo.php';
require_once '../Include/adminSession.php';

if (! isset($_GET['id'])) {
    header('Location: adminDashboard.php');
    exit();
}

$election_id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM elections WHERE election_id = ?');
$stmt->execute([$election_id]);

if ($stmt->rowCount() != 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $election_title = $row['title'];
    $election_description = $row['description'];
    $election_startdate = $row['start_date'];
    $election_enddate = $row['end_date'];
}

$stmt2 = $pdo->prepare("DELETE FROM elections WHERE election_id = ?");
$success = $stmt2->execute([$election_id]);

if ($success) {
    header('Location: adminDashboard.php?success_delete=true');
    exit();
}

?>