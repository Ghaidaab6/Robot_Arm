<?php
require "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "No pose data provided"]);
    exit;
}

// Check if run table already has a row
$result = $conn->query("SELECT COUNT(*) as cnt FROM run");
$row = $result->fetch_assoc();

if ($row["cnt"] == 0) {
    // Insert first record
    $sql = "INSERT INTO run (motor1, motor2, motor3, motor4, motor5, motor6, status) 
            VALUES (?, ?, ?, ?, ?, ?, 1)";
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
} else {
    // Update the single row
    $sql = "UPDATE run 
            SET motor1=?, motor2=?, motor3=?, motor4=?, motor5=?, motor6=?, status=1";
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
}

echo json_encode(["success" => true, "message" => "Run pose updated"]);
?>
