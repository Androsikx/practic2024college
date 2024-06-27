<?php
session_start();
require 'db_connection.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $category_id = $_POST['category_id'];

    $query = "INSERT INTO services (name, description, price, duration, category_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdsi', $name, $description, $price, $duration, $category_id);

    if ($stmt->execute()) {
        header('Location: admin_services.php');
        exit();
    } else {
        $error = "Error adding service: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add Service</h1>
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
        <form action="add_service.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" required>
            <label for="category_id">Category ID:</label>
            <input type="text" id="category_id" name="category_id" required>
            <input type="submit" value="Add Service">
        </form>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
