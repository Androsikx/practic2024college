<?php
include 'db_connection.php';

$client_name = $_POST['client_name'];
$service = $_POST['service'];
$status = $_POST['status'];
$order_date = $_POST['order_date'];

$sql = "INSERT INTO orders (client_name, service, status, order_date) VALUES ('$client_name', '$service', '$status', '$order_date')";

if ($conn->query($sql) === TRUE) {
    echo "Новий запис успішно створено";
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
