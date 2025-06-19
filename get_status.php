<?php
require 'db.php';

$user = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->fetch_assoc();
$response = [];

if (!$user || $user['status'] === 'start') {
    $response['status'] = 'start';
} else {
    $response = [
        'id' => $user['id'],
        'name' => $user['name'],
        'life' => $user['life'],
        'point' => $user['point'],
        'target' => $user['target'],
        'status' => $user['status'],
    ];

    if ($user['status'] === 'playing') {
        $m = $conn->query("SELECT * FROM measurements WHERE is_read = FALSE ORDER BY timestamp DESC LIMIT 1")->fetch_assoc();
        if ($m) {
            $result = $m['result'];
            $target = $user['target'];
            $response['result'] = $result;

            if (abs($result - $target) <= 5) {
                $user['point']++;
                $message = "Benar!";
            } else {
                $user['life']--;
                $message = "Salah!";
            }

            if ($user['life'] <= 0) {
                $message = "Game Over!";
            }

            // Simpan hasil ke kolom tambahan
            $conn->query("UPDATE users SET point = {$user['point']}, life = {$user['life']}, status = 'result', last_result = {$result}, last_message = '{$message}' WHERE id = {$user['id']}");
            $conn->query("UPDATE measurements SET is_read = TRUE WHERE id = {$m['id']}");

            $response['life'] = $user['life'];
            $response['point'] = $user['point'];
            $response['status'] = 'result';
            $response['message'] = $message;
        }
    } elseif ($user['status'] === 'result') {
        // Abaikan data baru dan tampilkan hasil terakhir
        $conn->query("UPDATE measurements SET is_read = TRUE WHERE is_read = FALSE");
        $response['result'] = $user['last_result'];
        $response['message'] = $user['last_message'];
    }
}

echo json_encode($response);
?>
