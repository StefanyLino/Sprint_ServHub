


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="d-flex col-sm-12 " >
        <div class="container col-sm-5" id="fundo">
        </div>
        <main class="container col-sm-7 mt-8 d-flex align-items-center flex-column">
            <h1 class="titulo align-self-start">Login</h1>
            <form action="#" method="POST" class="form col-sm-8">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control input-custom" required />
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" class="form-control input-custom"  required />
                </div>
                <button type="submit" class="btn btn-submit btn-success mt-3 mb-3 w-100">Entrar</button>
            </form>
            <p>Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></p>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>