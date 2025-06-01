    <?php
require_once __DIR__ . '/../services/Auth.php';
use Services\Auth;

$usuario = Auth::getUsuario();

// Carregando arquivos
$usuariosJson = json_decode(file_get_contents(__DIR__ . '/../data/usuarios.json'), true);
$dataFuncionarioJson = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);
$dataEmpresaJson = json_decode(file_get_contents(__DIR__ . '/../data/data_empresa.json'), true);

$isAdmin = Auth::isAdmin();
$dadosLogado = null;

// Busca dados com base no tipo de perfil
if ($isAdmin) {
    foreach ($usuariosJson as $user) {
        if ($user['username'] === $usuario['username']) {
            $dadosLogado = $user;
            break;
        }
    }
} elseif ($usuario['perfil'] === 'funcionario') {
    foreach ($dataFuncionarioJson as $user) {
        if ($user['email'] === $usuario['username']) {
            $dadosLogado = $user;
            break;
        }
    }
}else{
    foreach ($dataEmpresaJson as $user) {
        if ($user['email'] === $usuario['username']) {
            $dadosLogado = $user;
            break;
        }
    }
}

// Define imagem de perfil
$profileImage = isset($dadosLogado['path']) && !empty($dadosLogado['path'])
    ? $dadosLogado['path']
    : 'Assets/adm.png';
?>

<?php include 'htmls/head.html'; ?>
<body>
<?php include 'htmls/nav.html'; ?>

<div class="py-4 mx-2">
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4" id="sidebar">
                <div class="card mb-4">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img id="foto-perfil" src="<?= $profileImage ?>" alt="Foto de perfil">
                        <h3 class="card-title"><?= htmlspecialchars($dadosLogado['nome'] ?? $usuario['username']) ?></h3>
                        <p style="font-size: 0.8rem;"><?= htmlspecialchars($usuario['username']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Conteúdo principal -->
            <div class="col-md-8 d-flex flex-column">
                <div class="card mb-4">
                    <div class="card-header mx-0">
                        <h5>Atualizar dados</h5>
                    </div>
                    <div class="card-body">
                        <!-- Dados -->
                        <form method="POST" action="atualizar_dados.php">
                            <!-- Campo oculto para identificador fixo -->
                            <?php if ($isAdmin): ?>
                                <input type="hidden" name="user_identifier" value="<?= htmlspecialchars($dadosLogado['username'] ?? $usuario['username']) ?>">
                            <?php else: ?>
                                <input type="hidden" name="user_identifier" value="<?= htmlspecialchars($dadosLogado['email'] ?? $usuario['username']) ?>">
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Nome:</label>
                                    <input class="form-control" name="nome" value="<?= htmlspecialchars($dadosLogado['nome'] ?? '') ?>" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Email:</label>
                                    <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($dadosLogado['email'] ?? '') ?>" required>
                                </div>

                                <?php if ($usuario['perfil'] === 'funcionario'): ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Telefone:</label>
                                        <input class="form-control" name="telefone" value="<?= htmlspecialchars($dadosLogado['telefone'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">CPF:</label>
                                        <input class="form-control" name="cpf" value="<?= htmlspecialchars($dadosLogado['cpf'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Atuação:</label>
                                        <input class="form-control" name="atuacao" value="<?= htmlspecialchars($dadosLogado['atuacao'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Nível de Experiência:</label>
                                        <select class="form-control mb-2" name="experiencia" require id="">
                                            <option value="" disabled selected>Selecione seu nível de experiência</option>
                                            <option value="iniciante">Iniciante</option>
                                            <option value="experiente">Experiente</option>
                                            <option value="senior">Sênior</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Descrição:</label>
                                        <textarea class="form-control" name="descricao" rows="4"><?= htmlspecialchars($dadosLogado['descricao'] ?? '') ?></textarea>
                                    </div>
                                <?php elseif ($usuario['perfil'] === 'empresa'): ?>

                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">CNPJ:</label>
                                        <input class="form-control" name="cnpj" value="<?= htmlspecialchars($dadosLogado['cnpj'] ?? '') ?>" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Endereço:</label>
                                        <input class="form-control" name="endereco" value="<?= htmlspecialchars($dadosLogado['endereco'] ?? '') ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-12 text-center">
                                    <button type="submit" id="saiba" class="btn btn-success">Salvar Alterações</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                <div class="row mx-0">
                    <?php if (!$isAdmin): ?>
                        <!-- Upload de imagem -->
                        <div class="card mb-4 <?= $usuario['perfil'] === 'empresa' ? 'col-md-12' : 'col-md-6' ?>" id="adicionar">
                            <div class="card-header">
                                <h5>Alterar foto de perfil</h5>
                            </div>
                            <div class="card-body">
                                <form action="../upload/upload.php" method="post" enctype="multipart/form-data" class="mb-4">
                                    <input type="hidden" name="perfil" value="<?= htmlspecialchars($usuario['perfil']) ?>">
                                    <input type="hidden" name="email" value="<?= htmlspecialchars($dadosLogado['email']) ?>">
                                    <label for="image" class="form-label fw-bold">Foto de Perfil:</label>
                                    <input class="form-control" type="file" name="image" id="image" accept="image/*">
                                    <button class="btn btn-primary mt-2" id="saiba" type="submit">Enviar Imagem</button>
                                </form>
                            </div>
                        </div>
                        <!-- Upload de currículo -->
                        <?php if ($usuario['perfil'] === 'funcionario'): ?>
                            <div class="card mb-4 col-md-6" id="adicionar">
                                <div class="card-header">
                                    <h5>Enviar currículo</h5>
                                </div>
                                <div class="card-body">
                                    <form action="../upload/upload_curriculo.php" method="post" enctype="multipart/form-data" class="mt-4">
                                        <input type="hidden" name="email" value="<?= htmlspecialchars($dadosLogado['email']) ?>">
                                        <label class="fw-bold">Currículo:</label>
                                        <input class="form-control" type="file" name="file" accept="application/pdf,image/*" required>
                                        <button class="btn btn-secondary mt-2" id="saiba" type="submit">Enviar Currículo</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>