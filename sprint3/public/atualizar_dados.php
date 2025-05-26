<?php
require_once __DIR__ . '/../services/Auth.php';
use Services\Auth;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = Auth::getUsuario();
    $isAdmin = Auth::isAdmin();

    $usuarioJsonPath = __DIR__ . '/../data/usuario.json';
    $funcionarioJsonPath = __DIR__ . '/../data/data_funcionario.json';

    $usuarios = json_decode(file_get_contents($usuarioJsonPath), true);
    $funcionarios = json_decode(file_get_contents($funcionarioJsonPath), true);

    if ($isAdmin) {
        foreach ($usuarios as &$user) {
            if ($user['username'] === $usuario['username']) {
                $user['username'] = $_POST['email'];
                $user['nome'] = $_POST['nome'];
                break;
            }
        }
        file_put_contents($usuarioJsonPath, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    } else {
        foreach ($funcionarios as &$func) {
            if ($func['email'] === $usuario['username']) {
                $func['nome'] = $_POST['nome'];
                $func['email'] = $_POST['email'];
                $func['telefone'] = $_POST['telefone'] ?? '';
                $func['cpf'] = $_POST['cpf'] ?? '';
                $func['atuacao'] = $_POST['atuacao'] ?? '';
                $func['experiencia'] = $_POST['experiencia'] ?? '';
                $func['descricao'] = $_POST['descricao'] ?? '';

                // Aqui pega o caminho da imagem enviado no form (por exemplo, input hidden)
                if (isset($_POST['path'])) {
                    $func['path'] = $_POST['path'];
                }
                break;
            }
        }
        file_put_contents($funcionarioJsonPath, json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    header('Location: exibicaoaccount.php');
    exit;
}
