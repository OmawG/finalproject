<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birthdayDescription = $_POST['birthdayDescription'];
    $skillsDescription = $_POST['skillsDescription'];
    $achievementsDescription = $_POST['achievementsDescription'];
    $girlfriendDescription = $_POST['girlfriendDescription'];

    $sql = "UPDATE services SET birthday = ?, skills = ?, achievements = ?, girlfriend = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $birthdayDescription, $skillsDescription, $achievementsDescription, $girlfriendDescription);
    $stmt->execute();
}

$sql = "SELECT * FROM services WHERE id = 1";
$result = $conn->query($sql);
$service = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Services</h1>
    <form method="post">
        <div class="mb-3">
            <label for="birthdayDescription" class="form-label">Birthday Description</label>
            <textarea class="form-control" id="birthdayDescription" name="birthdayDescription" rows="3"><?php echo $service['birthday']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="skillsDescription" class="form-label">Skills Description</label>
            <textarea class="form-control" id="skillsDescription" name="skillsDescription" rows="3"><?php echo $service['skills']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="achievementsDescription" class="form-label">Achievements Description</label>
            <textarea class="form-control" id="achievementsDescription" name="achievementsDescription" rows="3"><?php echo $service['achievements']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="girlfriendDescription" class="form-label">Girlfriend Description</label>
            <textarea class="form-control" id="girlfriendDescription" name="girlfriendDescription" rows="3"><?php echo $service['girlfriend']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
</body>
</html>