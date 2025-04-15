<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Cadastro Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Funcionário</h1>
        <p>Seja bem vindo(a)!Realize seu cadastro!</p>
        <form action="">
            <div>
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome_funcionario" id="nome_funcionario" required class="form-control" placeholder="Digite seu nome">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email_funcionario" id="email_funcionario" required class="form-control" placeholder="Digite seu email">
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" min="8" name="senha_funcionario" id="senha_funcionario" required class="form-control" placeholder="Digite sua senha">
            </div>
            <div>
                <label for="cpf">CPF:</label>
                <input type="number" min="11" name="cpf" id="cpf" required class="form-control" placeholder="Digite seu CPF">
            </div>
            <div>
                <label for="atuacao">Área de atuação</label>
                <input type="text" name="atuacao" id="atuacao" required class="form-control" placeholder="Digite sua area de atuação(Ex. Engenheiro, Medico e etc">
            </div>
            <div>
                <label for="servico">Valor de seu serviço</label>
                <input type="text" name="servico" id="servico" required class="form-control" placeholder="Digite o valor do seu seviço">
            </div>
        </form>
    </div>

<script src="script.js"></script>
</body>
</html>