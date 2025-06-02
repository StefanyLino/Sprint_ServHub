<?php
    include 'htmls/head.html';
?>
<body id="login">
    <div class="d-flex col-sm-12">
        <div class="col-sm-6" id="fundo"></div>
        <div class="container col-sm-6 d-flex flex-column align-items-center justify-content-center">
            <section class="col-sm-9" id="form-login">
                <div class="align-self-start" id="texto-cadastro">
                    <h1 class="mb-2">Empresa</h1>
                    <p id="bem-vindo">Seja bem vindo(a)! Realize seu cadastro!</p>
                </div>
                <form class="w-100" method="post" action="salvar-empresa.php">
                    <div>
                        <label for="nome" class="fw-normal">Nome:</label>
                        <input type="text" placeholder="Nome da empresa" id="nome_empresa" name="nome_empresa" required class="form-control shadow-sm">
                    </div>
                    <div>
                        <label for="email" class="fw-normal">Email:</label>
                        <input type="email" placeholder="Digite o Email comercial" id="email_empresa" name="email_empresa" required class="form-control shadow-sm">
                    </div>
                    <div>
                        <label for="senha" class="fw-normal">Senha:</label>
                        <input type="password" min="8" placeholder="Digite seu senha" id="senha_empresa" name="senha_empresa" required class="form-control shadow-sm">
                    </div>
                    <div>
                        <label for="cnpj" class="fw-normal">CNPJ:</label>
                        <input type="number" min="14" placeholder="CNPJ da empresa" id="cnpj" name="cnpj" required class="form-control shadow-sm">
                    </div>
                    <div>
                        <label for="endereco" class="fw-normal">Endereço:</label>
                        <input type="text" placeholder="Endereço da empresa" id="endereco" name="endereco" required class="form-control shadow-sm">
                    </div>
                    <button type="submit" class="btn btn-submit mt-3 w-100  mb-2" id="btn-custom">Cadastre-se:</button>
                    <div id="texto-cadastro"><a href="cadastro.php" class="align-self-start links">Voltar <i class="bi bi-caret-right-fill"></i></a></div>
                </form>
            </section>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>