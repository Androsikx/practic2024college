-- Структура таблиці для замовлень
CREATE TABLE orders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    service VARCHAR(100) NOT NULL,
    status VARCHAR(50) DEFAULT 'В обробці'
);

-- Приклад даних для таблиці замовлень
INSERT INTO orders (client_name, service) VALUES ('Іван Петров', 'Прибирання офісу');
INSERT INTO orders (client_name, service) VALUES ('Марія Сидорова', 'Прибирання квартири');
