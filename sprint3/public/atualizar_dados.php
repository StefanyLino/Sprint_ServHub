<?php
require_once __DIR__ . '/../services/Auth.php';
use Services\Auth;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = Auth::getUsuario();
    $isAdmin = Auth::isAdmin();

    $usuarioJsonPath = __DIR__ . '/../data/usuarios.json';
    $funcionarioJsonPath = __DIR__ . '/../data/data_funcionario.json';
    $empresaJsonPath = __DIR__ . '/../data/data_empresa.json';

    $usuarios = file_exists($usuarioJsonPath) ? json_decode(file_get_contents($usuarioJsonPath), true) : [];
    $funcionarios = file_exists($funcionarioJsonPath) ? json_decode(file_get_contents($funcionarioJsonPath), true) : [];

    $userIdentifier = $_POST['user_identifier'] ?? null;

    if ($isAdmin) {
        foreach ($usuarios as &$user) {
            if ($user['username'] === $userIdentifier) {
                $user['username'] = $_POST['email'];
                $user['nome'] = $_POST['nome'];
                break;
            }
        }
        unset($user);
        file_put_contents($usuarioJsonPath, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    } elseif($usuario['perfil'] === 'funcionario') {
        foreach ($funcionarios as &$func) {
            if ($func['email'] === $userIdentifier) {
                $func['nome'] = $_POST['nome'];
                $func['email'] = $_POST['email'];
                $func['telefone'] = $_POST['telefone'] ?? '';
                $func['cpf'] = $_POST['cpf'] ?? '';
                $func['atuacao'] = $_POST['atuacao'] ?? '';
                $func['experiencia'] = $_POST['experiencia'] ?? '';
                $func['descricao'] = $_POST['descricao'] ?? '';
                break;
            }
        }
        unset($func);
        file_put_contents($funcionarioJsonPath, json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }else{
        $empresas = file_exists($empresaJsonPath) ? json_decode(file_get_contents($empresaJsonPath), true) : [];
        foreach ($empresas as &$emp) {
            if ($emp['email'] === $userIdentifier) {
                $emp['nome'] = $_POST['nome'];
                $emp['cnpj'] = $_POST['cnpj'] ?? '';
                $emp['endereco'] = $_POST['endereco'] ?? '';
                break;
            }
        }
        unset($emp);
        file_put_contents($empresaJsonPath, json_encode($empresas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    header('Location: ../public/exibicaoaccount.php');
    exit;
}
