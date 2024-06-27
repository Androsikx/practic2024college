<?php
require 'db_connection.php';

$username = 'admin';
$password = password_hash('adminpassword', PASSWORD_DEFAULT);

$query = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$stmt->close();

echo "Admin user added successfully.";
?>
