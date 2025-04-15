<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Cadastre-se</h1>
    <form action="#" method="POST" class="form">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required />

      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required />

      <label for="telefone">Telefone:</label>
      <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone" required />

      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required />

      <label for="confirmar-senha">Confirme sua senha:</label>
      <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Digite sua senha novamente" required />

      <button type="submit">Cadastrar</button>
    </form>

    <p style="text-align:center; margin-top:20px;">
      <a href="index.html">Voltar</a>
    </p>
  </div>

<script src="script.js"></script>
</body>
</html>