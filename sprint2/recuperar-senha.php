<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Esqueci Minha Senha</h1>
    <p style="text-align: center;">Recupere a Senha</p>

    <form action="#" method="POST" class="form">
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" placeholder="Digite aqui..." required />

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" placeholder="Digite aqui..." required />

      <label for="nova-senha">Nova Senha:</label>
      <input type="password" id="nova-senha" name="nova-senha" placeholder="Digite aqui..." required />

      <label for="confirmar-senha">Confirmação de Senha:</label>
      <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Digite aqui..." required />

      <button type="submit">Enviar</button>
    </form>

    <p style="text-align:center; margin-top:20px;">
      <a href="index.html">Sair</a>
    </p>
  </div>

<script src="script.js"></script>
</body>
</html>