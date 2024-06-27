<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cleaning;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt->execute();

echo "New record created successfully";

$stmt->close();
$conn->close();
?>
