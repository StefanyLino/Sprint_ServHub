<?php
// Corrigir o caminho do arquivo JSON para usar __DIR__
$dados = json_decode(file_get_contents(__DIR__ . '/../data/data_funcionario.json'), true);
$usuario = json_decode(file_get_contents(__DIR__ . '/../data/usuarios.json'), true);
$funcionarios = json_decode(file_get_contents(__DIR__ . '/../data/funcionarios.json'), true);

// verifica se deu certo a comverção
if (!is_array($dados)){
    $dados = [];
}
if (!is_array($funcionarios)) {
    $funcionarios = [];
}

// Codificar a senha antes de salvar
$senhaCodificada = password_hash($_POST["senha_funcionario"], PASSWORD_DEFAULT);

// adiciona as informações do form as respectivas categorias
$novoDado = [
    "nome" => $_POST["nome_funcionario"],
    "email" => $_POST["email_funcionario"],
    "senha" => $senhaCodificada, // Senha codificada
    "cpf" => $_POST["cpf"],
    "endereco" => $_POST["atuacao"],
    "descricao" => "",
    "experiencia" => $_POST["nivel-experiencia"],
    "path" => "",
    "filename"=> "",
    "uploaded_at"=> "",

];

// adiciona as informações do form as respectivas categorias
$novoUsuario = [
    "username" => $_POST["email_funcionario"],
    "perfil" => "funcionario",
    "password" => $senhaCodificada // Senha codificada
];

$novoFuncionario = [
    "tipo" => $_POST["nivel-experiencia"],
    "nome" => $_POST["nome_funcionario"],
    "experiencia" => $_POST["nivel-experiencia"],
    "disponivel" => true
];

// adiciona os novos dados aos já existentes
if (strlen($_POST["nome_funcionario"])) {
    $dados[] = $novoDado;

    // transforma os dados novamente em JSON e salva no arquivo data_empresa.json
    file_put_contents(__DIR__ . '/../data/data_funcionario.json', json_encode($dados, JSON_PRETTY_PRINT));

    // Adicionar o novo usuário ao array de usuários
    $usuario[] = $novoUsuario;

    // transforma os dados novamente em JSON e salva no arquivo usuarios.json
    file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($usuario, JSON_PRETTY_PRINT));

    // Adicionar o novo funcionário ao array de funcionários
    $funcionarios[] = $novoFuncionario;

    // Salvar o array atualizado em funcionarios.json
    file_put_contents(__DIR__ . '/../data/funcionarios.json', json_encode($funcionarios, JSON_PRETTY_PRINT));

    echo "dados salvos com sucesso ! <a href='cadastro-empresa.php'>voltar </a>";
} else {
    echo "Erro: os dados não foram salvos! <a href='cadastro-empresa.php'>voltar </a>";
}


?>
 <script>
    setTimeout(() => {
      window.location.href = "Login.php"; 
    }, 0); 
</script>
