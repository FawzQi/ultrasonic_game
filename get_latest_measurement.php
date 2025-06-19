<?php
include 'db.php';
$user_id = $_GET['user_id'];

$res = $conn->query("SELECT * FROM measurements 
                     WHERE user_id = $user_id AND is_read = 0 
                     ORDER BY timestamp DESC LIMIT 1");

if ($row = $res->fetch_assoc()) {
  // Tandai sudah dibaca
  $conn->query("UPDATE measurements SET is_read = 1 WHERE id = " . $row['id']);
  echo json_encode([
    "result" => $row["result"],
    "target" => $row["target"]
  ]);
} else {
  echo json_encode([
    "result" => null,
    "target" => null
  ]);
}       
?>
