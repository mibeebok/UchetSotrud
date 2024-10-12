<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Учёт сотрудников</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Код сотрудника</th>
                <th style=width:15%;>ФИО</th>
                <th>Дата рождения</th>
                <th>Серия/номер паспорта</th>
                <th>Контактная информация</th>
                <th style=width:15%;>Адрес проживания</th>
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
            //добавление запроса на фильтр
            $FOtdel = isset($_GET['FOtdel']) ?$_GET['FOtdel'] : '';
            $FDoljnost = isset($_GET['FDoljnost']) ? $_GET['FDoljnost'] : '';

            $query = "SELECT * FROM Sotr WHERE 1=1";
            if ($FOtdel) {
                $query .= " AND Otdel LIKE '%$FOtdel%'";
            }
            if ($FDoljnost) {
                $query .= " AND Doljnost LIKE '%$FDoljnost%'";
            }
            $result = $mysqli->query($query); 

            if (!$result) { 
                echo "Ошибка запроса: " . $mysqli->error;
            } else {
                if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr> 
                    <td><?php echo $row['IdSotr']; ?></td>
                    <td><?php echo $row['FIO']; ?></td>
                    <td><?php echo $row['DataRojdeniya']; ?></td>
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
                } else { 
                    echo "<tr><td colspan='10'>Нет данных.</td></tr>";
                }
                $mysqli->close();
            }
            ?>
            <p><b>Фильтрация сотрудников по должности или отделу:</b></p>
            form class = "filtr" method="GET" action="">
                <label   class = "filtrO" for="Otdel">Отдел:</label>
                <input type="text" id="Otdel" name="FOtdel" value="<?php echo isset($_GET['Otdel']) ? htmlspecialchars($_GET['Otdel']) : ''; ?>">
                <label  class = "filtr" for="Doljnost">Должность:</label>
                <input type="text" id="Doljnost" name="FDoljnost" value="<?php echo isset($_GET['Doljnost']) ? htmlspecialchars($_GET['Doljnost']) : ''; ?>">
                <button type="submit">Найти</button>
                </form>
        </tbody>
    </table>
</body>
</html>