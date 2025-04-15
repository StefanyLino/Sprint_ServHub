<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>
<style>
    .titulo{
    margin: 0 90px 40px;
    font-weight: bold;
}
</style>
<body>
    <div class="d-flex col-sm-12 " >
        <div class="container col-sm-5" id="fundo">
        </div>
        <main class="container col-sm-7 mt-8 d-flex align-items-center justify-content-center flex-column" id="login">
            <div class="align-self-start titulo">
                <h1 class="mb-2">Cadastro</h1>
                <p id="bem-vindo">Seja bem vindo(a)! Escolha uma opção abaixo.</p>
            </div>
            <div class="col-sm-9 d-flex flex-column align-items-center">
                <a class="btn btn-submit w-100 p-3" id="btn-custom" style="margin-bottom: 50px; border-radius: 10px;" href="cadastro-empresa.php">Cadastre-se como Empresa</a>
                <a class="btn btn-submit w-100 p-3" id="btn-custom" style="border-radius: 10px;" href="cadastro-funcionario.php"> Cadastre-se como Funcionario</a>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>