<?php
session_start();
$conn = new mysqli(
    "coffee-db.clsem222cqno.ap-south-1.rds.amazonaws.com",
    "admin",
    "rashi030504",
    "coffee"
);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {

            $_SESSION['user'] = $username;
            $_SESSION['role'] = $row['role'];

            header("Location: index.php");
        } else {
            echo "Wrong Password";
        }
    } else {
        echo "User not found";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>