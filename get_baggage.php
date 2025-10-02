<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['staff_id'])) {
    echo json_encode([]);
    exit();
}

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "tagmate";  // your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode([]);
    exit();
}

$sql = "SELECT bag_id, flight_number, status, location, from_airport FROM baggage ORDER BY id DESC";
$result = $conn->query($sql);

$bags = [];
if($result){
    while($row = $result->fetch_assoc()){
        $bags[] = $row;
    }
}

echo json_encode($bags);
$conn->close();
?>
