<?php
require 'db.php';

if (isset($_POST['username'])) {
    $name = $_POST['username'];
    $target = rand(10, 100); // target awal langsung dirandom antara 10–100 cm

    $conn->query("INSERT INTO users (name, target, life, point, status) VALUES ('$name', $target, 3, 0, 'playing')");
    echo json_encode(['success' => true]);
}
?>
    