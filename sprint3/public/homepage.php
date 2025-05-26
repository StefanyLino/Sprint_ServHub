<?php
require_once __DIR__ .'/../services/Auth.php';
use Services\Auth;

$usuario = Auth::getUsuario();

$funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/funcionarios.json'), true);
$dado_funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);

// Caminho do arquivo de usuários
$usuarioJsonPath = __DIR__ . '/../data/usuarios.json';
if (file_exists($usuarioJsonPath)) {
    $usuarios = json_decode(file_get_contents($usuarioJsonPath), true);
} else {
    $usuarios = [];
}

// Deletar funcionário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletar'])) {
    $id = $_POST['id'];

    // Verificar se o funcionário existe
    if (isset($dado_funcionarios[$id])) {
        $emailParaRemover = $dado_funcionarios[$id]['email'];

        // Remover do arquivo funcionarios.json
        unset($funcionarios[$id]);

        // Remover do arquivo data_funcionario.json
        unset($dado_funcionarios[$id]);

        // Reindexar arrays para evitar lacunas
        $funcionarios = array_values($funcionarios);
        $dado_funcionarios = array_values($dado_funcionarios);

        // Remover do arquivo usuarios.json
        $usuarios = array_filter($usuarios, function($usuario) use ($emailParaRemover) {
            return $usuario['username'] !== $emailParaRemover;
        });

        // Reindexar usuários
        $usuarios = array_values($usuarios);

        // Salvar os arquivos modificados
        file_put_contents(__DIR__ . '/../data/funcionarios.json', json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        file_put_contents(__DIR__ . '/../data/data_funcionario.json', json_encode($dado_funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        file_put_contents($usuarioJsonPath, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Editar funcionário (apenas no data_funcionario.json)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $dado_funcionarios[$id]['nome'] = $_POST['nome'];
    $dado_funcionarios[$id]['email'] = $_POST['email'];
    $dado_funcionarios[$id]['experiencia'] = $_POST['nivel'];
    $dado_funcionarios[$id]['descricao'] = $_POST['descricao'];

    file_put_contents(__DIR__ . '/../data/data_funcionario.json', json_encode($dado_funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<?php include 'htmls/head.html'; ?>
<body>
<?php include 'htmls/nav.html'; ?>

<div class="py-4 mx-2">
    <div class="container mt-4">
        <div class="row">
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
                        <a href="exibicaoaccount.php" class="btn btn-submit w-100 mb-2" id="btn-custom">Editar Perfil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4" id="sidebar">
                <div class="card mb-4">
                    <div class="card-body d-flex flex-column align-items-center">
                        <?php if (Auth::isAdmin()): ?>
                            <img style="width: 200px;" src="Assets/adm.png" alt="Administrador">
                            <h3 class="card-title"><?= htmlspecialchars($usuario['username']) ?></h3>
                            <p id="descricao-adm" class="mt-0 fw-normal">Você é o administrador da empresa, altere o que for necessário e deslogue sua conta para ter mais segurança.</p>
                        <?php else: ?>
                            <?php
                                $funcionarioLogado = null;
                                foreach ($dado_funcionarios as $funcionario) {
                                    if (isset($funcionario['email']) &&
                                        $funcionario['email'] === $usuario['username'] &&
                                        isset($funcionario['descricao']) &&
                                        isset($funcionario['path'])) {
                                            
                                        $funcionarioLogado = $funcionario;
                                        break;
                                    }
                                }
                            ?>
                            <img style="width: 200px;" src="<?= htmlspecialchars($funcionarioLogado['path'] ?? 'Assets/default.png') ?>" alt="Funcionário">
                            <h3 class="card-title"><?= htmlspecialchars($funcionarioLogado['nome'] ?? 'Sem nome') ?></h3>
                            <p style="font-size: 0.8rem;" class="mt-0"><?= htmlspecialchars($funcionarioLogado['email'] ?? 'Sem email') ?></p>
                            <?php if ($funcionarioLogado['descricao'] === ""): ?>
                                <p style="font-size: 0.8rem;" class="mt-0">Sem descrição.</p>
                            <?php else: ?>
                                <p style="font-size: 0.8rem;" class="mt-0"><?= htmlspecialchars($funcionarioLogado['descricao']) ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="exibicaoaccount.php" class="btn btn-submit w-100 mb-2" id="btn-custom">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <?php foreach ($dado_funcionarios as $index => $funcionario): ?>
                <?php $modalId = "editarFuncionario" . $index; ?>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="Assets/profissional1.png" alt="profissional" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($funcionario['nome'] ?? 'Sem nome') ?></h5>
                            <p class="card-text"><?= htmlspecialchars($funcionario['experiencia'] ?? 'Sem experiência') ?></p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-success" id="saiba" data-bs-toggle="modal" data-bs-target="#adv">Saiba mais...</button>
                                <?php if (Auth::isAdmin()): ?>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>"><i class="bi bi-pen-fill text-black"></i></button>
                                    <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este funcionário?')">
                                        <input type="hidden" name="id" value="<?= $index ?>">
                                        <button type="submit" name="deletar" class="btn btn-danger">
                                            <i class="bi bi-trash-fill text-black"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Edição -->
                <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?= $modalId ?>Label">Editar Funcionário</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $index ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nome</label>
                                        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($funcionario['nome'] ?? '') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($funcionario['email'] ?? '') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nível de Experiência</label>
                                        <select class="form-control mb-2" name="nivel" required>
                                            <option value="" disabled <?= empty($funcionario['experiencia']) ? 'selected' : '' ?>>Selecione seu nível de experiência</option>
                                            <option value="iniciante" <?= ($funcionario['experiencia'] === 'iniciante') ? 'selected' : '' ?>>Iniciante</option>
                                            <option value="experiente" <?= ($funcionario['experiencia'] === 'experiente') ? 'selected' : '' ?>>Experiente</option>
                                            <option value="senior" <?= ($funcionario['experiencia'] === 'senior') ? 'selected' : '' ?>>Sênior</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Descrição</label>
                                        <textarea name="descricao" class="form-control" rows="3" required><?= htmlspecialchars($funcionario['descricao'] ?? '') ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="editar" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
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
