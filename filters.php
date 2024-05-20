<?php
$conn = require("connection.php");

function get_filters($table_name)
{
    global $conn;
    echo "<form method='POST'>";
    if ($table_name == "Order") {
        $sql_name = "SELECT DISTINCT `name` FROM `Dealer` ORDER BY `name` DESC";
        $sql_surname = "SELECT DISTINCT `surname` FROM `Manager` ORDER BY `surname` DESC";
        $sql_vin = "SELECT DISTINCT `vin` FROM `Car_colour` ORDER BY `vin` DESC";
        $sql_price = "SELECT DISTINCT `price` FROM `Car_colour` ORDER BY `price` DESC";
        $sql_status = "SELECT DISTINCT `status_name` FROM `Status` ORDER BY `status_name` DESC";
        $sql_date = "SELECT DISTINCT `date` FROM `Order_status` ORDER BY `date` DESC";
        $sqls = ["name" => $sql_name, "surname" => $sql_surname, "vin" => $sql_vin, "price" => $sql_price, "status_name" => $sql_status, "date" => $sql_date];
        foreach (array_keys($sqls) as $key) {
            $sql = $sqls[$key];
            $response = $conn->query($sql);
            $response->execute();
            $values = $response->fetchAll(PDO::FETCH_COLUMN);
            echo "<div class='form-check-inline'>";
            $name = $key;
            $arr_name = $name . "[]";
            echo "<label for='$arr_name'>$name</label>";
            echo $name;
            echo "<select class='form-control' name='$arr_name' id='add_$name' style='min-width: 10%' multiple>";
            echo "<option value=''>-----</option>";
            foreach ($values as $value) {
                echo $value;
                echo "<option value='$value'>$value</option>";
            }
            echo "</select><br><br>";
            echo "</div>";

        }
        echo "<input type='hidden' name='table' value='$table_name'>";
        echo "<button class='filter' name='filter'>Отфильтровать</button>";
    }
    if ($table_name == "Car_colour") {
        $sql_brand = "SELECT DISTINCT `brand_name` FROM `Brand` ORDER BY `brand_name` DESC";
        $sql_model = "SELECT DISTINCT `model` FROM `Car` ORDER BY `model` DESC";
        $sql_colour = "SELECT DISTINCT `colour_name` FROM `Colour` ORDER BY `colour_name` DESC";
        $sql_vin = "SELECT DISTINCT `vin` FROM `Car_colour` ORDER BY `vin` DESC";
        $sql_price = "SELECT DISTINCT `price` FROM `Car_colour` ORDER BY `price` DESC";
        $sqls = ["brand_name" => $sql_brand, "model" => $sql_model, "colour_name" => $sql_colour, "vin" => $sql_vin, "price" => $sql_price];
        foreach (array_keys($sqls) as $key) {
            $sql = $sqls[$key];
            $response = $conn->query($sql);
            $response->execute();
            $values = $response->fetchAll(PDO::FETCH_COLUMN);
            echo "<div class='form-check-inline'>";
            $name = $key;
            $arr_name = $name . "[]";
            echo "<label for='$arr_name'>$name</label>";
            echo "<select class='form-control' name='$arr_name' id='add_$name' style='min-width: 10%' multiple>";
            echo "<option value=''>-----</option>";
            foreach ($values as $value) {
                echo $value;
                echo "<option value='$value'>$value</option>";
            }
            echo "</select><br><br>";
            echo "</div>";

        }
        echo "<input type='hidden' name='table' value='$table_name'>";
        echo "<button class='filter' name='filter'>Отфильтровать</button>";

    }

    if ($table_name == "Order_status") {
        $sql_status = "SELECT DISTINCT `status_name` FROM `Status` ORDER BY `status_name` DESC";
        $sql_order = "SELECT DISTINCT `id` FROM `Order` ORDER BY `id` DESC";
        $sql_date = "SELECT DISTINCT `date` FROM `Order_status` ORDER BY `date` DESC";
        $sqls = ["status_name" => $sql_status, "order" => $sql_order, "date" => $sql_date];
        foreach (array_keys($sqls) as $key) {
            $sql = $sqls[$key];
            $response = $conn->query($sql);
            $response->execute();
            $values = $response->fetchAll(PDO::FETCH_COLUMN);
            echo "<div class='form-check-inline'>";
            $name = $key;
            $arr_name = $name . "[]";
            echo "<label for='$arr_name'>$name</label>";
            echo "<select class='form-control' name='$arr_name' id='add_$name' style='min-width: 10%' multiple>";
            echo "<option value=''>-----</option>";
            foreach ($values as $value) {
                echo $value;
                echo "<option value='$value'>$value</option>";
            }
            echo "</select><br><br>";
            echo "</div>";

        }
        echo "<input type='hidden' name='table' value='$table_name'>";
        echo "<button class='filter' name='filter'>Отфильтровать</button>";

    }
    echo "</form>";

}