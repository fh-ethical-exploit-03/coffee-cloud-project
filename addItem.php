<?php
session_start();

// 🔐 CHECK ROLE
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access Denied");
}

$conn = new mysqli("localhost", "atharv", "atharv09", "coffees");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["coffeeName"];
    $price = $_POST["price"];
    $discount_price = $_POST["discountedPrice"];

    // 🔐 Secure image upload
    $image = basename($_FILES["image"]["name"]);
    $target_dir = "uploads/";
    $target_file = $target_dir . $image;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // 🔐 Prevent SQL Injection
    $sql = "INSERT INTO COFFEE (name, image, price, discount_price) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdd", $name, $image, $price, $discount_price);

    $stmt->execute();

    header("Location: index.php");
}
?>