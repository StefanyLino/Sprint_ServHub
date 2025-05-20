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
                
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img src="" alt="">
                            <input type="file">
                            <form action="" class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="name">Nome:</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="sobrenome">Sobrenome:</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="telefone">Telefone:</label>
                                    <input class="form-control" type="number">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-normal" for="cpf">CPF:</label>
                                    <input class="form-control" type="number">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-normal" for="email">Email:</label>
                                    <input class="form-control" type="email">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-normal" for="description">Descrição:</label>
                                    <textarea class="form-control" name="" id="">
                                    </textarea>
                                </div>
                                <div class="col-md-12 mb-3 d-flex justify-content-center flex-column align-items-center">
                                    <label for="curriculo" class="fw-normal mb-2">Envie seu Currículo</label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="col-md-12 d-flex justify-content-center flex-row align-items-center">
                                    <button type="submit" class="btn btn-submit w-50 mb-2" id="btn-custom"> Salvar Alterações</button>
                                    <button type="reset" class="btn btn-submit w-50 ms-3 mb-2" id="btn-custom"> Restaurar </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>