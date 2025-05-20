

<?php
// Verifica se um arquivo foi enviado
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/'; // Pasta onde a imagem será salva
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Cria a pasta se não existir
    }

    $fileTmp = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $filePath = $uploadDir . $fileName;

    // Move o arquivo para a pasta
    if (move_uploaded_file($fileTmp, $filePath)) {
        // Dados a serem salvos no JSON
        $imageData = [
            'filename' => $fileName,
            'path' => $filePath,
            'uploaded_at' => date('Y-m-d H:i:s')
        ];

        $jsonFile = 'imagens.json';
        $existingData = [];

        // Lê os dados existentes, se houver
        if (file_exists($jsonFile)) {
            $jsonContent = file_get_contents($jsonFile);
            $existingData = json_decode($jsonContent, true) ?? [];
        }

        // Adiciona a nova imagem
        $existingData[] = $imageData;

        // Salva novamente no JSON
        file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));

        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao mover o arquivo.";
    }
} else {
    echo "Nenhum arquivo foi enviado.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="image">Selecione uma imagem:</label>
    <input type="file" name="image" id="image" accept="image/*" required>
    <input type="submit" value="Enviar">
</form>
</body>
</html>