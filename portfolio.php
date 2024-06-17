<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Портфоліо | Клінінгова компанія</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>
<body>
    <header>
        <h1>Портфоліо</h1>
        <nav>
            <ul>
                <li><a href="index.php">Головна</a></li>
                <li><a href="services.php">Послуги</a></li>
                <li><a href="about.php">Про нас</а></li>
                <li><a href="portfolio.php" class="active">Портфоліо</а></li>
                <li><a href="contacts.php">Контакти</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <section>
            <h2>Наші роботи</h2>
            <p>Ми пишаємося нашими успішними проектами. Ось декілька прикладів наших робіт, які демонструють якість і професіоналізм нашої команди.</p>

            <div class="carousel">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "clining";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Підключення не вдалося: " . $conn->connect_error);
                }

                $sql = "SELECT image_url, description FROM portfolio_images";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div><img src="' . $row["image_url"] . '" alt="' . htmlspecialchars($row["description"]) . '"></div>';
                    }
                } else {
                    echo "Немає зображень.";
                }

                $conn->close();
                ?>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
                arrows: true
            });
        });
    </script>
</body>
</html>
