<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

$birthday = $conn->real_escape_string($data['birthday']);
$skills = $conn->real_escape_string($data['skills']);
$achievements = $conn->real_escape_string($data['achievements']);
$girlfriend = $conn->real_escape_string($data['girlfriend']);

// Update the database
$sql = "UPDATE services SET description='$birthday' WHERE service='birthday'";
$conn->query($sql);

$sql = "UPDATE services SET description='$skills' WHERE service='skills'";
$conn->query($sql);

$sql = "UPDATE services SET description='$achievements' WHERE service='achievements'";
$conn->query($sql);

$sql = "UPDATE services SET description='$girlfriend' WHERE service='girlfriend'";
$conn->query($sql);

$conn->close();

echo json_encode(["status" => "success"]);
?>