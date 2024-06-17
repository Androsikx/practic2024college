<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завантажити Зображення | Клінінгова компанія</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <header>
        <h1>Завантажити Зображення</h1>
        <nav>
            <ul>
                <li><a href="admin.php">Головна</a></li>
                <li><a href="upload.php" class="active">Завантажити Зображення</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <section>
            <h2>Завантажити нове зображення</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="image">Виберіть зображення:</label>
                <input type="file" name="image" id="image" required>
                <label for="description">Опис:</label>
                <input type="text" name="description" id="description" required>
                <button type="submit" name="submit">Завантажити</button>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "Файл не є зображенням.";
                    $uploadOk = 0;
                }

              
                if (file_exists($target_file)) {
                    echo "Файл вже існує.";
                    $uploadOk = 0;
                }

                
                if ($_FILES["image"]["size"] > 5000000) {
                    echo "Файл завеликий.";
                    $uploadOk = 0;
                }

                
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Тільки JPG, JPEG, PNG та GIF файли дозволені.";
                    $uploadOk = 0;
                }

                
                if ($uploadOk == 0) {
                    echo "Ваш файл не було завантажено.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        
                        $image_url = $target_file;
                        $description = $_POST['description'];

                        
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "clining";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Підключення не вдалося: " . $conn->connect_error);
                        }

                        $sql = "INSERT INTO portfolio_images (image_url, description) VALUES ('$image_url', '$description')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Зображення успішно завантажено.";
                        } else {
                            echo "Помилка: " . $sql . "<br>" . $conn->error;
                        }

                        $conn->close();
                    } else {
                        echo "Виникла помилка під час завантаження вашого файлу.";
                    }
                }
            }
            ?>
        </section>
    </div>
</body>
</html>
