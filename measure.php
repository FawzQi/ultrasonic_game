<?php
include 'db.php';
$user_id = $_POST['user_id'];
$result = $_POST['result'];
$target = $_POST['target'];

$conn->query("INSERT INTO measurements (user_id, result, target) VALUES ($user_id, $result, $target)");

$user = $conn->query("SELECT point, life FROM users WHERE id = $user_id")->fetch_assoc();

if ($result == $target) {
  $conn->query("UPDATE users SET point = point + 1 WHERE id = $user_id");
} else {
  $conn->query("UPDATE users SET life = life - 1 WHERE id = $user_id");
}
?>
