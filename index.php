<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            $mysqli = new mysqli("127.0.0.1", "root", "", "UchetSotr"); //подключила бд
            if (mysqli_connect_errno()) { // проверка на корректное соединение
            echo "Подключение невозможно: ".mysqli_connect_error();
            }
            $result = $mysqli->prepare("SELECT * FROM 'UchetSotr' "); //запрос на вывод таблицы
            $result->execute();
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($list as $row): // вывод данных из таблицы
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
            $mysqli ->close(); //прекращение соединения
            ?>
            
        </tbody>
    </table>

</body>
</html>