<?php
date_default_timezone_set('Europe/Kiev');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST['client_name'])) {
        die("Поле Ім'я є обов'язковим");
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Введіть коректну електронну адресу");
    }

    if (empty($_POST['service_id'])) {
        die("Виберіть послугу для замовлення");
    }

    if (empty($_POST['order_date'])) {
        die("Виберіть дату для замовлення");
    }

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clining";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $client_name = $conn->real_escape_string($_POST['client_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $service_id = (int)$_POST['service_id'];
    $order_date = $_POST['order_date'];

    
    $sql = "INSERT INTO orders (client_name, email, service_id, order_date, completion_date) 
            VALUES ('$client_name', '$email', $service_id, '$order_date', NULL)";

    if ($conn->query($sql) === TRUE) {
        echo "Замовлення успішно збережено";
    } else {
        echo "Помилка при збереженні замовлення: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Дані не надійшли з форми";
}
?>
