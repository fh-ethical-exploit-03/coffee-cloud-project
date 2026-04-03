<?php
$servername = "localhost";
$username = "atharv";
$password = "atharv09";
$dbname = "coffees";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "CREATE DATABASE coffees";
// COFFEE TABLE

// $sql = "CREATE TABLE COFFEE (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
//     name VARCHAR(30) NOT NULL,
//     image VARCHAR(100) NOT NULL,
//     price FLOAT NOT NULL,
//     discount_price FLOAT NOT NULL
//     )";
    
// $sql = "DROP TABLE ORDERS";

// echo "Hello world";

$sql = "CREATE TABLE ORDERS (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(10) NOT NULL,
    payment VARCHAR(20) NOT NULL,
    items VARCHAR(1000) NOT NULL,
    total_cart_value VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === true) {
    echo "Query executed successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>