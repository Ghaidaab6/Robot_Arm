<?php
require "db.php";

$sql = "UPDATE run SET status = 0 WHERE status = 1";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
?>
