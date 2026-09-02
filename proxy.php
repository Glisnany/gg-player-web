<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Content-Type: text/plain; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if (!isset($_GET['url'])) {
    http_response_code(400);
    echo "ERRO: parâmetro url ausente.";
    exit;
}

$url = trim($_GET['url']);

if ($url === '') {
    http_response_code(400);
    echo "ERRO: URL vazia.";
    exit;
}

if (!preg_match('/^https?:\/\/.+/i', $url)) {
    http_response_code(400);
    echo "ERRO: somente HTTP e HTTPS são permitidos.";
    exit;
}

$ch = curl_init();

curl_setopt_array($ch, [

    CURLOPT_URL => $url,

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_FOLLOWLOCATION => true,

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_CONNECTTIMEOUT => 20,

    CURLOPT_TIMEOUT => 90,

    CURLOPT_ENCODING => "",

    CURLOPT_USERAGENT =>
        "Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1",

    CURLOPT_HTTPHEADER => [
        "Accept: audio/x-mpegurl, application/x-mpegURL, text/plain, */*",
        "Connection: close"
    ],

    CURLOPT_SSL_VERIFYPEER => false,

    CURLOPT_SSL_VERIFYHOST => false,

]);

$content = curl_exec($ch);

$curlError = curl_error($ch);
$curlErrno = curl_errno($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$redirectCount = curl_getinfo($ch, CURLINFO_REDIRECT_COUNT);

curl_close($ch);


/*
 * Falha de conexão / cURL
 */
if ($content === false) {

    http_response_code(502);

    echo "===== ERRO CURL =====\n";
    echo "Código: " . $curlErrno . "\n";
    echo "Mensagem: " . $curlError . "\n";
    echo "URL: " . $url . "\n";

    exit;
}


/*
 * Mostra informações recebidas.
 * Isso será útil somente para diagnóstico.
 */
echo "===== DIAGNÓSTICO PROXY =====\n";
echo "HTTP: " . $httpCode . "\n";
echo "Content-Type: " . ($contentType ?: "não informado") . "\n";
echo "Redirecionamentos: " . $redirectCount . "\n";
echo "URL final: " . ($finalUrl ?: "não informado") . "\n";
echo "Tamanho recebido: " . strlen($content) . " bytes\n";
echo "==============================\n\n";


/*
 * Mostra o começo da resposta.
 *
 * Se for uma M3U, deveremos enxergar algo como:
 *
 * #EXTM3U
 * #EXTINF:...
 * http://...
 *
 * Se vier HTML ou mensagem de erro,
 * vamos enxergar aqui também.
 */
$previewLength = 5000;

$preview = substr(
    $content,
    0,
    $previewLength
);

echo $preview;

?>
