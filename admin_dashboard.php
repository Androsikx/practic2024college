<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Use the navigation menu to manage services, orders, and testimonials.</p>
    </main>
</body>
</html>
