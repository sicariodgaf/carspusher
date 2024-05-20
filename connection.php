<?php
try {
    $conn = new PDO('mysql:dbname=f0940058_carspusher;host=localhost', 'f0940058_carspusher', 'admin123');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>