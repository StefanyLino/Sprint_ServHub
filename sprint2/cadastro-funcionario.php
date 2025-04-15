<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Cadastro Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="d-flex col-sm-12">
        <div class="col-sm-5"></div>
        <div class="container col-sm-7 mt-2 d-flex flex-column align-items-center">
            <h1 class="align-self-start titulo fw-bold">Funcionário</h1>
            <p class="align-self-start fw-normal">Seja bem vindo(a)! Realize seu cadastro!</p>
            <form action="" class="col-sm-8">
                <div>
                    <label for="nome" class="fw-normal mt-1">Nome completo:</label>
                    <input type="text" name="nome_funcionario" id="nome_funcionario" required class="form-control shadow-sm" placeholder="Digite seu nome">
                </div>
                <div>
                    <label for="email" class="fw-normal mt-1">Email:</label>
                    <input type="email" name="email_funcionario" id="email_funcionario" required class="form-control shadow-sm" placeholder="Digite seu email">
                </div>
                <div>
                    <label for="senha" class="fw-normal mt-1">Senha:</label>
                    <input type="password" min="8" name="senha_funcionario" id="senha_funcionario" required class="form-control shadow-sm" placeholder="Digite sua senha">
                </div>
                <div>
                    <label for="cpf" class="fw-normal mt-1">CPF:</label>
                    <input type="number" min="11" name="cpf" id="cpf" required class="form-control shadow-sm" placeholder="Digite seu CPF">
                </div>
                <div>
                    <label for="atuacao" class="fw-normal mt-1">Área de atuação</label>
                    <input type="text" name="atuacao" id="atuacao" required class="form-control shadow-sm" placeholder="Digite sua area de atuação(Ex. Engenheiro, Medico e etc">
                </div>
                <div>
                    <label for="servico" class="fw-normal mt-1">Valor de seu serviço</label>
                    <input type="text" name="servico" id="servico" required class="form-control shadow-sm" placeholder="Digite o valor do seu seviço">
                </div>
                <div>
                    <p class="fw-normal">Anexe seu currículo <button class="btn btn-submit btn-sm">Adicionar Arquivo</button></p>
                </div>
                <button class="btn btn-submit btn-primary w-100 mt-1">cadastrar-se</button>
            </form>
        </div>
    </div>

<script src="script.js"></script>
</body>
</html>