<?php
require_once __DIR__ .'/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();
$funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/funcionarios.json'), true);
$dado_funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);
?>

<?php
    include 'htmls/head.html';
?>
<body>
    <?php
        include 'htmls/nav.html';
    ?>

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
                            <a href="accountpage.php" class="btn btn-submit w-100 mb-2" id="btn-custom">Editar Perfil</a>
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