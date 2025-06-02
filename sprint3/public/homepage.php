<?php
require_once __DIR__ .'/../services/Auth.php';
require_once __DIR__ . '/../services/locadora.php';
use Services\Auth;

$mensagem = '';

$usuario = Auth::getUsuario();

$funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/funcionarios.json'), true);
$dado_funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);
$dado_empresa = json_decode(file_get_contents(__DIR__ . '/../data/data_empresa.json'), true);

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

// Editar funcionário
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

// --- CÁLCULO DE ALUGUEL NO MODAL ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calcular'])) {
    $dias = isset($_POST['dias_calculo']) ? (int)$_POST['dias_calculo'] : 1;
    $tipo = $_POST['tipo_calculo'] ?? '';
    $nome = $_POST['nome_calculo'] ?? '';
    require_once __DIR__ . '/../config/config.php';
    $valor = 0;
    if ($tipo === 'iniciante' && defined('SEMANAL_INICIANTE')) {
        $valor = $dias * SEMANAL_INICIANTE;
    } elseif ($tipo === 'experiente' && defined('SEMANAL_EXPERIENTE')) {
        $valor = $dias * SEMANAL_EXPERIENTE;
    } elseif ($tipo === 'senior' && defined('SEMANAL_SENIOR')) {
        $valor = $dias * SEMANAL_SENIOR;
    }
    $mensagem = "Previsão de contratação do(a) $nome para $dias semana(s) ($tipo): R$ " . number_format($valor, 2, ',', '.');
}


