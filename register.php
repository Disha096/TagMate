<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm = $_POST['confirm'];

    if ($_POST['password'] !== $confirm) {
        echo "Passwords do not match!";
    } else {
        $sql = "INSERT INTO passenger (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='passenger_login.html'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
