<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма замовлення</title>
</head>
<body>
    <div class="container">
        <h1>Форма замовлення</h1>
        <form action="process.php" method="post" onsubmit="return validateForm()">
            <label for="client_name">Ім'я:</label>
            <input type="text" id="client_name" name="client_name" required>
            
            <label for="email">Електронна адреса:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="service">Послуга:</label>
            <select id="service" name="service_id" required>
                <?php
   
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "clining";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                
                $sql = "SELECT * FROM services";
                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['service_name'] . ' - ' . $row['price'] . ' грн, ' . $row['execution_time'] . '</option>';
                    }
                } else {
                    echo '<option value="">Послуги не знайдено</option>';
                }

                $conn->close();
                ?>
            </select>

            <label for="order_date">Дата:</label>
            <input type="date" id="order_date" name="order_date" min="<?php echo date('Y-m-d'); ?>" required>
            
            <input type="submit" value="Відправити">
        </form>
    </div>

    <script>
        function validateForm() {
            var clientName = document.getElementById('client_name').value;
            var email = document.getElementById('email').value;

            if (clientName.trim() === '') {
                alert("Поле Ім'я є обов'язковим");
                return false;
            }

            if (!validateEmail(email)) {
                alert("Введіть коректну електронну адресу");
                return false;
            }

            return true;
        }

        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    </script>
</body>
</html>
