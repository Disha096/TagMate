<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM passenger WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['passenger'] = $row['name'];
            header("Location: passenger_dashboard.php");
            exit();
        } else {
            echo "Invalid Password!";
        }
    } else {
        echo "Passenger not found! <a href='register.php'>Register here</a>";
    }
}
?>
