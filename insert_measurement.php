<?php
$conn = new mysqli("localhost", "root", "", "ultrasonic_game");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $result = $_POST["result"];

  $stmt = $conn->prepare("INSERT INTO measurements (result, is_read) VALUES (?, 0)");
  $stmt->bind_param("i", $result);
  $stmt->execute();

  echo "OK";
}
?>
