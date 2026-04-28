<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

$address = isset($_GET['address']) ? (int)$_GET['address'] : 0;
$state   = isset($_GET['state']) ? (int)$_GET['state'] : 0;
$time_1  = isset($_GET['time_1']) ? (int)$_GET['time_1'] : 0;

$url = "http://localhost/MULTIIO/fake_mio.php?address={$address}&state={$state}";

if($time_1 > 0){
    $url .= "&time_1={$time_1}";
}

$response = @file_get_contents($url);

if($response === false){
    echo json_encode([
        "result" => "error",
        "debug" => "FALHA DE CONEXÃO",
        "url" => $url
    ]);
} else {
    echo $response;
}