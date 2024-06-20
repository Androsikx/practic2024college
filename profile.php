<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clining";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);

$sql_orders = "SELECT orders.*, services.service_name FROM orders 
               JOIN services ON orders.service_id = services.id 
               WHERE orders.client_email = '$email'";
$result_orders = $conn->query($sql_orders);

$conn->close();
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
    <div class="container">
        <h1>Профіль</h1>
        
        <?php if ($result_user->num_rows > 0): ?>
            <?php $user = $result_user->fetch_assoc(); ?>
            <p><strong>Ім'я:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Електронна адреса:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <?php else: ?>
            <p>Користувача не знайдено.</p>
        <?php endif; ?>
        
        <h2>Поточні замовлення</h2>
        <?php if ($result_orders->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Послуга</th>
                    <th>Дата замовлення</th>
                    <th>Статус</th>
                </tr>
                <?php while($order = $result_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['service_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>У вас немає поточних замовлень.</p>
        <?php endif; ?>
        
        <h2>Історія замовлень</h2>
        <?php if ($result_orders->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Послуга</th>
                    <th>Дата замовлення</th>
                    <th>Статус</th>
                </tr>
                <?php while($order = $result_orders->fetch_assoc()): ?>
                    <?php if ($order['status'] == 'Completed'): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['service_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>У вас немає завершених замовлень.</p>
        <?php endif; ?>
    </div>
</body>
</html>
