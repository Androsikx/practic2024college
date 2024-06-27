<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'root', '', 'cleaning');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $password);
    if ($stmt->execute()) {
        header('Location: login.php');
        exit();
    } else {
        $error = 'Помилка реєстрації. Спробуйте ще раз.';
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Реєстрація</h1>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <label for="name">Ім'я:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Електронна адреса:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Реєстрація">
        </form>
        <p>Вже маєте обліковий запис? <a href="login.php">Увійдіть тут</a></p>
    </div>
</body>
</html>
