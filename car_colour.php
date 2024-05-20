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

<form method="post">
    <label>Введите VIN-код </label><br>
    <input type="text" name="vin"><br>
    <br>
    <label>Введите стоимость </label><br>
    <input type="text" name="cost"><br>
    <br>
    <label>Выберите автомобиль</label><br>
    <select name="car">
        <option value="">-----</option>
        <?php
        $dsn = 'mysql:host=localhost;dbname=f0940058_carspusher;charset=utf8';
        $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
        $stmt = $pdo->query('SELECT Car.id, Brand.brand_name, Car.model FROM Car JOIN Brand ON Car.brand_id = Brand.id');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row["id"] . '">' . $row["brand_name"] . ' ' . $row["model"] . '</option>';
        }
        ?>
    </select><br>
    <br>
    <label>Выберите цвет</label><br>
    <select name="colour">
        <option value="">-----</option>
        <?php
        $dsn = 'mysql:host=localhost;dbname=f0940058_carspusher;charset=utf8';
        $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
        $stmt = $pdo->query('SELECT * FROM Colour');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row["id"] . '">' . $row["colour_name"] . '</option>';
        }
        ?>
    </select><br>
    <br>
    <input type="submit" name="formSubmit" value="Добавить">
</form>

<?php

if (isset($_POST['formSubmit'])) {
    echo 'ok';
    $car = $_POST['car'];
    $vin = $_POST['vin'];
    $cost = $_POST['cost'];
    $colour = $_POST['colour'];
    $pdo = new PDO($dsn, 'f0940058_carspusher', 'admin123');
    $stmt = $pdo->prepare('INSERT INTO Car_colour (car_id, colour_id, vin, price) VALUES (:car, :colour, :vin, :cost)');
    $stmt->bindParam(':car', $car);
    $stmt->bindParam(':colour', $colour);
    $stmt->bindParam(':vin', $vin);
    $stmt->bindParam(':cost', $cost);
    $stmt->execute();
    header("Location:car_colour.php");
    exit();
}
?>
</body>
</html>
