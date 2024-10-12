<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование</title>
</head>
<body>
    <?php
    require_once 'index.php';

    $IdSotr = $_GET['IdSotr'];
    $Sotrudnik = mysqli_query($mysqli, query: "SELECT * FROM `Sotr` WHERE `IdSotr` = '$IdSotr'");
    $Sotrudnik = mysqli_fetch_assoc ($Sotrudnik);
    ?>
    <form method ="post">
    <input class="SNS" type="text" name="FIO" value="<?php echo htmlspecialchars($Sotrudnik['FIO']); ?>">
    <input class="SNS" type="date" name="DataRojdeniya" value="<?php echo htmlspecialchars($Sotrudnik['DataRojdeniya']); ?>">
    <input class="SNS" type="text" name="SeriyaNomerPasporta" value="<?php echo htmlspecialchars($Sotrudnik['SeriyaNomerPasporta']); ?>">
    <script>
            $(function(){
                $("#SeriyaNomerPasporta").mask("99 99 999999");
            });
            </script>
    <input class="SNS" type="text" name="NomerTelefona" value="<?php echo htmlspecialchars($Sotrudnik['NomerTelefona']); ?>">
    <script>
            $(function(){
                $("#NomerTelefona").mask("{8}(999) 999 99-99");
            });
            </script>
    <input class="SNS" type="text" name="AdresProjivaniya" value="<?php echo htmlspecialchars($Sotrudnik['AdresProjivaniya']); ?>">
    <input class="SNS" type="text" name="Otdel" value="<?php echo htmlspecialchars($Sotrudnik['Otdel']); ?>">
    <input class="SNS" type="text" name="Doljnost" value="<?php echo htmlspecialchars($Sotrudnik['Doljnost']); ?>">
    <input class="SNS" type="number" name="RazmerZP" value="<?php echo htmlspecialchars($Sotrudnik['RazmerZP']); ?>">
    <input class="SNS" type="date" name="DataPrinyatiyaNaRabotu" value="<?php echo htmlspecialchars($Sotrudnik['DataPrinyatiyaNaRabotu']); ?>">
    <input class="SNS" type="text" name="StatusRaboti" value="<?php echo htmlspecialchars($Sotrudnik['StatusRaboti']); ?>"> 
    <button  class = "SNS" type="submit"><span>Редактировать</span></button>
    </form> 
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>Конец!</h1>
</body>
</html>