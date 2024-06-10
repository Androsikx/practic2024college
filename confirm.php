<?php
// Підключення до бази даних (ви можете використовувати ваші дані для підключення)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clining";

// Створення з'єднання з базою даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання на помилки
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Перевірка наявності ідентифікатора в запиті GET
if(isset($_GET['id'])) {
    $orderId = $_GET['id'];
    
    // SQL-запит на оновлення статусу замовлення на підтверджено
    $sql = "UPDATE orders SET status = 'confirmed' WHERE id = $orderId";
    
    // Виконання SQL-запиту
    if ($conn->query($sql) === TRUE) {
        echo "Замовлення підтверджено успішно";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
    
    // Закриття з'єднання з базою даних
    $conn->close();
} else {
    echo "Недійсний ідентифікатор замовлення";
}
?>
