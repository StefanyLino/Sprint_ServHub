<?php 

// Incluir o autoload do Composer para carregar automaticamente as classes utilizadas
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir o arquivo com as variáveis de configuração
require_once __DIR__ . '/../config/config.php';

session_start();

// Inserir a classe de autenticação
use Services\auth;

// Inicializa a variável para mensagens de erro
$mensagem = '';

// Instanciar a classe de autenticação
$auth = new auth();

// Verifica se já foi autenticado
if (auth::verificarLogin()) {
    echo "Usuário já autenticado. Redirecionando...";
    header('Location: index.php');
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['email'] ?? '');
    $password = trim($_POST['senha'] ?? '');

    // Validação básica dos campos
    if (empty($username) || empty($password)) {
        $mensagem = 'Por favor, preencha todos os campos.';
    } elseif ($auth->login($username, $password)) {
        echo "Login bem-sucedido. Redirecionando...";
        header('Location: index.php');
        exit;
    } else {
        $mensagem = 'Usuário ou senha incorretos!';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <title>Login</title>
</head>
<style>
    .titulo {
        margin: 0 80px 40px;
        font-weight: bold;
    }
    @media (min-width: 377px) and (max-width: 426px) {
        .titulo {
            margin: 0 90px 40px;
            font-weight: bold;
        }
    }
    @media (min-width: 321px) and (max-width: 376px) {
        .titulo {
            margin: 0 60px 40px;
            font-weight: bold;
        }
    }
    @media screen and (max-width: 320px) {
        .titulo {
            margin: 0 40px 40px;
            font-weight: bold;
        }
    }
</style>
<body>
    <div class="d-flex col-sm-12">
        <div class="container-fluid col-sm-6" id="fundo"></div>
        <main class="container col-sm-6 d-flex align-items-center justify-content-center flex-column" id="login">
            <div class="align-self-start titulo">
                <h1 class="mb-2">Login</h1>
                <p id="bem-vindo">Seja bem vindo(a)! Faça seu login abaixo.</p>
            </div>
            <form action="#" method="POST" class="form col-sm-9">
                <!-- Exibição de mensagens de erro -->
                <?php if (!empty($mensagem)): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($mensagem); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control input-custom shadow-sm" required />
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" class="form-control input-custom shadow-sm" required />
                    <a href="">Esqueci minha senha</a>
                </div>
                <button type="submit" class="btn btn-submit mt-3 mb-3 w-100" id="btn-custom">Entrar</button>
            </form>
            <p id="senha-esqueceu">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            <a href="Index.php">Voltar <i class="bi bi-arrow-right"></i></a>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>