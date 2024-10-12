<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" >
    <script src="https://unpkg.com/imask"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="D:\php\htdocs\vera\jquery.maskedinput.min.js"></script>
    <script src="mask.js"></script>
    <title>Учёт сотрудников</title>
</head>
<body>
    <h1> Учёт сотрудников </h1>
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

            $host = '127.0.0.1';
            $dbname = 'UchetSotr';
            $username = 'root';
            $password = '';

            
            //добавление нового сотрудника
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['FIO'])) {
            // Получение данных из формы 
            $FIO = $_POST['FIO'];
            $DataRojdeniya = $_POST['DataRojdeniya'];
            $SeriyaNomerPasporta = $_POST['SeriyaNomerPasporta'];
            $NomerTelefona = $_POST['NomerTelefona'];
            $AdresProjivaniya = $_POST['AdresProjivaniya'];
            $Otdel = $_POST['Otdel'];
            $Doljnost = $_POST['Doljnost'];
            $RazmerZP = $_POST['RazmerZP'];
            $DataPrinyatiyaNaRabotu = $_POST['DataPrinyatiyaNaRabotu'];
            $StatusRaboti = $_POST['StatusRaboti'];
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // SQL-запрос для вставки данных
                $sql = "INSERT INTO Sotr (FIO, DataRojdeniya, SeriyaNomerPasporta, NomerTelefona, AdresProjivaniya, Otdel, Doljnost, RazmerZP, DataPrinyatiyaNaRabotu, StatusRaboti)
                        VALUES (:FIO, :DataRojdeniya, :SeriyaNomerPasporta, :NomerTelefona, :AdresProjivaniya, :Otdel, :Doljnost, :RazmerZP, :DataPrinyatiyaNaRabotu, :StatusRaboti)";
    
                // Подготовка и выполнение запроса 
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':FIO' => $FIO,
                    ':DataRojdeniya' => $DataRojdeniya,
                    ':SeriyaNomerPasporta' => $SeriyaNomerPasporta,
                    ':NomerTelefona' => $NomerTelefona,
                    ':AdresProjivaniya' => $AdresProjivaniya,
                    ':Otdel' => $Otdel,
                    ':Doljnost' => $Doljnost,
                    ':RazmerZP' => $RazmerZP,
                    ':DataPrinyatiyaNaRabotu' => $DataPrinyatiyaNaRabotu,
                    ':StatusRaboti' => $StatusRaboti
                ]);
    
                echo "Сотрудник успешно добавлен!";
            } catch (PDOException $e) {
                echo "Ошибка: " . $e->getMessage();
            }
            }   
            if (mysqli_connect_errno()) { 
            echo "Подключение невозможно: ".mysqli_connect_error();
            }

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
            
        </tbody>
    </table>
    <p><b> Фильтрация соотрудников по должности или отделу: </b></p>
    <!-- фильтр!-->
    <!--возможно проблемой будет то что name не соответствует названию столбца в таблице !-->
    <form class = "filtr" method="GET" action="">
        <label   class = "filtrO" for="Otdel">Отдел:</label>
        <input type="text" id="Otdel" name="FOtdel" value="<?php echo isset($_GET['Otdel']) ? htmlspecialchars($_GET['Otdel']) : ''; ?>">
        <label  class = "filtr" for="Doljnost">Должность:</label>
        <input type="text" id="Doljnost" name="FDoljnost" value="<?php echo isset($_GET['Doljnost']) ? htmlspecialchars($_GET['Doljnost']) : ''; ?>">
        <button type="submit">Найти</button>
    </form>
    <p><b>Создание нового сотрудника: </b></p>
    <form method ="post">
        <input  class = "SNS" type="text" name="FIO" placeholder="ФИО" required>
        <input  class = "SNS" type="date" name="DataRojdeniya" placeholder="Дата рождения" required>
        <input  class = "SNS" type="text" name="SeriyaNomerPasporta" placeholder="Серия и номер паспорта" required>
        <input  class = "SNS" type="text" name="NomerTelefona" placeholder="Номер телефона" required>
        <input  class = "SNS" type="text" name="AdresProjivaniya" placeholder="Адрес проживания" required>
        <input  class = "SNS" type="text" name="Otdel" placeholder="Отдел" required>
        <input  class = "SNS" type="text" name="Doljnost" placeholder="Должность" required>
        <input  class = "SNS" type="number" name="RazmerZP" placeholder="Размер зарплаты" required>
        <input  class = "SNS" type="date" name="DataPrinyatiyaNaRabotu" placeholder="Дата принятия на работу" required>
        <input  class = "SNS" type="text" name="StatusRaboti" value="Работает">
        <script>
            $(function(){
                $("#SeriyaNomerPasporta").mask("99 99 999999");
                });
        </script>
        <button  class = "SNS" type="submit">Добавить</button>
    </form> 
    <p><b>Увольнение сотрудника:</b></p> 
    <form method = "post">
        <input  class = "SNS" type="text" name="IdSotr" placeholder="Код сотрудника" required>
        <button  class = "SNS" type="submit">Уволить</button>
        <?php
            $mysqli = new mysqli("127.0.0.1", "root", "", "UchetSotr");
            // Проверяем соединение
            if ($mysqli->connect_error) {
                die("Ошибка подключения: " . $mysqli->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idSotr = $_POST['IdSotr']; 
                if (mysqli_connect_errno()) {
                    echo "Подключение невозможно: " . mysqli_connect_error();
                    exit();
                }

                // Запрос для изменения статуса
                $stmt = $mysqli->prepare("UPDATE Sotr SET StatusRaboti = 'Уволен' WHERE IdSotr = ? AND StatusRaboti = 'Работает'");
                if ($stmt === false) {
                    die("Ошибка подготовки запроса: " . $mysqli->error);
                }
                $stmt->bind_param("i", $idSotr);
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        echo "";
                    } else {
                        echo "";
                    }
                } else {
                    echo "Ошибка: " . $stmt->error;     
                    $stmt->close();
                    $mysqli->close();
                }
            }
        ?>
    </form>
</body>
</html>