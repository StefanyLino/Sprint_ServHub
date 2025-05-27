<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// incluir o auto load do composer para carregar automaticamente as classes utilizadas
require_once __DIR__ . '/../vendor/autoload.php';

// incluir o arquivo com as variáveis
require_once __DIR__ . '/../config/config.php';

session_start();

// inserir a classe de autenticação

use Services\Auth;

// Inicializa a variável para mensagens de erro
$mensagem = '';

// instanciar a classe de autenticação
$auth = new Auth();

// verifica se já foi autenticado
if ($auth->verificarLogin()) { // Alterado para usar a instância $auth
    echo "Usuário já autenticado. Redirecionando...";
    header('Location: exibicao.php');
    exit;
}

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'] ?? '';
    $password = $_POST['senha'] ?? '';

    if ($auth->login($username, $password)) {
        header('Location: exibicao.php');
        exit;
    } else {
        $mensagem = 'Usuário ou senha incorretos!';
    }
}

?>

<?php
    include 'htmls/head.html';
?>
<body>
    <div class="d-flex col-sm-12 " >
        <div class="col-sm-6" id="fundo">
        </div>
        <main class="container col-sm-6 d-flex align-items-center justify-content-center flex-column">
            <section class="col-sm-9" id="form-login">
                <div id="texto-login">
                    <h1 class="mb-2">Login</h1>
                    <p id="bem-vindo">Seja bem vindo(a)! Faça seu login abaixo.</p>
                </div>
                <form action="#" method="POST" class="form w-100">
                    <div>
                        <label for="email" class="fw-normal">Email:</label>
                        <input type="email" id="email" name="email" class="form-control input-custom shadow-sm" required />
                    </div>
                    <div>
                        <label for="senha" class="fw-normal">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control input-custom shadow-sm"  required />
                        <a href="recuperar-senha.php" class="links" >Esqueci minha senha</a>
                    </div>
                    <button type="submit" class="btn btn-submit mt-3 mb-3 w-100 " id="btn-custom">Entrar</button>
                </form>
                <div class="d-flex justify-content-start flex-column align-items-start">
                    <p id="senha-esqueceu" class="mb-2">Não tem uma conta? <a href="cadastro.php" class="links">Cadastre-se</a></p>
                    <div id="texto-cadastro" class="aling-self-center"><a href="../index.php" class="links" >Voltar <i class="bi bi-caret-right-fill"></i></a></div>
                </div>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>