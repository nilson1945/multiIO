<?php
header("Location: controle.php?address=".$_GET['address']."&state=0");
exit;
//header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

$address = isset($_GET['address']) ? (int)$_GET['address'] : 0;

$url = "http://".MIO800_IP."/set_output?address={$address}&state=0"; // state=0 desliga

$context = stream_context_create([
    'http' => [
        'timeout' => TIMEOUT,
        'header' => "Authorization: Basic " . base64_encode(MIO800_USER.":".MIO800_PASS),
        'ignore_errors' => true
    ]
]);

$response = @file_get_contents($url, false, $context);
echo $response ?: json_encode(['result'=>'error','debug'=>'FALHA DE CONEXÃO']);
?>