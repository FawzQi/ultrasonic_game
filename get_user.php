<?php
include 'db.php';
$user_id = $_GET['user_id'];
$data = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
echo json_encode($data);
?>
