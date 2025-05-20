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
} elseif (isset($_FILES['image'])) {
    echo "Erro ao mover o arquivo.";
}

// Arquivos curriculo
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads2/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp = $_FILES['file']['tmp_name'];
    $fileName = basename($_FILES['file']['name']);
    $filePath = $uploadDir . $fileName;

    // Verifica o tipo do arquivo (imagem ou PDF)
    $fileType = mime_content_type($fileTmp);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];

    if (!in_array($fileType, $allowedTypes)) {
        echo "Tipo de arquivo não permitido.";
        exit;
    }

    if (move_uploaded_file($fileTmp, $filePath)) {
        $fileData = [
            'filename' => $fileName,
            'path' => $filePath,
            'type' => $fileType,
            'uploaded_at' => date('Y-m-d H:i:s')
        ];

        $jsonFile = 'arquivos.json';
        $existingData = [];

        if (file_exists($jsonFile)) {
            $jsonContent = file_get_contents($jsonFile);
            $existingData = json_decode($jsonContent, true) ?? [];
        }

        $existingData[] = $fileData;
        file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));

        echo "Arquivo enviado com sucesso!";
    } else {
        echo "Erro ao mover o arquivo.";
    }
} elseif (isset($_FILES['file'])) {
    echo "Nenhum arquivo foi enviado.";
}
?>

<script>
    setTimeout(() => {
      window.location.href = "../public/accountpage.php"; 
    }, 0); 
</script>