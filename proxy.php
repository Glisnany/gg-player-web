<?php

/*
 * GG PLAYER WEB
 * Proxy simples para baixar a playlist M3U.
 *
 * Aceita:
 * http://
 * https://
 *
 * Não modifica as URLs existentes dentro da M3U.
 */


/* ---------------------------------------------------------
   ERROS TEMPORÁRIOS PARA DIAGNÓSTICO
   --------------------------------------------------------- */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


/* ---------------------------------------------------------
   CORS
   --------------------------------------------------------- */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');


/* ---------------------------------------------------------
   OPTIONS
   --------------------------------------------------------- */

if (
    isset($_SERVER['REQUEST_METHOD']) &&
    $_SERVER['REQUEST_METHOD'] === 'OPTIONS'
) {
    http_response_code(204);
    exit;
}


/* ---------------------------------------------------------
   URL
   --------------------------------------------------------- */

if (!isset($_GET['url'])) {

    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');

    echo 'ERRO: parâmetro url não informado.';

    exit;
}


$url = trim($_GET['url']);


/* ---------------------------------------------------------
   VALIDAR URL
   --------------------------------------------------------- */

if ($url === '') {

    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');

    echo 'ERRO: URL vazia.';

    exit;
}


if (!preg_match('/^https?:\/\/.+/i', $url)) {

    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');

    echo 'ERRO: somente URLs HTTP e HTTPS são permitidas.';

    exit;
}


/* ---------------------------------------------------------
   TENTATIVA 1: CURL
   --------------------------------------------------------- */

$content = false;
$httpCode = 0;
$curlError = '';


if (function_exists('curl_init')) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);

    curl_setopt(
        $ch,
        CURLOPT_USERAGENT,
        'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Version/17.0 Mobile/15E148 Safari/604.1'
    );

    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Accept: audio/x-mpegurl, application/x-mpegURL, text/plain, */*'
        )
    );

    /*
     * Alguns servidores IPTV possuem certificados
     * problemáticos.
     */
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    /*
     * Aceitar gzip/deflate.
     */
    curl_setopt($ch, CURLOPT_ENCODING, '');

    $content = curl_exec($ch);

    $httpCode = (int) curl_getinfo(
        $ch,
        CURLINFO_HTTP_CODE
    );

    $curlError = curl_error($ch);

    curl_close($ch);
}


/* ---------------------------------------------------------
   TENTATIVA 2: file_get_contents
   --------------------------------------------------------- */

if (
    $content === false &&
    function_exists('file_get_contents')
) {

    $context = stream_context_create(
        array(
            'http' => array(
                'method' => 'GET',

                'timeout' => 90,

                'ignore_errors' => true,

                'header' =>
                    "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Version/17.0 Mobile/15E148 Safari/604.1\r\n" .
                    "Accept: audio/x-mpegurl, application/x-mpegURL, text/plain, */*\r\n"
            ),

            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false
            )
        )
    );


    $content =
        @file_get_contents(
            $url,
            false,
            $context
        );


    /*
     * Tenta descobrir o HTTP retornado.
     */
    if (
        isset($http_response_header) &&
        is_array($http_response_header)
    ) {

        foreach (
            $http_response_header
            as $headerLine
        ) {

            if (
                preg_match(
                    '/HTTP\/[\d.]+\s+(\d+)/i',
                    $headerLine,
                    $matches
                )
            ) {

                $httpCode =
                    (int) $matches[1];

                break;
            }
        }
    }
}


/* ---------------------------------------------------------
   FALHA TOTAL
   --------------------------------------------------------- */

if ($content === false) {

    http_response_code(502);

    header('Content-Type: text/plain; charset=utf-8');

    echo "ERRO AO BAIXAR A LISTA\n\n";

    echo "URL recebida:\n";
    echo $url . "\n\n";

    echo "HTTP retornado:\n";
    echo $httpCode . "\n\n";

    if ($curlError !== '') {

        echo "Erro CURL:\n";
        echo $curlError . "\n\n";
    }

    if (!function_exists('curl_init')) {

        echo "ATENÇÃO: extensão CURL não está disponível no PHP.\n";
    }

    exit;
}


/* ---------------------------------------------------------
   RESPOSTA HTTP INESPERADA
   --------------------------------------------------------- */

if (
    $httpCode > 0 &&
    (
        $httpCode < 200 ||
        $httpCode >= 400
    )
) {

    http_response_code(502);

    header('Content-Type: text/plain; charset=utf-8');

    echo "O servidor da playlist respondeu com HTTP ";
    echo $httpCode;
    echo "\n\n";

    /*
     * Mostramos apenas os primeiros caracteres
     * para diagnóstico.
     */
    echo substr(
        (string) $content,
        0,
        3000
    );

    exit;
}


/* ---------------------------------------------------------
   LISTA VAZIA
   --------------------------------------------------------- */

if (
    trim((string) $content) === ''
) {

    http_response_code(502);

    header('Content-Type: text/plain; charset=utf-8');

    echo 'O servidor respondeu, mas a lista está vazia.';

    exit;
}


/* ---------------------------------------------------------
   REMOVER BOM
   --------------------------------------------------------- */

$content =
    preg_replace(
        '/^\xEF\xBB\xBF/',
        '',
        (string) $content
    );


/* ---------------------------------------------------------
   ENTREGAR M3U
   --------------------------------------------------------- */

header(
    'Content-Type: audio/x-mpegurl; charset=utf-8'
);

echo $content;

exit;

?>
