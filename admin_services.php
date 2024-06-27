<?php
session_start();
require 'db_connection.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}


$query = "SELECT id, name, description, price, duration, category_id FROM services";
$result = $conn->query($query);


if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Services</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Manage Services</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="admin_orders.php">Orders</a></li>
                <li><a href="admin_services.php">Services</a></li>
                <li><a href="admin_testimonials.php">Testimonials</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Services</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Category ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['duration']; ?></td>
                        <td><?php echo $row['category_id']; ?></td>
                        <td>
                            <a href="edit_service.php?id=<?php echo $row['id']; ?>" class="button">Edit</a>
                            <a href='delete_service.php?service_id=" . $row['id'] . "' class='button' onclick='return confirm(\"Are you sure you want to delete this service?\");'>Delete</a></td>";
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="add_service.php" class="button">Add New Service</a>
    </main>
</body>
</html>
