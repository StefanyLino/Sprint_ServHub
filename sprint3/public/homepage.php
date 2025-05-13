<?php
require_once __DIR__ .'/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();
$funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/funcionarios.json'), true);
$dado_funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servhub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg primary-bg-color py-4 px-2" id="navbar">
        <div class="container">
            <div class="container d-flex justify-content-between" id="bot-nav">
                <a class="navbar-brand text-black" id="logo" href="#navbar">ServHub</a>
                <button id="burgue" class="navbar-toggler text-black" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-items">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <div class="container col-sm-8 mx-2" id="formulario">
                <form class="d-flex" id="search-form">
                    <i class="bi bi-search text-black mt-2"></i>
                    <input class="form-control me-2 bg-transparent text-white" type="search" placeholder="Busque um funcionário...">
                    <button class="btn secondary-bg-color text-black" type="submit">Pesquisar</button>
                </form>
            </div>

            <div class="collapse navbar-collapse" id="navbar-items">
                <ul class="navbar-nav mb-2 mb-lg-0 ">
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled text-black" href="#">HOME</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled text-black" href="#">CONTA</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link text-white" href="?logout=1" id="logout">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="py-4 mx-2">
        <div class="container mt-4">
            <div class="row">
                <!-- Coluna principal -->
                <div class="col-md-8">
                    <div class="card mb-4" id="principal">
                        <div class="card-body d-flex flex-row justify-content-between">
                            <div>
                                <h1 class="card-title" id="titulo-card">SERVHUB</h1>
                                <p class="card-text" id="texto-card">Conectando talentos e impulsionando oportunidades!</p>
                            </div>
                            <img id="logo-card" src="Assets/logo.png" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="card mb-4" id="responsivo">
                        <div class="card-body d-flex flex-row justify-content-around">
                            <img style="width: 50px;" src="Assets/adm.png" alt="" class="img-fluid">
                            <button id="saiba" class="btn btn-success">Editar perfil</button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4" id="sidebar">
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <?php if (Auth::isAdmin()): ?>
                                <img style="width: 200px;" src="Assets/adm.png" alt="">
                                <h3 class="card-title"><?= htmlspecialchars($usuario['username']) ?></h3>
                                <p id="descricao-adm" class="mt-0 fw-normal">
                                    Você é o administrador da empresa, altere o que for necessário e deslogue sua conta para ter mais segurança.
                                </p>
                            <?php else: ?>
                                <?php foreach ($dado_funcionarios as $dados): ?>
                                    <img style="width: 200px;" src="Assets/adm.png" alt="">
                                    <h3 class="card-title"><?= htmlspecialchars($dados['nome']) ?></h3>
                                    <p style="font-size: 0.8rem;" class="mt-0"><?= htmlspecialchars($dados['email']) ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nova linha: Grid de funcionários ocupa 100% -->
            <div class="row mt-3">
                <?php foreach ($locadora->listarFuncionarios() as $funcionario): ?>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="Assets/profissional1.png" alt="advogado" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($funcionario->getNome()) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($funcionario->getNivelExperiencia()) ?></p>
                            <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adv">Saiba mais...</button>
                            <?php if (Auth::isAdmin()): ?>
                            <button class="btn btn-danger"><i class="bi bi-trash-fill text-black"></i></button>
                            <button class="btn btn-warning"><i class="bi bi-pen-fill text-black"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>