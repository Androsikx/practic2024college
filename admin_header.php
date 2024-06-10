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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('admin_header.php'); ?> <!-- Включаємо новий header -->
    
    <div class="container">
        <section>
            <h2>Список замовлень</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Ім'я клієнта</th>
                    <th>Послуга</th>
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
                        echo "<td>" . $row["status"] . "</td>";
                        echo '<td><a href="confirm.php?id=' . $row["id"] . '">Підтвердити</a> | <a href="reject.php?id=' . $row["id"] . '">Відмовити</a> | <a href="process.php?id=' . $row["id"] . '">В обробці</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Немає замовлень</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </section>
    </div>

</body>
</html>
