<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clining";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <div class="container">
        <h1>Реєстрація</h1>
        <form action="register.php" method="post">
            <label for="name">Ім'я:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Електронна адреса:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Реєстрація">
        </form>
    </div>
</body>
</html>
