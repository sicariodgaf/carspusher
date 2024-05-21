<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.8.0/slimselect.min.css"
          integrity="sha512-QhrDqeRszsauAfwqszbR3mtxV3ZWp44Lfuio9t1ccs7H15+ggGbpOqaq4dIYZZS3REFLqjQEC1BjmYDxyqz0ZA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Carspusher</title>
</head>
<body>
<div class="topnav">
    <a href="main.php">Таблицы</a>
    <a href="add.php">Добавить</a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<div style="padding:20px;margin-top:30px;line-height:25px;">
</div>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

<form method="post">
    <label>Выберите дилера</label><br>
    <select name="dealer">
        <option value="">---------</option>
        <?php
        $dsn = 'mysql:host=localhost;dbname=f0940058_carspusher;charset=utf8';
        $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
        $stmt = $pdo->query('SELECT id, name FROM Dealer');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        ?>
    </select><br>
    <br>
    <label>Выберите менеджера</label><br>
    <select name="manager">
        <option value="">---------</option>
        <?php
        $dsn = 'mysql:host=localhost;dbname=f0940058_carspusher;charset=utf8';
        $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
        $stmt = $pdo->query('SELECT id, name, surname FROM Manager');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row["id"] . '">' . $row["name"] . ' ' . $row["surname"] . '</option>';
        }
        ?>
    </select><br>
    <br>
    <input type="submit" name="formSubmit" value="Добавить">
</form>

<?php

if (isset($_POST['formSubmit'])) {
    echo 'ok';
    $dealer = $_POST['dealer'];
    $manager = $_POST['manager'];
    $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
    $stmt = $pdo->prepare('INSERT INTO `Order`(dealer_id, manager_id) VALUES (:dealer, :manager)');
    $stmt->bindParam(':dealer', $dealer);
    $stmt->bindParam(':manager', $manager);
    $stmt->execute();
    header("Location:order.php");
    exit();
}
?>
</body>
</html>
