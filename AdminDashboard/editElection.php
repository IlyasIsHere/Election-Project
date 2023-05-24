<?php
require_once '../DB Config/pdo.php';
require_once '../Include/adminSession.php';

if (! isset($_GET['id'])) {
    header('Location: adminDashboard.php');
    exit(); }

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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Election</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="POST" class="container mt-5" id="form">
        <div class="mb-3">
            <label for="input1" class="form-label">Election Title</label>
            <input required type="text" class="form-control" id="input1" name="title" value="<?php echo $election_title; ?>">
        </div>
        <div class="mb-3">
            <label for="input2" class="form-label">Election Description</label>
            <input type="text" class="form-control" id="input2" name="description" value="<?php echo $election_description; ?>">
        </div>
        <div class="mb-3">
            <label for="input3" class="form-label">Start Date</label>
            <input required type="date" class="form-control" id="input3" name="startdate" value="<?php echo $election_startdate; ?>">
        </div>
        <div class="mb-3">
            <label for="input4" class="form-label">End Date</label>
            <input required type="date" class="form-control" id="input4" name="enddate" value="<?php echo $election_enddate; ?>">
        </div>

        <div class="alert alert-danger" id="alert" style="display: none;">Start Date should be earlier than End Date!</div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="../Include/dateValidation.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt2 = $pdo->prepare("UPDATE elections SET title = ?, description = ?, start_date = ?, end_date = ? WHERE election_id = ?");

    $title = $_POST["title"];
    $description = $_POST["description"];
    $startDate = $_POST["startdate"];
    $endDate = $_POST["enddate"];

    $success = $stmt2->execute([$title, $description, $startDate, $endDate, $election_id]);


    if ($success) {
        header('Location: adminDashboard.php?success_edit=true');
        exit();
    }
}

?>