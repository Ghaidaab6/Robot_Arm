
<?php
require "db.php";

$sql = "SELECT * FROM run LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo "{status:" . $row["status"] .
         ", m1:" . $row["motor1"] .
         ", m2:" . $row["motor2"] .
         ", m3:" . $row["motor3"] .
         ", m4:" . $row["motor4"] .
         ", m5:" . $row["motor5"] .
         ", m6:" . $row["motor6"] . "}";
} else {
    echo "{  }";
}
?>
