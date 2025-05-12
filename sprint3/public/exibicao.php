<?php

    // incluir o autoload
    require_once __DIR__ . '/../vendor/autoload.php';

    // incluir o arquivo com as variáveis
    require_once __DIR__ . '/../config/config.php';

    session_start();

    // importar as classes Locadora e Auth
    use Services\{Locadora, Auth};

    // inportar as classes Carro e moto
    use Models\{funcionario};

    // Verifica se o usuário está logado
    if(!Auth::verificarLogin()){
        header('Location: login.php');
        exit;
    }

    // Condição para logout
    if(isset($_GET['logout'])){
        (new Auth())->logout();
        header('Location: login.php');
        exit;   
    }

    // Criar uma instância da classe Locadora
    $locadora = new Locadora();

    $mensagem = '';

    $usuario = Auth::getUsuario();

    // veriifica os dados do formupario via POST
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // verificar se requer permissão de administrador
        if(isset($_POST['deletar']) || isset($_POST['alugar']) || isset($_POST['devolver'])){

            if(!Auth::isAdmin()){
                $mensagem = "Você não tem permissão para realizar essa ação.";
                goto renderizar;
            }
        }

       if(isset($_POST['alugar'])){
            $dias = isset($_POST['dias']) ? (int)$_POST['dias'] :1;
            $mensagem = $locadora->alugarFuncionario($_POST['email'], $dias);
        }
        elseif(isset($_POST['devolver'])){
            $mensagem = $locadora->devolverFuncionario($_POST['email']);
        }
        elseif(isset($_POST['deletar'])){
            $mensagem = $locadora->deletarVeiculo($_POST['email'], $_POST['preco']);
        }
        // Ajustar a chamada para calcularPrevisaoAluguel para incluir o email do funcionário.
        elseif(isset($_POST['calcular'])){
            $dias = (int)$_POST['dias_calculo'];
            $tipo = $_POST['tipo_calculo'] ?? 'funcionario';
            $email = $_POST['email_funcionario']; // Obter o email do funcionário selecionado
            $valor = $locadora->calcularPrevisaoAluguel($dias, $tipo, $email);

            $mensagem = "Previsão de valor para {$dias} dias: R$ " . number_format($valor, 2, ',', '.');
        }

    }

    renderizar:
    require_once __DIR__ . '/../views/template.php';