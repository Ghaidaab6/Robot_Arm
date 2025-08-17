<?php
require "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$sql = "INSERT INTO pose (motor1, motor2, motor3, motor4, motor5, motor6) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiii", 
    $data["motor1"], 
    $data["motor2"], 
    $data["motor3"], 
    $data["motor4"], 
    $data["motor5"], 
    $data["motor6"]
);
$stmt->execute();

echo json_encode(["success" => true, "id" => $stmt->insert_id]);
?>
