<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'cleaning');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = null;

if ($service_id > 0) {
    $stmt = $conn->prepare("SELECT name, description, price FROM services WHERE id = ?");
    $stmt->bind_param('i', $service_id);
    $stmt->execute();
    $stmt->bind_result($name, $description, $price);
    if ($stmt->fetch()) {
        $services = ['name' => $name, 'description' => $description, 'price' => $price];
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Послуги</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Клінінгова компанія</h1>
        <nav>
            <ul>
                <li><a href="index.php">Головна</a></li>
                <li><a href="services.php">Послуги</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="portfolio.php">Портфоліо</a></li>
                <li><a href="contacts.php">Контакти</a></li>
                <li><a href="<?php echo isset($_SESSION['user_id']) ? 'profile.php' : 'login.php'; ?>"><img src="images/user-icon.png" alt="User Icon" class="user-icon"></a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?php if ($services): ?>
            <h2><?php echo htmlspecialchars($services['name']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($services['description'])); ?></p>
            <p>Ціна: <?php echo htmlspecialchars($services['price']); ?> грн</p>
        <?php else: ?>
            <p>Послуга не знайдена.</p>
        <?php endif; ?>
    </div>
</body>
</html>