// --- ALUGAR FUNCIONÁRIO ---
if (isset($_POST['alugar'])) {
    $nome = $_POST['nome_aluguel'] ?? '';
    $tipo = strtolower($_POST['tipo_aluguel'] ?? '');
    $dias = isset($_POST['dias_aluguel']) ? (int)$_POST['dias_aluguel'] : 1;


    if (empty($nome)) {
        $mensagem = "Erro: O nome do funcionário não encontrado tente novamente.";
    } else {
        $mensagem = $locadora->alugarFuncionario($nome, $tipo, $dias);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
}

// --- DEVOLVER FUNCIONÁRIO ---
if (isset($_POST['devolver'])) {
    $nome = $_POST['nome_devolver'] ?? '';
    if (empty($nome)) {
        $mensagem = "Erro: O nome do funcionário não encontrado tente novamente.";
    } else {
        $mensagem = $locadora->devolverFuncionario($nome);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
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
                            <p style="font-size: 0.8rem; font-weight: lighter;" id="descricao-adm" class="mt-0 mx-3 fw-normal">Você é o administrador da empresa, altere o que for necessário e deslogue sua conta para ter mais segurança.</p>
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
                                $empresa = null;
                                foreach ($dado_empresa as $emp){
                                    if (isset($emp['email']) && $emp['email'] === $usuario['username']) {
                                        $empresa = $emp;
                                        break;
                                    }
                                }
                            ?>
                             
                            <?php if ($usuario['perfil'] != 'empresa') : ?>
                                <img id="foto-perfil" src="<?= htmlspecialchars($funcionarioLogado['path'] ?? 'Assets/default.png') ?>" alt="Funcionário">
                                <h3 style="font-size: 1.2rem; font-weight: bold;" class="card-title"><?= htmlspecialchars($funcionarioLogado['nome'] ?? 'Sem nome') ?></h3>
                                <p style="font-size: 1rem;" class="mt-0"><?= htmlspecialchars($funcionarioLogado['email'] ?? 'Sem email') ?></p>
                                <?php if ($funcionarioLogado['descricao'] === ""): ?>
                                    <p style="font-size: 0.8rem; font-weight: lighter;" class="mt-0 mx-3">Sem descrição.</p>
                                <?php else: ?>
                                    <p style="font-size: 0.8rem; font-weight: lighter;" class="mt-0 mx-3"><?= htmlspecialchars($funcionarioLogado['descricao']) ?></p>
                                <?php endif; ?>
                            <?php else: ?>
                                <img id="foto-perfil" src="<?= htmlspecialchars($empresa['path'] ?? 'Assets/adm.png') ?>" alt="Funcionário">
                                <h3 style="font-size: 1.2rem; font-weight: bold;" class="card-title"><?= htmlspecialchars($empresa['nome'] ?? 'sem nome') ?></h3>
                                <p style="font-size: 1rem;" class="mt-0"><?= htmlspecialchars($empresa['email'] ?? 'sem nome') ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="exibicaoaccount.php" class="btn btn-submit w-100 mb-2" id="btn-custom">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($mensagem): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($mensagem) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        

        <div class="row mt-3">
    <?php foreach ($dado_funcionarios as $index => $funcionario): ?>
        <?php
            $modalId = "editarFuncionario" . $index;
            $saibaMaisModalId = "saibaMaisFuncionario" . $index;
        ?>
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="card h-100">
                <div style="height: 200px;" class="d-flex align-items-center justify-content-center">
                    <img src="<?= htmlspecialchars($funcionario['path'] ?? 'Assets/default.png') ?>" alt="profissional" class="card-img-top w-100 h-100">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($funcionario['nome'] ?? 'Sem nome') ?></h5>
                    <p class="card-text"><?= htmlspecialchars($funcionario['atuacao'] ?? 'Sem Area de atuação') ?></p>
                    <div class="d-flex gap-2">
                        <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#<?= $saibaMaisModalId ?>">Saiba mais...</button>
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

        <!-- Modal Saiba Mais -->
        <div class="modal fade" id="<?= $saibaMaisModalId ?>" tabindex="-1" aria-labelledby="<?= $saibaMaisModalId ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?= $saibaMaisModalId ?>Label">Detalhes do Funcionário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body d-flex flex-column flex-md-row align-items-center gap-3 flex-wrap">
                        <div class="col-sm-5">
                            <img src="<?= htmlspecialchars($funcionario['path'] ?? 'Assets/default.png') ?>" alt="Foto do Funcionário" class="w-100" style="max-height: 300px; border-radius: 20px" >
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <h4 class="fw-bold mb-0"><?= htmlspecialchars($funcionario['nome'] ?? 'Sem nome') ?></h4>
                                <p class="fw-normal mt-0 mb-1"><?= htmlspecialchars($funcionario['atuacao'] ?? 'Não especificada') ?></p>
                                <p class="fw-normal mt-2"><?= nl2br(htmlspecialchars($funcionario['descricao'] ?? 'Sem descrição')) ?></p>
                            </div>

                            <div class="col-sm-12 d-flex flex-row">
                                <div class="col-sm-6 me-5">
                                    <p><strong>Experiência:</strong><br> <?= htmlspecialchars($funcionario['experiencia'] ?? 'Não informado') ?></p>
                                </div>
                                <div class="col-sm-6 me-5">
                                    <p><strong>Salário:</strong><br>
                                        <?php if ($funcionario['experiencia'] === 'iniciante'): ?>
                                            R$ <?= number_format(defined('SEMANAL_INICIANTE') ? SEMANAL_INICIANTE : 800, 2, ',', '.') ?> por semana
                                        <?php elseif ($funcionario['experiencia'] === 'experiente'): ?>
                                            R$ <?= number_format(defined('SEMANAL_EXPERIENTE') ? SEMANAL_EXPERIENTE : 1200, 2, ',', '.') ?> por semana
                                        <?php elseif ($funcionario['experiencia'] === 'senior'): ?>
                                            R$ <?= number_format(defined('SEMANAL_SENIOR') ? SEMANAL_SENIOR : 1800, 2, ',', '.') ?> por semana
                                        <?php else: ?>
                                            Não informado
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <?php if ($usuario['perfil'] === 'empresa'): ?>
                                <div class="col-sm-12 d-flex flex-row">
                                    <div class="col-sm-6 me-5">
                                        <p><strong>Email:</strong></p>
                                        <p><?= htmlspecialchars($funcionario['email'] ?? 'Sem email') ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><strong>Telefone:</strong></p>
                                        <p><?= htmlspecialchars($funcionario['telefone'] ?? 'Sem telefone') ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- FORMULÁRIO DE CÁLCULO -->
                        <div class="col-sm-12">
                            <form action="exibicao.php" class="needs-validation" novalidate method="post" id="formCalculo-<?= $index ?>">
                                <div class="mb-3">
                                    <input type="text" hidden name="tipo_calculo" value="<?= htmlspecialchars($funcionario['experiencia'] ?? '') ?>">
                                    <input type="text" hidden name="nome_calculo" value="<?= htmlspecialchars($funcionario['nome'] ?? '') ?>">
                                    <input type="hidden" name="id" value="<?= $index ?>">
                                    <label for="dias" class="form-label">
                                        Calcule a previsão de aluguel desse funcionário<br>
                                        Quantidade de semanas:
                                    </label>
                                    <input type="number" name="dias_calculo" class="form-control" value="1" required>
                                </div>
                                <button class="btn btn-info w-100" id="calcular" type="submit" name="calcular">Calcular</button>
                            </form>
                        </div>
                        <?php if (!empty($funcionario['disponivel']) && $funcionario['disponivel'] === true): ?>
                            <?php if (Auth::isAdmin() || $usuario['perfil'] === 'empresa'): ?>
                                <div class="col-sm-12">
                                    <form method="post" class="needs-validation" novalidate>
                                        <div class="mb-3">
                                            <input type="hidden" name="tipo_aluguel" value="<?= htmlspecialchars($funcionario['experiencia'] ?? '') ?>">
                                            <input type="hidden" name="nome_aluguel" value="<?= htmlspecialchars($funcionario['nome'] ?? '') ?>">
                                            <label for="dias" class="form-label">Faça a contratação desse funcionário</label>
                                            <input type="number" name="dias_aluguel" class="form-control" value="1" required>
                                        </div>
                                        <button type="submit" name="alugar" class="btn btn-success w-100">Alugar</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($usuario['perfil'] === 'empresa'): ?>
                            <p>Funcionário já contratado. Espere ele ser devolvido para poder contratá-lo.</p>
                        <?php elseif (Auth::isAdmin()): ?>
                            <div class="d-flex flex-column gap-0">
                                <p>Funcionário não disponível para contratação.</p><br>
                                <form action="" class="needs-validation" novalidate method="post">
                                    <input type="hidden" name="nome_devolver" value="<?= htmlspecialchars($funcionario['nome'] ?? '') ?>">
                                    <button name="devolver" class="btn btn-info" type="submit">Devolver</button>
                                </form>
                            </div>
                        <?php endif; ?>
                        
                    </div>

                    <?php if (Auth::isAdmin()): ?>
                        <div class="modal-footer">
                            <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este funcionário?')">
                                <input type="hidden" name="id" value="<?= $index ?>">
                                <button type="submit" name="deletar" class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i> Excluir
                                </button>
                            </form>
                            <button class="btn btn-warning" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                                <i class="bi bi-pen-fill"></i> Editar
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

         <!-- Modal add funcionário por adm -->
        <div class="modal fade" id="funcionario" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Adicionar funcionário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body d-flex flex-column flex-md-row align-items-center gap-3 flex-wrap">
                        <form class="w-100" action="salvar-funcionario.php" method="POST">
                            <div>
                                <label for="nome" class="fw-normal">Nome completo:</label>
                                <input type="text" name="nome_funcionario" id="nome_funcionario" required class="form-control shadow-sm" placeholder="Digite seu nome">
                            </div>
                            <div>
                                <label for="email" class="fw-normal">Email:</label>
                                <input type="email" name="email_funcionario" id="email_funcionario" required class="form-control shadow-sm" placeholder="Digite seu email">
                            </div>
                            <div>
                                <label for="senha" class="fw-normal">Senha:</label>
                                <input type="password" min="8" name="senha_funcionario" id="senha_funcionario" required class="form-control shadow-sm" placeholder="Digite sua senha">
                            </div>
                            <div>
                                <label for="cpf" class="fw-normal">CPF:</label>
                                <input type="number" min="11" name="cpf" id="cpf" required class="form-control shadow-sm" placeholder="Digite seu CPF">
                            </div>
                            <div>
                                <label for="atuacao" class="fw-normal">Área de Atuação</label>
                                <input type="text" name="atuacao" id="atuacao" required class="form-control shadow-sm" placeholder="Digite sua area de atuação(Ex. Engenheiro, Medico e etc)">
                            </div>
                            <div>
                                <label for="experiencia" class="fw-normal">Nivel de Experiência</label>
                                <select class="form-control mb-2" name="nivel-experiencia" id="">
                                    <option value="" disabled selected>Selecione seu nível de experiência</option>
                                    <option value="iniciante">Iniciante</option>
                                    <option value="experiente">Experiente</option>
                                    <option value="senior">Sênior</option>
                                </select>
                            </div>
                            <button class="btn btn-submit w-100 mb-2" id="btn-custom">Cadastre-se</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal add empresa por adm -->
        <div class="modal fade" id="empresa" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Adicionar Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body d-flex flex-column flex-md-row align-items-center gap-3 flex-wrap">
                        <form class="w-100" method="post" action="salvar-empresa.php">
                            <div>
                                <label for="nome" class="fw-normal">Nome:</label>
                                <input type="text" placeholder="Nome da empresa" id="nome_empresa" name="nome_empresa" required class="form-control shadow-sm">
                            </div>
                            <div>
                                <label for="email" class="fw-normal">Email:</label>
                                <input type="email" placeholder="Digite o Email comercial" id="email_empresa" name="email_empresa" required class="form-control shadow-sm">
                            </div>
                            <div>
                                <label for="senha" class="fw-normal">Senha:</label>
                                <input type="password" min="8" placeholder="Digite seu senha" id="senha_empresa" name="senha_empresa" required class="form-control shadow-sm">
                            </div>
                            <div>
                                <label for="cnpj" class="fw-normal">CNPJ:</label>
                                <input type="number" min="14" placeholder="CNPJ da empresa" id="cnpj" name="cnpj" required class="form-control shadow-sm">
                            </div>
                            <div>
                                <label for="endereco" class="fw-normal">Endereço:</label>
                                <input type="text" placeholder="Endereço da empresa" id="endereco" name="endereco" required class="form-control shadow-sm">
                            </div>
                            <button type="submit" class="btn btn-submit mt-3 w-100  mb-2" id="btn-custom">Cadastre-se:</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>