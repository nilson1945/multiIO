<?php
header("Location: controle.php?address=".$_GET['address']."&state=0");
exit;
//header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

$address = isset($_GET['address']) ? (int)$_GET['address'] : 0;
$time_1 = isset($_GET['time_1']) ? (int)$_GET['time_1'] : 0;

$url = "http://".MIO800_IP."/set_output?address={$address}&state=1";
if($time_1 > 0) $url .= "&time_1={$time_1}";

$context = stream_context_create([
    'http' => [
        'timeout' => TIMEOUT,
        'header' => "Authorization: Basic " . base64_encode(MIO800_USER.":".MIO800_PASS),
        'ignore_errors' => true // Força mostrar resposta mesmo com erro HTTP
    ]
]);

$response = @file_get_contents($url, false, $context);

if($response === false) {
    // PHP não conseguiu nem conectar no MIO800
    die(json_encode([
        'result' => 'error',
        'debug' => 'FALHA DE CONEXÃO',
        'motivo' => 'PHP não alcançou o MIO800',
        'url_tentada' => $url,
        'ip_no_config' => MIO800_IP,
        'dica' => 'Confere se o IP tá certo e se ping 192.168.0.100 responde'
    ]));
} else {
    // Mostra exatamente o que o MIO800 respondeu
    header('X-Debug-URL: '.$url);
    echo $response;
}
?>