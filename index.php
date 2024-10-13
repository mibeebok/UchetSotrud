<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" >
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
    <script src="jquery.maskedinput.min.js"></script>
    <title>Учёт сотрудников</title>
</head>
<body class="diagonal-gradient">
<script> 
            $(function(){ 
                $("#pasport").mask("9999 999999"); 
            }); 
    </script> 
    <script> 
            $(function(){ 
                $("#phone").mask("8(999)999-99-99"); 
            }); 
    </script>
    <h1> Учёт сотрудников </h1>
    <table>
        <thead>
            <tr>
<!-- Шапка таблицы-->
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
            <?php //подключение бд
            $mysqli = new mysqli("127.0.0.1", "root", "", "UchetSotr");

            $host = '127.0.0.1';
            $dbname = 'UchetSotr';
            $username = 'root';
            $password = '';

            //добавление нового сотрудника запрос
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['FIO'])) {
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
                $sql = "INSERT INTO Sotr (FIO, DataRojdeniya, SeriyaNomerPasporta, NomerTelefona, AdresProjivaniya, Otdel, Doljnost, RazmerZP, DataPrinyatiyaNaRabotu, StatusRaboti)
                        VALUES (:FIO, :DataRojdeniya, :SeriyaNomerPasporta, :NomerTelefona, :AdresProjivaniya, :Otdel, :Doljnost, :RazmerZP, :DataPrinyatiyaNaRabotu, :StatusRaboti)";
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
                header("Location: " . $_SERVER['PHP_SELF']); 
                exit(); 
                } catch (PDOException $e) { 
                    echo "Ошибка: " . $e->getMessage(); 
                }
                
            
            }   
            //проверка подключения
            if (mysqli_connect_errno()) { 
            echo "Подключение невозможно: ".mysqli_connect_error();
            }
           
            //Фильтр по отделу и должности
            $FOtdel = isset($_GET['FOtdel']) ?$_GET['FOtdel'] : '';
            $FFIO = isset($_GET['FFIO']) ?$_GET['FFIO'] : '';
            $FDoljnost = isset($_GET['FDoljnost']) ? $_GET['FDoljnost'] : '';

            $query = "SELECT * FROM Sotr WHERE 1=1";
           
            if ($FOtdel) {
                $query .= " AND Otdel LIKE '%$FOtdel%'";
            }
            if ($FFIO) {
                $query .= " AND FIO LIKE '%$FFIO%'";
            }
            if ($FDoljnost) {
                $query .= " AND Doljnost LIKE '%$FDoljnost%'";
            }
            $result = $mysqli->query($query); 
            if (!$result) {
                echo "Ошибка запроса: " . $mysqli->error;
            } else {//заполнения таблицы
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
                    <td><?php if ($row['StatusRaboti'] !== 'Уволен') {  
                        echo "<a href='update.php?IdSotr=" . htmlspecialchars($row['IdSotr']) . "' '>Редактировать</a>"; }?></td>
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
    <br>
    <p><b> Фильтрация соотрудников по должности или отделу и поиск по ФИО: </b></p>
    <form class = "filtr" method="GET" action="">
        <label   class = "filtrO" for="Otdel">Отдел:</label>
        <input type="text" id="Otdel" name="FOtdel" value="<?php echo isset($_GET['Otdel']) ? htmlspecialchars($_GET['Otdel']) : ''; ?>">
        <label   class = "filtrO" for="FIO">ФИО:</label>
        <input type="text" id="FIO" name="FFIO" value="<?php echo isset($_GET['FIO']) ? htmlspecialchars($_GET['FIO']) : ''; ?>">
        <label  class = "filtr" for="Doljnost">Должность:</label>
        <input type="text" id="Doljnost" name="FDoljnost" value="<?php echo isset($_GET['Doljnost']) ? htmlspecialchars($_GET['Doljnost']) : ''; ?>">
        <button type="submit"><span>Найти</span></button>
    </form>
    <br>
    <p><b>Создание нового сотрудника: </b></p>
    <form method ="post">
        <input  class = "SNS" type="text" name="FIO" placeholder="ФИО" required>
        <input  class = "SNS" type="date" name="DataRojdeniya" placeholder="Дата рождения" required>
        <input  class = "SNS" type="text" id = "pasport" name="SeriyaNomerPasporta" placeholder="Серия и номер паспорта" required>
        <input  class = "SNS" type="text" id = "phone" name="NomerTelefona" placeholder="Номер телефона" required>
        <input  class = "SNS" type="text" name="AdresProjivaniya" placeholder="Адрес проживания" required>
        <input  class = "SNS" type="text" name="Otdel" placeholder="Отдел" required>
        <input  class = "SNS" type="text" name="Doljnost" placeholder="Должность" required>
        <input  class = "SNS" type="number" name="RazmerZP" placeholder="Размер зарплаты" required>
        <input  class = "SNS" type="date" name="DataPrinyatiyaNaRabotu" placeholder="Дата принятия на работу" required>
        <input  class = "SNS" type="text" name="StatusRaboti" value="Работает">
        <button  class = "SNS" type="submit"><span>Добавить</span></button>
    </form> 
    <br>
    <p><b>Увольнение сотрудника:</b></p> 
    <form method = "post">
        <input  class = "SNS" type="text" name="IdSotr" placeholder="Код сотрудника" required>
        <button  class = "SNS" type="submit"><span>Уволить</span></button>
        <?php
            $mysqli = new mysqli("127.0.0.1", "root", "", "UchetSotr");
            if ($mysqli->connect_error) {
                die("Ошибка подключения: " . $mysqli->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idSotr = $_POST['IdSotr']; 
                if (mysqli_connect_errno()) {
                    echo "Подключение невозможно: " . mysqli_connect_error();
                    exit();
                }
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
    <br>
    <p name = "Update"><b>Редактирование сотрудников</b></p>
</body>
</html>