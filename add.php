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

