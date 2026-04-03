<?php
// $loginDetails = require 'login.php';
$servername = "localhost";
$username = "atharv";
$password = "atharv09";
$dbname = "coffees";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["coffeeName"];
    $image = $_FILES["image"]['name'];
    $price = $_POST["price"];
    $discount_price = $_POST["discountedPrice"];

    // Upload image to server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO COFFEE (name, image, price, discount_price) VALUES ('$name', '$image', '$price', '$discount_price')";

    if ($conn->query($sql) === true) {
        echo "<script>
        window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        window.location.href = 'index.php';
        </script>";
    }
}

$conn->close();
?>