<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Заголовок страницы</title>
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

<form method="get">
    <label>Имя</label><br>
    <input type="text" name="name"><br>
    <label>Фамилия</label><br>
    <input type="text" name="surname"><br>
    <label>Номер телефона</label><br>
    <input type="text" name="number"><br>
    <label>Email</label><br>
    <input type="text" name="email"><br>
    <br>
    <input type="submit" name="formSubmit" value="Добавить">
</form>
</body>
</html>
<?php

if (isset($_GET['formSubmit'])) {
    $nameform = $_GET['name'];
    $surnameform = $_GET['surname'];
    $numberform = $_GET['number'];
    $emailform = $_GET['email'];
    $dsn = 'mysql:host=localhost;dbname=f0940058_carspusher;charset=utf8';
    $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('INSERT INTO Manager (name, surname, phone_number, email) VALUES (:name, :surname, :number, :email)');
    $stmt->bindParam(':name', $nameform);
    $stmt->bindParam(':surname', $surnameform);
    $stmt->bindParam(':number', $numberform);
    $stmt->bindParam(':email', $emailform);
    $stmt->execute();
    header("Location:manager.php");
    exit();
}
?>


