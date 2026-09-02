<?php
// Libera o CORS para qualquer navegador (incluindo Safari do iOS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    
    // Baixa o conteúdo do servidor M3U pelo servidor PHP (sem bloqueio de CORS)
    $content = @file_get_contents($url);
    
    if ($content !== false) {
        echo $content;
    } else {
        http_response_code(500);
        echo "Erro ao carregar a lista M3U.";
    }
}
?>