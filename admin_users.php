<?php
// Підключення до бази даних
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "clining";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запит до бази даних для отримання списку користувачів
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмінка - Список користувачів</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Адмінка - Список користувачів</h1>
        <nav>
            <ul>
                <li><a href="admin.php">Назад до головної</a></li>
                <li><a href="admin_orders.php">Замовлення</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <section>
            <h2>Список користувачів</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Ім'я</th>
                    <th>Email</th>
                    <th>Роль</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Немає користувачів</td></tr>";
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
