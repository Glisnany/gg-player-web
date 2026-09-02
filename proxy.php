<?php

/*
 * ============================================================
 * GG PLAYER WEB - PROXY M3U
 * ============================================================
 *
 * Este arquivo serve somente para buscar a lista M3U
 * cadastrada no Firestore e entregá-la ao navegador.
 *
 * Aceita URL HTTP ou HTTPS.
 * Não altera a URL recebida.
 *
 * ============================================================
 */


/* ------------------------------------------------------------
   CORS
   ------------------------------------------------------------ */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");


/* ------------------------------------------------------------
   OPTIONS
   ------------------------------------------------------------ */

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}


/* ------------------------------------------------------------
   SOMENTE GET
   ------------------------------------------------------------ */

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    header("Content-Type: text/plain; charset=utf-8");
    echo "Método não permitido.";
    exit;
}


/* ------------------------------------------------------------
   URL
   ------------------------------------------------------------ */

if (!isset($_GET['url'])) {
    http_response_code(400);
    header("Content-Type: text/plain; charset=utf-8");
    echo "Parâmetro URL ausente.";
    exit;
}


$url = trim($_GET['url']);


/* ------------------------------------------------------------
   VALIDAR URL
   ------------------------------------------------------------ */

if ($url === '') {
    http_response_code(400);
    header("Content-Type: text/plain; charset=utf-8");
    echo "URL vazia.";
    exit;
}


/*
 * O GG Player trabalha com HTTP e HTTPS.
 */

if (!preg_match('/^https?:\/\/.+/i', $url)) {
    http_response_code(400);
    header("Content-Type: text/plain; charset=utf-8");
    echo "Somente URLs HTTP ou HTTPS são permitidas.";
    exit;
}


/* ------------------------------------------------------------
   CURL
   ------------------------------------------------------------ */

$ch = curl_init();


curl_setopt_array(
    $ch,
    [

        CURLOPT_URL =>
            $url,

        CURLOPT_RETURNTRANSFER =>
            true,

        CURLOPT_FOLLOWLOCATION =>
            true,

        CURLOPT_MAXREDIRS =>
            10,

        CURLOPT_CONNECTTIMEOUT =>
            15,

        CURLOPT_TIMEOUT =>
            60,

        /*
         * Algumas listas ficam comprimidas.
         */
        CURLOPT_ENCODING =>
            "",

        /*
         * User-Agent mais semelhante
         * a um navegador real.
         */
        CURLOPT_USERAGENT =>
            "Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Version/17.0 Mobile/15E148 Safari/604.1",

        /*
         * Aceitar M3U/texto.
         */
        CURLOPT_HTTPHEADER =>
            [
                "Accept: audio/x-mpegurl, application/x-mpegURL, text/plain, */*",
                "Connection: close"
            ],

        /*
         * Alguns servidores antigos de IPTV
         * apresentam certificado problemático.
         *
         * Mantido compatível com a versão anterior.
         */
        CURLOPT_SSL_VERIFYPEER =>
            false,

        CURLOPT_SSL_VERIFYHOST =>
            false,

    ]
);


/* ------------------------------------------------------------
   EXECUTAR
   ------------------------------------------------------------ */

$content =
    curl_exec($ch);


$curlError =
    curl_error($ch);


$curlErrorNumber =
    curl_errno($ch);


$httpCode =
    curl_getinfo(
        $ch,
        CURLINFO_HTTP_CODE
    );


$contentType =
    curl_getinfo(
        $ch,
        CURLINFO_CONTENT_TYPE
    );


curl_close($ch);


/* ------------------------------------------------------------
   ERRO CURL
   ------------------------------------------------------------ */

if ($content === false) {

    http_response_code(502);

    header(
        "Content-Type: text/plain; charset=utf-8"
    );

    echo
        "Falha ao baixar a lista M3U." .
        "\nCódigo cURL: " .
        $curlErrorNumber .
        "\nErro: " .
        $curlError;

    exit;
}


/* ------------------------------------------------------------
   ERRO HTTP
   ------------------------------------------------------------ */

if (
    $httpCode < 200 ||
    $httpCode >= 400
) {

    http_response_code(502);

    header(
        "Content-Type: text/plain; charset=utf-8"
    );

    echo
        "Servidor da lista retornou HTTP " .
        $httpCode;

    exit;
}


/* ------------------------------------------------------------
   LISTA VAZIA
   ------------------------------------------------------------ */

if (
    trim($content) === ''
) {

    http_response_code(502);

    header(
        "Content-Type: text/plain; charset=utf-8"
    );

    echo "O servidor retornou uma lista vazia.";

    exit;
}


/* ------------------------------------------------------------
   UTF-8
   ------------------------------------------------------------ */

/*
 * Não usamos mb_detect_encoding() obrigatoriamente,
 * pois alguns servidores PHP não têm mbstring habilitado.
 *
 * Isso evita um possível erro fatal no proxy.
 */

if (
    function_exists('mb_convert_encoding')
) {

    $content =
        mb_convert_encoding(
            $content,
            'UTF-8',
            'UTF-8, ISO-8859-1, Windows-1252'
        );

} else {

    /*
     * Remove BOM caso exista.
     */
    $content =
        preg_replace(
            '/^\xEF\xBB\xBF/',
            '',
            $content
        );
}


/* ------------------------------------------------------------
   CABEÇALHOS DE RESPOSTA
   ------------------------------------------------------------ */

header(
    "Content-Type: audio/x-mpegurl; charset=utf-8"
);

header(
    "Content-Length: " .
    strlen($content)
);


/* ------------------------------------------------------------
   ENTREGAR M3U
   ------------------------------------------------------------ */

echo $content;

exit;

?>
