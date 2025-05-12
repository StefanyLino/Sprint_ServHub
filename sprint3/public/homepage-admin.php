<?php
require_once __DIR__ . '/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servhub-ADM</title>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Link ícones do bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg primary-bg-color py-4 px-2" id="navbar">
        <div class="container">
            <div class="container d-flex justify-content-between" id="bot-nav">
                <!-- Logo -->
                <a class="navbar-brand text-black" id="logo" href="#navbar">ServHub</a>
                <!-- Botão Hamburguer -->
                <button id="burgue" class="navbar-toggler text-black" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-items"
                    aria-controls="navbar-items" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <!-- Formulário de busca -->
            <div class="container col-sm-8 mx-2" id="formulario">
                <form class="d-flex" id="search-form">
                    <i class="bi bi-search text-black mt-2"></i>
                    <input class="form-control me-2 bg-transparent text-white" type="search" placeholder="Busque um funcionário..."
                        aria-label="Search">
                    <button class="btn secondary-bg-color text-black" type="submit">Pesquisar</button>
                </form>
            </div>
            <!-- Itens colapsáveis do menu -->
            <div class="collapse navbar-collapse" id="navbar-items">
                

                <!-- Links do menu -->
                <ul class="navbar-nav mb-2 mb-lg-0 ">
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled text-black" href="#">HOME</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled text-black" href="#">CONTA</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled text-white" href="?logout=1" id="logout">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="py-4 mx-2">
        
            <!-- Conteúdo Principal -->
        <div class=" container mt-4">


            <div class="row">
                <!-- Coluna principal -->
                <div class="col-md-8">
                    <div class="card mb-4" id="principal">
                        <div class="card-body d-flex flex-row justify-content-between">
                            <div>
                                <h1 class="card-title">ServHub</h5>
                                <p class="card-text">Conectando talentos e impulsionando oportunidades!</p>
                            </div>
                            <img style="width: 250px;" src="Assets/logo.png" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="card mb-4" id="responsivo">
                        <div class="card-body d-flex flex-row justify-content-around">
                            <img style="width: 50px;" src="Assets/adm.png" alt="" class="img-fluid">
                            <button id="saiba" class="btn btn-success">Editar perfil</button>
                        </div>
                    </div>


                    <!-- Grid de produtos -->
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <div class="card">
                                <img src="Assets/profissional1.png" alt="advogado" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($veiculo->getNome()) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($veiculo->getProfissao()) ?></p>
                                    <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adv">Saiba mais...</button>
                                    <?php if (Auth::isAdmin()): ?>
                                    <button class="btn btn-danger"><i class="bi bi-trash-fill text-black"></i></button>
                                    <button class="btn btn-warning"><i class="bi bi-pen-fill text-black"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-md-4" id="sidebar">
                    <!-- usuario -->
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img style="width: 200px;" src="Assets/adm.png" alt="">
                            <h3 class="card-title">
                                <?=htmlspecialchars($usuario['username'])
                                ?>
                            </h3>
                            <p style="font-size: 0.8rem;"  class="mt-0">
                                <?=htmlspecialchars($usuario['email'])
                                ?>
                                </p>
                            <p class="mx-4 text-center">
                                <?=htmlspecialchars($usuario['descricao'])
                                ?>
                                </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Grid de produtos -->
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <div class="card">
                                <img src="Assets/profissional1.png" alt="advogado" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($veiculo->getNome()) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($veiculo->getProfissao()) ?></p>
                                    <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adv">Saiba mais...</button>
                                    <?php if (Auth::isAdmin()): ?>
                                    <button class="btn btn-danger"><i class="bi bi-trash-fill text-black"></i></button>
                                    <button class="btn btn-warning"><i class="bi bi-pen-fill text-black"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>