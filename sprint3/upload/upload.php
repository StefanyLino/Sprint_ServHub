<?php

function atualizarFuncionarioJson($fileName, $filePath, $emailUsuario) {
    $dataFile = __DIR__ . '/../data/data_funcionario.json';
    if (!file_exists($dataFile)) return;

    $funcionarios = json_decode(file_get_contents($dataFile), true);

    foreach ($funcionarios as &$funcionario) {
        if ($funcionario['email'] === $emailUsuario) {
            $funcionario['filename'] = $fileName;
            $funcionario['path'] = $filePath;
            $funcionario['uploaded_at'] = date('Y-m-d H:i:s');
            break;
        }
    }

    file_put_contents($dataFile, json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Verifica se um e-mail foi enviado
$emailUsuario = $_POST['email'] ?? null;
if (!$emailUsuario) {
    echo "E-mail do usuário não fornecido.";
    exit;
}

// Upload de imagem
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imagemNome = uniqid('img_', true) . '.' . $ext;
    $uploadDir = __DIR__ . '/../public/uploads/';
    $webPath = 'uploads/' . $imagemNome;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp = $_FILES['image']['tmp_name'];
    $filePath = $uploadDir . $imagemNome;

    if (move_uploaded_file($fileTmp, $filePath)) {
        $imageData = [
            'filename' => $imagemNome,
            'path' => $webPath,
            'uploaded_at' => date('Y-m-d H:i:s')
        ];

        $jsonFile = __DIR__ . '/../data/imagens.json';
        $existingData = [];

        if (file_exists($jsonFile)) {
            $jsonContent = file_get_contents($jsonFile);
            $existingData = json_decode($jsonContent, true) ?? [];
        }

        $existingData[] = $imageData;
        file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Atualiza também no data_funcionario.json
        atualizarFuncionarioJson($imagemNome, $webPath, $emailUsuario);

        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao mover o arquivo da imagem.";
    }
} elseif (isset($_FILES['image'])) {
    echo "Erro ao processar o arquivo da imagem.";
}

?>

<script>
    setTimeout(() => {
        window.location.href = "../public/exibicaoaccount.php";
    }, 0);
</script>
