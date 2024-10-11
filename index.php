<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Учёт сотрудников</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Код сотрудника</th>
                <th>ФИО</th>
                <th>Серия/номер паспорта</th>
                <th>Контактная информация</th>
                <th>Адрес проживания</th>
                <th>Отдел</th>
                <th>Должность</th>
                <th>Размер зарплаты</th>
                <th>Дата принятия на работу</th>
                <th>Статус работы</th>

            </tr>
        </thead>
        <tbody>       
            <?php
            $mysqli = new mysqli("127.0.0.1", "root", "", "UchetSotr");
            if (mysqli_connect_errno()) { 
            echo "Подключение невозможно: ".mysqli_connect_error();
            }
            $result = $mysqli->query("SELECT * FROM Sotr"); //изменила название таблицы бож
            if (!$result) { //првоерка на успешное выполнение запроса
                echo "Ошибка запроса: " . $mysqli->error;
            } else {
                if ($result->num_rows > 0) {
            while/**неправильная структура цикла чтобы результат запроса возвращался по строкам, на е весь сразу*/ ($row = $result->fetch_assoc()) { //Неправильное использование $result, так как это не объект PDOStatement
            ?>
                <tr> 
                    <td><?php echo $row['IdSotr']; ?></td>
                    <td><?php echo $row['FIO']; ?></td>
                    <td><?php echo $row['SeriyaNomerPasporta']; ?></td>
                    <td><?php echo $row['NomerTelefona']; ?></td>
                    <td><?php echo $row['AdresProjivaniya']; ?></td>
                    <td><?php echo $row['Otdel']; ?></td>
                    <td><?php echo $row['Doljnost']; ?></td>
                    <td><?php echo $row['RazmerZP']; ?></td>
                    <td><?php echo $row['DataPrinyatiyaNaRabotu']; ?></td>
                    <td><?php echo $row['StatusRaboti']; ?></td>

                </tr>
            <?php
            }
                } else { //проверка на пустую таблицу
                    echo "<tr><td colspan='10'>Нет данных.</td></tr>";
                }
                $mysqli->close();
            }
            ?>
            
        </tbody>
    </table>

</body>
</html>