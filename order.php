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


$sql_services = "SELECT id, name FROM services";
$result_services = $conn->query($sql_services);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $order_date = date('Y-m-d');
    $status = "Нове";

    $stmt = $conn->prepare("INSERT INTO orders (user_id, service_id, order_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $service_id, $order_date, $status);

    if ($stmt->execute()) {
        echo "Замовлення успішно створено!";
    } else {
        echo "Помилка: " . $stmt->error;
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
    <title>Створення Замовлення</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Створення Замовлення</h1>
        <nav>
            <ul>
                <li><a href="index.php">Головна</a></li>
                <li><a href="profile.php">Профіль</a></li>
                <li><a href="logout.php">Вийти</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Обрати Послугу</h2>
            <form action="order.php" method="post">
                <label for="service_id">Послуга:</label>
                <select id="service_id" name="service_id" required>
                    <?php while ($service = $result_services->fetch_assoc()): ?>
                        <option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
                    <?php endwhile; ?>
                </select>
                <input type="submit" value="Замовити">
            </form>
        </section>
    </main>
</body>
</html>
