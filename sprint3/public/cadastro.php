<?php
    include 'htmls/head.html';
?>
<body>
    <div class="d-flex col-sm-12 " >
        <div class="col-sm-6" id="fundo">
        </div>
        <main class="container col-sm-6 mt-8 d-flex align-items-center justify-content-center flex-column" id="login">
            <section class="col-sm-9 ms-2" id="form-login">
                <div class="align-self-start" id="texto-login">
                    <h1 class="mb-2">Cadastro</h1>
                    <p id="bem-vindo">Seja bem vindo(a)! Escolha uma opção abaixo.</p>
                </div>
                <div class="col-sm-10 d-flex flex-column align-items-center">
                    <a class="btn btn-submit w-100 p-3" id="btn-custom" style="margin-bottom: 30px; border-radius: 10px;" href="cadastro-empresa.php">Cadastre-se como Empresa</a>
                    <a class="btn btn-submit w-100 p-3 mb-2" id="btn-custom" style="border-radius: 10px;" href="cadastro-funcionario.php"> Cadastre-se como Funcionario</a>
                </div>
                <div id="texto-login"><a href="Index.php" class="links align-self-start">Voltar <i class="bi bi-caret-right-fill"></i></a></div>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>