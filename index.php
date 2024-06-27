<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клінінгова компанія</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Клінінгова компанія</h1>
        <nav>
            <ul>
                <li><a href="index.php">Головна</a></li>
                <li><a href="services.php">Послуги</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="portfolio.php">Портфоліо</a></li>
                <li><a href="contacts.php">Контакти</a></li>
                <li><a href="profile.php"><img src="images/user-icon.png" alt="User Icon" class="user-icon"></a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section class="intro">
            <h2>Ласкаво просимо до нашої клінінгової компанії!</h2>
            <p>Ми надаємо найкращі клінінгові послуги у вашому місті. Наші професійні працівники забезпечать бездоганну чистоту вашого простору.</p>
            <a href="order.php" class="button">Зробити замовлення</a>

        </section>
        <section class="services-overview">
            <h2>Наші послуги</h2>
            <div class="services-list">
                <div class="service-item">
                    <h3>Прибирання будинків</h3>
                    <p>Відмінні послуги з прибирання вашого будинку за доступними цінами.</p>
                    <a href="services.php" class="button">Детальніше</a>
                </div>
                <div class="service-item">
                    <h3>Офісне прибирання</h3>
                    <p>Професійне прибирання офісних приміщень для створення комфортного робочого середовища.</p>
                    <a href="services.php" class="button">Детальніше</a>
                </div>
              
            </div>
        </section>
        <section class="testimonials">
            <h2>Відгуки клієнтів</h2>
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cleaning";

            $conn = new mysqli($servername, $username, $password, $dbname);

           
            if ($conn->connect_error) {
                die("Помилка з'єднання: " . $conn->connect_error);
            }

          
            $sql = "SELECT testimonial, client_name FROM testimonials";
            $testimonials_result = $conn->query($sql);

            if ($testimonials_result->num_rows > 0) {
                while ($row = $testimonials_result->fetch_assoc()) {
                    echo '<div class="testimonial-item">';
                    echo '<p>"' . $row["testimonial"] . '"</p>';
                    echo '<p>- ' . $row["client_name"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>Немає відгуків.</p>";
            }

            
            $conn->close();
            ?>
        </section>
        <section class="contact-info">
            <h2>Зв'яжіться з нами</h2>
            <p>Телефон: +380 123 456 789</p>
            <p>Email: info@cleaningcompany.com</p>
            <form action="submit_contact_form.php" method="post">
                <label for="name">Ім'я:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Електронна адреса:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Повідомлення:</label>
                <textarea id="message" name="message" required></textarea>
                <input type="submit" value="Відправити">
            </form>
        </section>
    </div>
</body>
</html>
