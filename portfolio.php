<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1>Наше Портфоліо</h1>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Головна</a></li>
                <li><a href="services.php">Послуги</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="portfolio.php">Портфоліо</a></li>
                <li><a href="contacts.php">Контакти</a></li>
                <li><a href="profile.php"><img src="images/user-icon.png" alt="User Icon" class="user-icon"></a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Портфоліо</h1>
        
        <section>
            <h2>До і після Фото</h2>
            <div class="photo-gallery">
                <img src="images/before-after1.jpg" alt="Before and After 1">
                <img src="images/before-after2.jpg" alt="Before and After 2">
            </div>
        </section>

        <section>
            <h2>Тематичні дослідження</h2>
            <p>Покіщо це єдиний проект.</p>
        </section>

        <section>
            
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

            </div>
        </section>
    </main>
</body>
</html>
