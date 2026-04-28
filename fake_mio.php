<?php
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    "result" => "ok",
    "address" => $_GET['address'] ?? null,
    "state" => $_GET['state'] ?? null,
    "time_1" => $_GET['time_1'] ?? null
]);