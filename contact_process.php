<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cleaning";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

  
    if (empty($name) || empty($email) || empty($message)) {
        echo "Будь ласка, заповніть всі поля.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Будь ласка, введіть дійсну електронну адресу.";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        
        if ($stmt->execute()) {
            echo "Ваше повідомлення було успішно відправлено.";
        } else {
            echo "Помилка: " . $stmt->error;
        }

        
        $stmt->close();
    }
}


$conn->close();
?>
