<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db_connection.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM testimonials WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_testimonials.php');
    exit();
}

if (isset($_POST['add'])) {
    $client_name = $_POST['client_name'];
    $testimonial = $_POST['testimonial'];
    $add_query = "INSERT INTO testimonials (client_name, testimonial) VALUES (?, ?)";
    $stmt = $conn->prepare($add_query);
    $stmt->bind_param('ss', $client_name, $testimonial);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_testimonials.php');
    exit();
}

$query = "SELECT * FROM testimonials";
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
    <title>Admin - Testimonials</title>
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
        <h2>Manage Testimonials</h2>
        <form action="admin_testimonials.php" method="post">
            <label for="client_name">Client Name:</label>
            <input type="text" id="client_name" name="client_name" required>
            <label for="testimonial">Testimonial:</label>
            <textarea id="testimonial" name="testimonial" required></textarea>
            <input type="submit" name="add" value="Add Testimonial">
        </form>
        <h2>Existing Testimonials</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="testimonial-item">
                <p><?php echo htmlspecialchars($row['testimonial']); ?></p>
                <p>- <?php echo htmlspecialchars($row['client_name']); ?></p>
                <form action="admin_testimonials.php" method="post" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>

<?php
$conn->close();
?>
