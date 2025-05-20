<?php
require_once __DIR__ .'/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();
$dado_funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);
$funcionarioLogado = null;
foreach ($dado_funcionarios as $dado) {
    if (isset($dado['email']) && $dado['email'] === $usuario['username']) {
        $funcionarioLogado = $dado;
        break;
    }
}
?>

<?php
    include 'htmls/head.html';
?>
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
                                <img style="width: 200px;" src="Assets/adm.png" alt="">
                                <h3 class="card-title"><?= htmlspecialchars($funcionarioLogado['nome'] ?? '') ?></h3>
                                <p style="font-size: 0.8rem;" class="mt-0"><?= htmlspecialchars($funcionarioLogado['email'] ?? '') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img src="" alt="">
                            <!-- Formulário de upload de imagem -->
                            <form action="../upload/upload.php" method="post" enctype="multipart/form-data" class="mb-3">
                                <label for="image">Selecione uma imagem:</label>
                                <input type="file" name="image" id="image" accept="image/*">
                                <input type="submit" value="Enviar">
                            </form>
                            <!-- Formulário de dados do funcionário -->
                            <form action="" class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="name">Nome completo:</label>
                                    <input class="form-control" type="text" value="<?= htmlspecialchars($funcionarioLogado['nome'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="telefone">Telefone:</label>
                                    <input class="form-control" type="text" value="<?= htmlspecialchars($funcionarioLogado['telefone'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="cpf">CPF:</label>
                                    <input class="form-control" type="text" value="<?= htmlspecialchars($funcionarioLogado['cpf'] ?? '') ?>">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-normal" for="email">Email:</label>
                                    <input class="form-control" type="email" value="<?= htmlspecialchars($funcionarioLogado['email'] ?? '') ?>">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-normal" for="description">Descrição:</label>
                                    <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10"><?= htmlspecialchars($funcionarioLogado['descricao'] ?? '') ?></textarea>
                                </div>
                                <div class="col-md-12 mb-3 d-flex justify-content-center flex-column align-items-center">
                                    <label for="curriculo" class="fw-normal mb-2">Envie seu Currículo</label>
                                    <!-- Upload pdf -->
                                    <form action="../upload/upload2.php" method="post" enctype="multipart/form-data">
                                        <label for="file">Selecione um arquivo (imagem ou PDF):</label>
                                        <input class="form-control" type="file" name="file" id="file" accept="image/*,application/pdf" required>
                                        <input type="submit" value="Enviar" class="btn btn-primary mt-2">
                                    </form>"col-md-12 d-flex justify-content-center flex-row align-items-center">
                                </div>utton type="submit" class="btn btn-submit w-50 mb-2" id="btn-custom"> Salvar Alterações</button>
                                <div class="col-md-12 d-flex justify-content-center flex-row align-items-center">estaurar </button>
                                    <button type="submit" class="btn btn-submit w-50 mb-2" id="btn-custom"> Salvar Alterações</button>
                                    <button type="reset" class="btn btn-submit w-50 ms-3 mb-2" id="btn-custom"> Restaurar </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>t src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>