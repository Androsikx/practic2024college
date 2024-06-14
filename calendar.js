document.addEventListener('DOMContentLoaded', function () {
    var calendar = document.getElementById('calendar');
    var currentDate = new Date();
    var month = currentDate.getMonth();
    var year = currentDate.getFullYear();

    fetch('get_busy_days.php')
        .then(response => response.json())
        .then(busyDays => {
            createCalendar(year, month, busyDays);
        });

    function createCalendar(year, month, busyDays) {
        var d = new Date(year, month, 1);
        var table = '<table>';
        table += '<thead><tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Нд</th></tr></thead>';
        table += '<tbody><tr>';

        
        for (var i = 0; i < getDay(d); i++) {
            table += '<td></td>';
        }

        
        while (d.getMonth() == month) {
            var day = d.getDate();
            var dateStr = d.toISOString().split('T')[0];

            if (busyDays.includes(dateStr)) {
                table += '<td class="busy">' + day + '</td>';
            } else {
                table += '<td>' + day + '</td>';
            }

            if (getDay(d) % 7 == 6) { 
                table += '</tr><tr>';
            }

            d.setDate(d.getDate() + 1);
        }

        
        if (getDay(d) != 0) {
            for (var i = getDay(d); i < 7; i++) {
                table += '<td></td>';
            }
        }

        table += '</tr></tbody></table>';
        calendar.innerHTML = table;
    }

    function getDay(date) { 
        var day = date.getDay();
        if (day == 0) day = 7;
        return day - 1;
    }
});
