<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clining";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET['id'])) {
    $orderId = $_GET['id'];
    
    
    $sql = "UPDATE orders SET status = 'confirmed' WHERE id = $orderId";
    
   
    if ($conn->query($sql) === TRUE) {
        echo "Замовлення підтверджено успішно";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
    
    
    $conn->close();
} else {
    echo "Недійсний ідентифікатор замовлення";
}
?>
