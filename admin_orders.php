<?php
// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clining";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require 'db_connection.php';

// Запит до бази даних для отримання списку замовлень
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмінка - Список замовлень</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Адмінка - Список замовлень</h1>
        <nav>
            <ul>
                <li><a href="admin_orders.php" class="active">Замовлення</a></li>
                <li><a href="admin_users.php">Користувачі</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <section>
            <h2>Список замовлень</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Ім'я клієнта</th>
                    <th>Послуга</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Дії</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["client_name"] . "</td>";
                        echo "<td>" . $row["service"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo '<td><a href="confirm.php?id=' . $row["id"] . '">Підтвердити</a> | <a href="reject.php?id=' . $row["id"] . '">Відмовити</a> | <a href="process.php?id=' . $row["id"] . '">В обробці</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Немає замовлень</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </section>
    </div>

    <footer>
        <p>Клінінгова компанія &copy; 2024. Всі права захищені.</p>
    </footer>
</body>
</html>