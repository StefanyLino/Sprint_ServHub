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

// Upload de currículo
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $allowedExts = ['pdf', 'png', 'jpg', 'jpeg']; // você pode adaptar se quiser só PDF
    if (!in_array(strtolower($ext), $allowedExts)) {
        echo "Formato de arquivo inválido. Envie um PDF ou imagem.";
        exit;
    }

    $curriculoNome = uniqid('cv_', true) . '.' . $ext;
    $uploadDir = __DIR__ . '/../public/uploads2/';
    $webPath = 'uploads2/' . $curriculoNome;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp = $_FILES['file']['tmp_name'];
    $filePath = $uploadDir . $curriculoNome;

    if (move_uploaded_file($fileTmp, $filePath)) {
        // Atualiza no data_funcionario.json
        $dataFile = __DIR__ . '/../data/data_funcionario.json';
        if (file_exists($dataFile)) {
            $funcionarios = json_decode(file_get_contents($dataFile), true);
            foreach ($funcionarios as &$funcionario) {
                if ($funcionario['email'] === $emailUsuario) {
                    $funcionario['filename_curriculo'] = $curriculoNome;
                    $funcionario['path_curriculo'] = $webPath;
                    $funcionario['curriculo_uploaded_at'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            file_put_contents($dataFile, json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        echo "Currículo enviado com sucesso!";
    } else {
        echo "Erro ao mover o arquivo do currículo.";
    }
} elseif (isset($_FILES['file'])) {
    echo "Erro ao processar o arquivo do currículo.";
}

?>

<script>
    setTimeout(() => {
        window.location.href = "../public/exibicaoaccount.php";
    }, 0);
</script>
