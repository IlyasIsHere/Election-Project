<?php
require_once '../DB Config/pdo.php';
require_once '../Include/adminSession.php';

if (isset($_GET['cid']) && isset($_GET['election_id'])) {

    $cid = $_GET['cid'];
    $election_id = $_GET['election_id'];

    $stmt = $pdo->prepare("UPDATE candidates SET is_approved = true WHERE election_id = ? AND candidate_id = ?");
    $success = $stmt->execute([$election_id, $cid]);
    if ($success) {
        header('Location: adminCandidates?success=true');
        exit();
    }

}