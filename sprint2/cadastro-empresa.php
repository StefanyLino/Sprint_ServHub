<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Cadastro Empresa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Empresa</h1>
        <form method="post" action="salvar-empresa.php">
            <div>
                <label for="nome">Nome</label>
                <input type="text" placeholder="Nome da empresa" id="nome_empresa" name="nome_empresa" required class="form-control">
            </div>
            <div>
                <label for="email" >Emial</label>
                <input type="email" placeholder="Digite o Email comercial" id="emial_empresa" name="email_empresa" required class="form-control">
            </div>
            <div>
                <label for="senha">Senha</label>
                <input type="password" min="8" placeholder="Digite seu senha" id="senha_empresa" name="senha_empresa" required class="form-control">
            </div>
            <div>
                <label for="cnpj">CNPJ</label>
                <input type="number" min="14" placeholder="CNPJ da empresa" id="cnpj" name="cnpj" required class="form-control">
            </div>
            <div>
                <label for="endereco">Endereço</label>
                <input type="text" placeholder="Endereço da empresa" id="endereco" name="endereco" required class="form-control">
            </div>
            <button type="submit" class="btn btn-submit bg-primary mt-3">Cadastre-se</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>