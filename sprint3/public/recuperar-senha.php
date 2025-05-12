<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <title>Recuperar Senha</title>
</head>
<body>
    <div class="d-flex col-sm-12" >
        <div class="container-fluid col-sm-6" id="fundo">
        </div>
        <main class="container col-sm-6 d-flex align-items-center justify-content-center flex-column" id="login">
            <section class="col-sm-9">
                <div>
                    <h1 class="mb-2">Esqueci minha senha</h1>
                    <p id="bem-vindo">Altere sua senha abaixo.</p>
                </div>
                <form action="#" method="POST" class="form">
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control input-custom shadow-sm" required />
                    </div>
                    <div>
                        <label for="nova-senha  "> Nova Senha:</label>
                        <input type="password" id="senha" name="nova-senha" class="form-control input-custom shadow-sm"  required />
                    </div>
                    <div>
                        <label for="confirmar-senha">Confirmar Senha:</label>
                        <input type="password" id="senha" name="confirmar-senha" class="form-control input-custom shadow-sm"  required />
                    </div>
                    <button type="submit" class="btn btn-submit mt-3 mb-3 w-100 " id="btn-custom"><a style="text-decoration: none; color:white" href="Login.php">Alterar Senha</a></button>
                </form>
                <div class="">
                    <a href="Login.php" class="links" >Voltar <i class="bi bi-caret-right-fill"></i></a>
                </div>
            </section>
        </main>
    </div>
<script src="script.js"></script>
</body>
</html>