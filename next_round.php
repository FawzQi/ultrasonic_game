<?php
require 'db.php';

// Ambil user aktif
$user = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->fetch_assoc();

if ($user && $user['life'] <= 0) {
    // Reset ke "start"
    $conn->query("UPDATE users SET status='start' WHERE id=" . $user['id']);
} else {
    // Random target baru dan lanjut bermain
    $newTarget = rand(10, 100);
    $conn->query("UPDATE users SET status='playing', target=$newTarget WHERE id=" . $user['id']);
}

// Tandai semua is_read agar true (jaga-jaga)
$conn->query("UPDATE measurements SET is_read = TRUE WHERE is_read = FALSE");

echo json_encode(['success' => true]);
?>
