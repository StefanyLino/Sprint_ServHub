<?php
    include 'htmls/head.html';
?>
<body id="login">
    <div class="d-flex col-sm-12">
        <div class="col-sm-6" id="fundo"></div>
        <div class="container col-sm-6 d-flex flex-column justify-content-center align-items-center">
            <section class="col-sm-9" id="form-login">
                <div class="align-self-start" id="texto-cadastro">
                    <h1 class="mb-2">Funcionário</h1>
                    <p id="bem-vindo">Seja bem vindo(a)! Realize seu cadastro!</p>
                </div>
                <form action="salvar-funcionario.php" method="POST">
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
                        <label for="atuacao" class="fw-normal">Área de Atuação</label>
                        <input type="text" name="atuacao" id="atuacao" required class="form-control shadow-sm" placeholder="Digite sua area de atuação(Ex. Engenheiro, Medico e etc)">
                    </div>
                    <div>
                        <label for="experiencia" class="fw-normal">Nivel de Experiência</label>
                        <select class="form-control mb-2" name="nivel-experiencia" id="">
                            <option value="" disabled selected>Selecione seu nível de experiência</option>
                            <option value="iniciante">Iniciante</option>
                            <option value="experiente">Experiente</option>
                            <option value="senior">Sênior</option>
                        </select>
                    </div>
                    <button class="btn btn-submit w-100 mb-2" id="btn-custom">Cadastre-se</button>
                    <div id="texto-cadastro"><a href="cadastro.php" class="links">Voltar <i class="bi bi-caret-right-fill"></i></a></div>
                </form>
            </section>
        </div>
    </div>

    <script src="script.js"></script>

    <script>
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const select = form.querySelector('select[name="nivel-experiencia"]');
            if (select && (select.value === "" || select.value === "empty")) {
                e.preventDefault();
                alert("Por favor, selecione um tipo de veículo válido.");
            }
        });
    });
    </script>

</body>
</html>