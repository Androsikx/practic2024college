<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cleaning";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


$sql_orders = "SELECT services.name, orders.order_date, orders.status FROM orders JOIN services ON orders.service_id = services.id WHERE orders.user_id = ?";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("i", $user_id);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();


$stmt->close();
$stmt_orders->close();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профіль</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ваш Профіль</h1>
        <nav>
            <ul>
                <li><a href="index.php">Головна</a></li>
                <li><a href="logout.php">Вийти</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Інформація про користувача</h2>
            <p>Ім'я: <?php echo $user['name']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
        </section>
        <section>
            <h2>Історія замовлень</h2>
            <?php if ($result_orders->num_rows > 0): ?>
                <ul>
                    <?php while ($order = $result_orders->fetch_assoc()): ?>
                        <li>
                            Замовлення: <?php echo $order['name']; ?> - 
                            Дата: <?php echo $order['order_date']; ?> - 
                            Статус: <?php echo $order['status']; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>У вас немає замовлень.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

<?php

$conn->close();
?>
