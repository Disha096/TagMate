<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    echo json_encode(["status" => "error", "msg" => "Not logged in"]);
    exit();
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$bag_id = "BG" . rand(100, 999);
$flight_number = $data['flight_number'];
$departure_date = $data['departure_date'];
$from_airport = $data['from_airport'];
$to_airport = $data['to_airport'];
$baggage_type = $data['baggage_type'];
$weight = $data['weight'];
$description = $data['description'];
$status = "Registered";
$location = $from_airport;

$stmt = $conn->prepare("INSERT INTO baggage (bag_id, flight_number, departure_date, from_airport, to_airport, baggage_type, weight, description, status, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssdsss", $bag_id, $flight_number, $departure_date, $from_airport, $to_airport, $baggage_type, $weight, $description, $status, $location);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "bag_id" => $bag_id]);
} else {
    echo json_encode(["status" => "error", "msg" => $stmt->error]);
}
?>
