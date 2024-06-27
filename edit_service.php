<?php
session_start();
require 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

// Check if service ID is provided
if (!isset($_GET['id'])) {
    header('Location: admin_services.php');
    exit();
}

$service_id = $_GET['id'];

// Fetch the current details of the service
$query = "SELECT id, name, description, price, duration, category_id FROM services WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $service_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the service exists
if ($result->num_rows !== 1) {
    header('Location: admin_services.php');
    exit();
}

$service = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $category_id = $_POST['category_id'];

    $update_query = "UPDATE services SET name = ?, description = ?, price = ?, duration = ?, category_id = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param('ssdsii', $name, $description, $price, $duration, $category_id, $service_id);

    if ($update_stmt->execute()) {
        header('Location: admin_services.php');
        exit();
    } else {
        $error = "Error updating service: " . $update_stmt->error;
    }

    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Service</h1>
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
        <form action="edit_service.php?id=<?php echo $service_id; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($service['name']); ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($service['description']); ?></textarea>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($service['price']); ?>" required>
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($service['duration']); ?>" required>
            <label for="category_id">Category ID:</label>
            <input type="text" id="category_id" name="category_id" value="<?php echo htmlspecialchars($service['category_id']); ?>" required>
            <input type="submit" value="Update Service">
        </form>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
