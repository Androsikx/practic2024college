<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clining";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT date FROM orders WHERE status = 'busy'";
$result = $conn->query($sql);

$busy_days = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $busy_days[] = $row['date'];
    }
}

$conn->close();

echo json_encode($busy_days);
?>
