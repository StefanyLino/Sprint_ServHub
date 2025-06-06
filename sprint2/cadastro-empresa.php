<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Cadastro Empresa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .titulo{
            margin: 0 90px 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="d-flex col-sm-12">
        <div class="col-sm-5" id="fundo"></div>
        <div class="container col-sm-7 d-flex flex-column align-items-center justify-content-center" id="login">
            <div class="align-self-start titulo">
                <h1 class="mb-2">Empresa</h1>
                <p id="bem-vindo">Seja bem vindo(a)! Realize seu cadastro!</p>
            </div>
            <form method="post" action="salvar-empresa.php" class="col-sm-9 ">
                <div class="mb-2">
                    <label for="nome">Nome</label>
                    <input type="text" placeholder="Nome da empresa" id="nome_empresa" name="nome_empresa" required class="form-control shadow-sm">
                </div>
                <div class="mb-2">
                    <label for="email" >Email</label>
                    <input type="email" placeholder="Digite o Email comercial" id="emial_empresa" name="email_empresa" required class="form-control shadow-sm">
                </div>
                <div class="mb-2">
                    <label for="senha">Senha</label>
                    <input type="password" min="8" placeholder="Digite seu senha" id="senha_empresa" name="senha_empresa" required class="form-control shadow-sm">
                </div>
                <div  class="mb-2">
                    <label for="cnpj">CNPJ</label>
                    <input type="number" min="14" placeholder="CNPJ da empresa" id="cnpj" name="cnpj" required class="form-control shadow-sm">
                </div>
                <div class="mb-2">
                    <label for="endereco">Endereço</label>
                    <input type="text" placeholder="Endereço da empresa" id="endereco" name="endereco" required class="form-control shadow-sm">
                </div>
                <button type="submit" class="btn btn-submit mt-3 w-100 " id="btn-custom">Cadastre-se</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>