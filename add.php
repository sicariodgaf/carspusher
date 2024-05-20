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
<form>
    <div class="row">
        <input type="button" value="Brand" style="color: #333;" onclick="location.href='brand.php';" />
        <input type="button" value="Car" style="color: #333;" onclick="location.href='car.php';" />
        <input type="button" value="Colour" style="color: #333;" onclick="location.href='colour.php';" />
        <input type="button" value="Car_colour" style="color: #333;" onclick="location.href='car_colour.php';" />
        <input type="button" value="Cars in order" style="color: #333;" onclick="location.href='carsinorder.php';" />
    </div>
    <div class="row">
        <input type="button" value="Order" style="color: #333;" onclick="location.href='order.php';" />
        <input type="button" value="Dealer" style="color: #333;" onclick="location.href='dealer.php';" />
        <input type="button" value="Manager" style="color: #333;" onclick="location.href='manager.php';" />
        <input type="button" value="Status" style="color: #333;" onclick="location.href='status.php';" />
        <input type="button" value="Order_status" style="color: #333;" onclick="location.href='order_status.php';" />
    </div>
</form>
</body>
</html>

