<?php
$conn = new mysqli(
    "coffee-db.clsem222cqno.ap-south-1.rds.amazonaws.com",
    "admin",
    "rashi030504",
    "coffee"
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user";

    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);

    $stmt->execute();

    echo "User Registered Successfully";
}
?>