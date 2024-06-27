<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db_connection.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $update_query = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('si', $status, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_orders.php');
    exit();
}

$query = "SELECT orders.id, users.name AS client_name, users.email, services.name AS service_name, orders.order_date, orders.status, orders.completion_date 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          JOIN services ON orders.service_id = services.id";
$result = $conn->query($query);

if (!$result) {
    die("Error in SQL statement: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="admin_services.php">Services</a></li>
                <li><a href="admin_orders.php">Orders</a></li>
                <li><a href="admin_testimonials.php">Testimonials</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Orders</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="order-item">
                <p>Client: <?php echo htmlspecialchars($row['client_name']); ?></p>
                <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
                <p>Service: <?php echo htmlspecialchars($row['service_name']); ?></p>
                <p>Order Date: <?php echo htmlspecialchars($row['order_date']); ?></p>
                <p>Status: <?php echo htmlspecialchars($row['status']); ?></p>
                <p>Completion Date: <?php echo htmlspecialchars($row['completion_date']); ?></p>
                <form action="admin_orders.php" method="post">
                    <label for="status">Update Status:</label>
                    <select id="status" name="status" required>
                        <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="In Progress" <?php if ($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="update" value="Update">
                </form>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>

<?php
$conn->close();
?>
