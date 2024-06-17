<?php
date_default_timezone_set('Europe/Kiev');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clining";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Видалення замовлення, якщо передано параметр id у запиті GET
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM orders WHERE id = $id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Замовлення успішно видалено";
    } else {
        echo "Помилка при видаленні замовлення: " . $conn->error;
    }
}

// Запит до бази даних для отримання списку замовлень
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмінка - Список замовлень</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <header>
        <h1>Адмінка - Список замовлень</h1>
        <nav>
            <ul>
                <li><a href="admin.php"class="active">Головна</a></li>
                <li><a href="upload.php">Завантажити Зображення</a></li>
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
                    <th>Дата замовлення</th>
                    <th>Статус</th>
                    <th>Дії</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["client_name"] . "</td>";
                        if (isset($row["service"])) {
                            echo "<td>" . $row["service"] . "</td>";
                        } else {
                            echo "<td>Немає інформації</td>";
                        }
                        echo "<td>" . $row["order_date"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo '<td><a href="confirm.php?id=' . $row["id"] . '">Підтвердити</a> | <a href="reject.php?id=' . $row["id"] . '">Відмовити</a> | <a href="process.php?id=' . $row["id"] . '">В обробці</a> | <a href="admin.php?action=delete&id=' . $row["id"] . '" onclick="return confirm(\'Ви впевнені, що хочете видалити це замовлення?\')">Видалити</a></td>';
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
</body>
</html>
