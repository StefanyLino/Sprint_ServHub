<?php
//converte o json para um array válido - lê o conteudo do arquivo(dentro do parenteses)
    $dados = json_decode(file_get_contents("data_empresa.json"), true);

    // verifica se deu certo a comverção
    if (!is_array($dados)){
        $dados = [];
    }

    $config = json_decode(file_get_contents('config.json'), true);
    $cnpj = $_POST['cnpj'];
    $senha = $_POST['senha_empresa'];

    // adiciona as informações do form as respectivas categorias
    $novoDado = [
        "nome" => $_POST["nome_empresa"],
        "email" => $_POST["email_empresa"],
        "senha" => $_POST["senha_empresa"],
        "cnpj" => $_POST["cnpj"],
        "endereco" => $_POST["endereco"]

    ];

    

    // adiciona os novos dados aos já existentes
    if(strlen($cnpj) > $config['cnpj_minimo']){
        if(strlen($senha) > $config['senha_minima']){
            $dados [] = $novoDado;

            // tranforma os dados novamente em json
            file_put_contents("data_empresa.json", json_encode($dados, JSON_PRETTY_PRINT));

            echo "dados salvos com sucesso ! <a href='cadastro-empresa.php'>voltar </a>";
        }else{
            echo "A senha deve conter no minimo 8 caracteres ! <a href='cadastro-empresa.php'>voltar </a>";
        }
    }else{
        echo "CNPJ Incorreto, o CNPJ informado não contem o número minimo de caracteres ! <a href='cadastro-empresa.php'>voltar </a>";
    }

    
    exit();
?>