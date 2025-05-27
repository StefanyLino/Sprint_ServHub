<?php


    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // incluir o autoload
    require_once __DIR__ . '/../vendor/autoload.php';

    // incluir o arquivo com as variáveis
    require_once __DIR__ . '/../config/config.php';

    session_start();

    // importar as classes Locadora e Auth
    use Services\{Locadora, Auth};

    // inportar as classes Carro e Moto
    use Models\{Inicial, Experiente, Senior};

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

    // veriifica os dados do formulario via POST
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // verificar se requer permissão de administrador
        if(isset($_POST['deletar']) || isset($_POST['alugar']) || isset($_POST['devolver'])){

            if(!Auth::isAdmin()){
                $mensagem = "Você não tem permissão para realizar essa ação.";
                goto renderizar;
            }
        }

        if(isset($_POST['adicionar'])){
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $tipo = $_POST['tipo'] ?? '';

            if (empty($nome) || empty($email) || empty($tipo)) {
                $mensagem = "Erro: Todos os campos são obrigatórios para adicionar um funcionário.";
            } 
        }
        elseif(isset($_POST['alugar'])){
            $nome = $_POST['nome'] ?? '';
            $dias = isset($_POST['dias']) ? (int)$_POST['dias'] : 1;

            if (empty($nome)) {
                $mensagem = "Erro: O nome do funcionário é obrigatório para alocar.";
            } else {
                $mensagem = $locadora->alocarFuncionario($nome, $dias);
            }
        }
        elseif(isset($_POST['devolver'])){
            $nome = $_POST['nome'] ?? '';

            if (empty($nome)) {
                $mensagem = "Erro: O nome do funcionário é obrigatório para liberar.";
            } else {
                $mensagem = $locadora->liberarFuncionario($nome);
            }
        }
        elseif(isset($_POST['deletar'])){
            $nome = $_POST['nome'] ?? '';

            if (empty($nome)) {
                $mensagem = "Erro: O nome do funcionário é obrigatório para remover.";
            } else {
                $mensagem = $locadora->removerFuncionario($nome);
            }
        }
        elseif(isset($_POST['calcular'])){
            $dias = (int)$_POST['dias_calculo'];
            $tipo = $_POST['tipo_calculo'] ?? '';

            // Verificar se o tipo selecionado é válido
            if (!in_array($tipo, ['iniciante', 'experiente', 'senior'])) {
                $mensagem = "Erro: Tipo de funcionário inválido.";
            } else {
                $valor = $locadora->calcularPrevisaoAluguel($dias, $tipo);
                $mensagem = "Previsão de trabalho para {$dias} dias ({$tipo}): R$ " . number_format($valor, 2, ',', '.');
            }
        }

    }

    renderizar:
    require_once __DIR__ . '/../public/accountpage.php';