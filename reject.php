<?php
// Check if ID is set and numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $orderId = $_GET['id'];

    // Connect to database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clining";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL to update order status (example)
    $sql = "UPDATE orders SET status = 'rejected' WHERE id = $orderId";

    if ($conn->query($sql) === TRUE) {
        echo "Order rejected successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid order ID";
}
?>
