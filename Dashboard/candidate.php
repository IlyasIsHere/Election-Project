<?php

require_once '../DB Config/pdo.php';
require_once '../Include/userSession.php';

if (isset($_GET['election_id'])) {
    $election_id = $_GET['election_id'];
    $user_id = $_SESSION['USER_ID'];
    $username = $_SESSION['USERNAME'];

    $stmt = $pdo->prepare("INSERT INTO candidates (candidate_id, election_id, name, is_approved) VALUES (?, ?, ?, ?)");

    $res = $stmt->execute([$user_id, $election_id, $username, false]);

    if ($res) {
        header('Location: dashboard.php?candidate_requested=true');
        exit();
    }
}


?>
