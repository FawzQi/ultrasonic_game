<?php
// Aktifkan pesan error
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
require 'db.php';

if (!$conn) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi database gagal"]);
    exit;
}

// Ambil 5 user dengan point tertinggi
$top5 = $conn->query("SELECT name, point FROM users ORDER BY point DESC LIMIT 5");
$top5Data = [];
if ($top5) {
    while ($row = $top5->fetch_assoc()) {
        $top5Data[] = $row;
    }
} else {
    echo json_encode(["error" => "Query top5 gagal: " . $conn->error]);
    exit;
}

// Ambil jumlah user tiap point
$grouped = $conn->query("SELECT point, COUNT(*) as count FROM users GROUP BY point ORDER BY point");
$pointGroups = [];
if ($grouped) {
    while ($row = $grouped->fetch_assoc()) {
        $pointGroups[] = $row;
    }
} else {
    echo json_encode(["error" => "Query point_groups gagal: " . $conn->error]);
    exit;
}

// Beri header JSON
header('Content-Type: application/json');
echo json_encode([
    "top5" => $top5Data,
    "point_groups" => $pointGroups
]);
?>
