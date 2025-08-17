<?php
require "db.php";

$result = $conn->query("SELECT * FROM pose ORDER BY id ASC");
$poses = [];
while($row = $result->fetch_assoc()) {
    $poses[] = $row;
}
echo json_encode($poses);
?>
