<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="templates/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.8.0/slimselect.min.css"
          integrity="sha512-QhrDqeRszsauAfwqszbR3mtxV3ZWp44Lfuio9t1ccs7H15+ggGbpOqaq4dIYZZS3REFLqjQEC1BjmYDxyqz0ZA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <title>Заголовок страницы</title>

    <style> table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        } </style>
</head>
<body>
<div class="topnav">
    <a href="main.php">Таблицы</a>
    <a href="add.php">Добавить</a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<div style="padding:20px;margin-top:30px;line-height:25px;">
    <form method="POST">
        <label for="tables">Выберите таблицу</label><br>
        <select name="tables" id="tables">
            <option value="Null">-------</option>
            <option value="Brand">Бренд</option>
            <option value="Car">Модель</option>
            <option value="Colour">Цвет</option>
            <option value="Car_colour">Продажа</option>
            <option value="Status">Статус</option>
            <option value="Order">Заказ</option>
            <option value="Manager">Менеджер</option>
            <option value="Dealer">Дилер</option>
            <option value="Cars in order">Машины в заказе</option>
            <option value="Order_status">Статус заказа</option>
        </select><br>
        <input type="submit" name="submit" value="Показать таблицу"/>
    </form>
    <form method="POST">
        <label for="tables">Выберите таблицу</label><br>
        <select name="tables" id="tables">
            <option value="Null"></option>
            <option value="Brand">Бренд</option>
        </select><br>
        <input type="submit" name="submit" value="Показать таблицу"/>
    </form>
</div>
<?php

if (isset($_POST['submit'])) {
    $selectedTable = $_POST['tables'];
    $host = 'localhost';
    $db = 'f0940058_carspusher';
    $user = 'f0940058_carspusher';
    $pass = 'admin123';

    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    require_once("filters.php");
    try {
        get_filters($selectedTable);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    switch ($selectedTable) {
        case 'Brand':
            echo "Brand";
            $stmt = $pdo->query('SELECT * FROM Brand');
            break;
        case 'Car':
            echo "Car";
            $stmt = $pdo->query('SELECT Car.id, Brand.brand_name, Car.model FROM Car JOIN Brand ON Car.brand_id = Brand.id');
            break;
        case 'Colour':
            echo "Colour";
            $stmt = $pdo->query('SELECT * FROM Colour');
            break;
        case 'Status':
            echo "Status";
            $stmt = $pdo->query('SELECT * FROM Status');
            break;
        case 'Order':
            echo "Order";
            $stmt = $pdo->query('SELECT `Order`.`id`, `Dealer`.`name` AS `Dealer`, `Manager`.`surname` AS `Manager`, GROUP_CONCAT(`Car_colour`.`vin` SEPARATOR ", ") AS `vins`, SUM(`Car_colour`.`price`) AS `total_price`, `Status`.`status_name`, `Order_status`.`date`
                                        FROM `Order` 
                                            LEFT JOIN `Dealer` ON `Order`.`dealer_id` = `Dealer`.`id` 
                                            LEFT JOIN `Manager` ON `Order`.`manager_id` = `Manager`.`id` 
                                            LEFT JOIN `Cars in order` ON `Cars in order`.`order_id` = `Order`.`id` 
                                            LEFT JOIN `Car_colour` ON `Cars in order`.`car_colour_id` = `Car_colour`.`id` 
                                            LEFT JOIN `Order_status` ON `Order_status`.`order_id` = `Order`.`id` 
                                            LEFT JOIN `Status` ON `Order_status`.`status_id` = `Status`.`id`
                                        GROUP BY `Order`.`id`, `Dealer`.`name`, `Manager`.`surname`, `Status`.`status_name`, `Order_status`.`date`');
            break;
        case 'Manager':
            echo "Manager";
            $stmt = $pdo->query('SELECT * FROM Manager');
            break;
        case 'Dealer':
            echo "Dealer";
            $stmt = $pdo->query('SELECT * FROM Dealer');
            break;
        case 'Car_colour':
            echo "Car_colour";
            $stmt = $pdo->query('SELECT Car_colour.id, Brand.brand_name, Car.model, Colour.colour_name, Car_colour.vin, Car_colour.price FROM Car_colour JOIN Car ON Car_colour.car_id = Car.id JOIN Brand ON Car.brand_id = Brand.id JOIN Colour ON Car_colour.colour_id = Colour.id');
            break;
        case 'Cars in order':
            echo "Cars in order";
            $stmt = $pdo->query('SELECT * FROM `Cars in order`');
            break;
        case 'Order_status':
            $stmt = $pdo->query('SELECT os.id, s.status_name, os.order_id, os.date FROM Order_status os JOIN Status s ON os.status_id = s.id');
            break;

        default:
            echo 'No table selected';
            return;
    }

    $data = $stmt->fetchAll();

    if ($data) {
        echo '<table border="1">';
        echo '<tr>';

        // Print table headers
        foreach (array_keys($data[0]) as $header) {
            echo "<th>$header</th>";
        }

        echo '</tr>';

        // Print table data
        foreach ($data as $row) {
            echo '<tr>';
            $cnt = 0;
            foreach ($row as $cell) {
                if (($cnt == 3) && ($selectedTable == "Order")) {
                    echo "<td><a href='car_colour.php'>$cell</a></td>";
                } else {
                    echo "<td>$cell</td>";
                }
                $cnt++;
            }
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No data found';
    }
}

echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.8.0/slimselect.min.js" integrity="sha512-mG8eLOuzKowvifd2czChe3LabGrcIU8naD1b9FUVe4+gzvtyzSy+5AafrHR57rHB+msrHlWsFaEYtumxkC90rg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
';
echo '<script> new SlimSelect({select: "#add_name"});</script>';
echo '<script> new SlimSelect({select: "#add_surname"});</script>';
echo '<script> new SlimSelect({select: "#add_vin"});</script>';
echo '<script> new SlimSelect({select: "#add_price"});</script>';
echo '<script> new SlimSelect({select: "#add_status_name"});</script>';
echo '<script> new SlimSelect({select: "#add_date"});</script>';
echo '<script> new SlimSelect({select: "#add_order_id"});</script>';
echo '<script> new SlimSelect({select: "#add_brand_name"});</script>';
echo '<script> new SlimSelect({select: "#add_model"});</script>';
echo '<script> new SlimSelect({select: "#add_colour_name"});</script>';
echo '<script> new SlimSelect({select: "#add_price"});</script>';
?>

