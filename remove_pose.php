<?php
require "db.php";

$id = intval($_GET["id"]);
$conn->query("DELETE FROM pose WHERE id = $id");

echo json_encode(["success" => true]);
?>
