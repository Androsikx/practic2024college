<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клінінгова компанія - Головна</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Вітаємо в клінінговій компанії</h1>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Головна</a></li>
                <li><a href="services.php">Послуги</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="portfolio.php">Портфоліо</a></li>
                <li><a href="contacts.php">Контакти</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section>
            <h2>Головна сторінка</h2>
            <p>Короткий опис послуг компанії тут...</p>
            <p>Контактна інформація та форма для швидкого запиту тут...</p>
        </section>
        <aside class="calendar">
            <h2>Календар замовлень</h2>
            <div id="calendar"></div>
        </aside>
    </div>

    <script src="calendar.js"></script>
</body>
</html>
