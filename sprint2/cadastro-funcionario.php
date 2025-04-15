<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Cadastro Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .titulo{
        margin: 0 90px 20px; 
        font-weight: bold;
    }
</style>
<body id="login">
    <div class="d-flex col-sm-12">
        <div class="col-sm-5" id="fundo"></div>
        <div class="container col-sm-7 d-flex flex-column justify-content-center align-items-center">
            <div class="align-self-start titulo">
                <h1 class="mb-2">Funcionário</h1>
                <p id="bem-vindo">Seja bem vindo(a)! Realize seu cadastro!</p>
            </div>
            <form action="" class="col-sm-9">
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
                    <label for="atuacao" class="fw-normal">Área de atuação</label>
                    <input type="text" name="atuacao" id="atuacao" required class="form-control shadow-sm" placeholder="Digite sua area de atuação(Ex. Engenheiro, Medico e etc)">
                </div>
                <div>
                    <label for="servico" class="fw-normal">Valor de seu serviço</label>
                    <input type="text" name="servico" id="servico" required class="form-control shadow-sm" placeholder="Digite o valor do seu seviço">
                </div>
                <div>
                    <p class="fw-normal">Anexe seu currículo <button class="btn btn-submit btn-sm">Adicionar Arquivo</button></p>
                </div>
                <button class="btn btn-submit w-100" id="btn-custom">cadastrar-se</button>
            </form>
        </div>
    </div>

<script src="script.js"></script>
</body>
</html>