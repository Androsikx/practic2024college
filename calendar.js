document.addEventListener('DOMContentLoaded', function () {
    var calendar = document.getElementById('calendar');
    var currentDate = new Date();
    var month = currentDate.getMonth();
    var year = currentDate.getFullYear();

    function createCalendar(year, month) {
        var d = new Date(year, month, 1);
        var table = '<table>';
        table += '<thead><tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Нд</th></tr></thead>';
        table += '<tbody>';

        // Додаємо порожні комірки до першого дня місяця
        for (var i = 0; i < getDay(d); i++) {
            table += '<td></td>';
        }

        // Додаємо числа місяця
        while (d.getMonth() == month) {
            table += '<td>' + d.getDate() + '</td>';

            if (getDay(d) % 7 == 6) { // Кінець тижня
                table += '</tr><tr>';
            }

            d.setDate(d.getDate() + 1);
        }

        // Додаємо порожні комірки після останнього дня місяця, якщо потрібно
        if (getDay(d) != 0) {
            for (var i = getDay(d); i < 7; i++) {
                table += '<td></td>';
            }
        }

        table += '</tr></tbody></table>';
        calendar.innerHTML = table;
    }

    function getDay(date) { // Функція для отримання номера дня з неділі (0) до суботи (6)
        var day = date.getDay();
        if (day == 0) day = 7;
        return day - 1;
    }

    createCalendar(year, month);
});
