<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $sql = "SELECT * FROM passenger WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['passenger_id'] = $row['id'];      // passenger ID
            $_SESSION['passenger_name'] = $row['name'];  // passenger name

            // Redirect to dashboard
            header("Location: passengerDashboard.php");
            exit();
        } else {
            echo "<p style='color:red;'>Invalid password!</p>";
        }
    } else {
        echo "<p style='color:red;'>Passenger not found! <a href='register.php'>Register here</a></p>";
    }
}
?>
