<?php
    // 1. Lê o arquivo JSON onde estão os usuários
    $dados = json_decode(file_get_contents('data_funcionario.json'), true);

    // 2. Pega os dados digitados no formulário (email e senha)
    $email = $_POST['email'] ?? ''; // se não vier nada, usa ''
    $senha = $_POST['senha'] ?? '';

    // Exibe as variáveis para depuração
    var_dump($dados);  // Verifica o conteúdo do JSON
    echo "Email enviado: " . $email . "<br>";
    echo "Senha enviada: " . $senha . "<br>";

    // 3. Cria uma "bandeira" pra saber se o login foi bem-sucedido
    $login_valido = false;

    // 4. Vai verificar todos os usuários do JSON, um por um
    foreach ($dados as $funcionario) {
        // Se o email E a senha forem iguais a algum do JSON, login OK
        if (strtolower($email) === strtolower($funcionario['email']) && strtolower($senha) === strtolower($funcionario['senha'])) {
            $login_valido = true;
            break; // já achou, pode parar de procurar
        }
    }

    // 5. Mostra o resultado
    if ($login_valido) {
        echo "✅ Login bem-sucedido!";
    } else {
        echo "❌ Login incorreto.";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="d-flex">
    <div class="container" id="fundo">
    </div>
    <main class="container">
    <main class="container" id="login">
        <h1>Login</h1>
        <form action="#" method="POST" class="form col-sm-6">
        <form action="php-t.php" method="POST" class="form col-sm-6">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required />

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control"  required />

            <button type="submit" class="btn btn-sm btn-success mt-3">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></p>
    </main>

    <script src="script.js"></script>
</body>
</html>