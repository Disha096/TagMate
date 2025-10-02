<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "tagmate");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['staffEmail'];
    $password = $_POST['staffPassword'];

    $stmt = $conn->prepare("SELECT * FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){
        if($password === $row['password']){ // later use password_hash()
            $_SESSION['staff_id'] = $row['id'];
            $_SESSION['staff_name'] = $row['name'];

            header("Location: staffDashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password'); window.location='staff_login.html';</script>";
        }
    } else {
        echo "<script>alert('Staff not found'); window.location='staff_login.html';</script>";
    }
}
?>
