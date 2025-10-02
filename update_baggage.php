<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    echo json_encode(["status" => "error", "msg" => "Not logged in"]);
    exit();
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$bag_id = $data['bag_id'];
$status = $data['status'];
$location = $data['location'];

$stmt = $conn->prepare("UPDATE baggage SET status=?, location=? WHERE bag_id=?");
$stmt->bind_param("sss", $status, $location, $bag_id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "msg" => $stmt->error]);
}
?>
