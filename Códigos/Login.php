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
        <h1>Login</h1>
        <form action="#" method="POST" class="form col-sm-6">
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