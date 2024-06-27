<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1>Наші контакти</h1>
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
        <h1>Звязок з нами</h1>
        
        <section>
            <h2>Контактна форма</h2>
            <form action="submit_contact_form.php" method="POST">
                <label for="name">Ім'я:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="email">Електрона пошта:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="message">Повідомлення:</label><br>
                <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
                <button type="submit">Відправити Повідомлення</button>
            </form>
        </section>

        <section>
            <h2>Наша локація</h2>
            <div id="map">
              
            </div>
        </section>

        <section>
            <h2>Наші соціальні мережі</h2>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
            </div>
        </section>

    </main>

</body>
</html>
