<?php
// Caminho da pasta onde os currículos estão armazenados
$baseDir = __DIR__ . '/uploads2/';

// Verifica se foi passado um nome de arquivo
if (!isset($_GET['arquivo'])) {
    die('Arquivo não especificado.');
}

// Evita diretórios relativos no nome do arquivo
$arquivo = basename($_GET['arquivo']);
$caminhoCompleto = $baseDir . $arquivo;

// Verifica se o arquivo existe
if (!file_exists($caminhoCompleto)) {
    die('Arquivo não encontrado.');
}

// Força o download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $arquivo . '"');
header('Content-Length: ' . filesize($caminhoCompleto));
readfile($caminhoCompleto);
exit;
?>
