<?php
$host = "localhost";   // usually localhost
$user = "root";        // your MySQL username
$pass = "";            // your MySQL password (set if you created one)
$dbname = "tagmate";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
