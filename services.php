<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'cleaning');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = null;

if ($service_id > 0) {
    $stmt = $conn->prepare("SELECT name, description, price FROM services WHERE id = ?");
    $stmt->bind_param('i', $services_id);
    $stmt->execute();
    $stmt->bind_result($name, $description, $price);
    if ($stmt->fetch()) {
        $services = ['name' => $name, 'description' => $description, 'price' => $price];
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Послуги</title>
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
                <li><a href="<?php echo isset($_SESSION['user_id']) ? 'profile.php' : 'login.php'; ?>"><img src="images/user-icon.png" alt="User Icon" class="user-icon"></a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Наші Послуги</h2>
            <div class="service">
                <h3>Прибирання післяремонтне</h3>
                <p>Повне прибирання приміщень після ремонтних робіт, включаючи видалення будівельного пилу, очищення поверхонь і вивезення сміття.</p>
                <p>Час виконання: 2 години</p>
                <p>Ціна: 900 грн</p>
            </div>
            <div class="service">
                <h3>Систематичне прибирання</h3>
                <p>Регулярне прибирання житлових та офісних приміщень для підтримки чистоти.</p>
                <p>Час виконання: 1 година</p>
                <p>Ціна: 600 грн</p>
            </div>
            <div class="service">
                <h3>Генеральне прибирання</h3>
                <p>Комплексне прибирання, що включає очищення важкодоступних місць, миття вікон, чищення меблів та килимів.</p>
                <p>Час виконання: 3 години</p>
                <p>Ціна: 700 грн</p>
            </div>
            <div class="service">
                <h3>Експрес прибирання</h3>
                <p>Швидке прибирання приміщень з основними завданнями за короткий час.</p>
                <p>Час виконання: 30 хвилин</p>
                <p>Ціна: 400 грн</p>
            </div>
            <div class="service">
                <h3>Миття вікон</h3>
                <p>Професійне миття вікон та вітрин з використанням спеціальних засобів.</p>
                <p>Час виконання: 1 година</p>
                <p>Ціна: 250 грн</p>
            </div>
            <div class="service">
                <h3>Миття вітрин</h3>
                <p>Ретельне миття великих вітрин у магазинах, офісах та інших комерційних приміщеннях.</p>
                <p>Час виконання: 1.5 години</p>
                <p>Ціна: 400 грн</p>
            </div>
            <div class="service">
                <h3>Миття фасадів</h3>
                <p>Зовнішнє миття будівель, включаючи видалення пилу, бруду та графіті.</p>
                <p>Час виконання: 5 годин</p>
                <p>Ціна: 1900 грн</p>
            </div>
            <div class="service">
                <h3>Чистка кондиціонерів</h3>
                <p>Професійна чистка внутрішніх та зовнішніх блоків кондиціонерів для забезпечення їх ефективної роботи.</p>
                <p>Час виконання: 1 година</p>
                <p>Ціна: 500 грн</p>
            </div>
            <div class="service">
                <h3>Чистка басейнів</h3>
                <p>Комплексне очищення басейнів, включаючи стінки, дно та фільтраційні системи.</p>
                <p>Час виконання: 4 години</p>
                <p>Ціна: 1700 грн</p>
            </div>
            <div class="service">
                <h3>Хімчистка коврів</h3>
                <p>Глибока чистка килимів з використанням спеціальних хімічних засобів, що видаляють бруд та плями.</p>
                <p>Час виконання: 2 години</p>
                <p>Ціна: 800 грн</p>
            </div>
            <div class="service">
                <h3>Хімчистка м’яких меблів</h3>
                <p>Професійна чистка диванів, крісел та інших м'яких меблів.</p>
                <p>Час виконання: 2 години</p>
                <p>Ціна: 700 грн</p>
            </div>
            <div class="service">
                <h3>Хімчистка дитячих колясок</h3>
                <p>Ретельне очищення дитячих колясок від бруду та бактерій.</p>
                <p>Час виконання: 1 година</p>
                <p>Ціна: 350 грн</p>
            </div>
            <div class="service">
                <h3>Хімчистка матрасів</h3>
                <p>Глибоке очищення матраців, що видаляє пил, алергени та плями.</p>
                <p>Час виконання: 1.5 години</p>
                <p>Ціна: 350 грн</p>
            </div>
    </div>
</body>
</html>
