<?php
namespace Services;

use Models\{funcionario, pessoa};

// Classe para gerenciar a locação
class Locadora {
    private array $funcionarios = [];

    public function __construct() {
        $this->carregarFuncionarios();
    }

    // Adicionar logs para depuração ao carregar e salvar funcionários.
    private function carregarFuncionarios(): void {
        if (file_exists(ARQUIVO_JSON)) {
            $dados = json_decode(file_get_contents(ARQUIVO_JSON), true);
            error_log("Carregando dados do JSON: " . print_r($dados, true));

            foreach ($dados as $dado) {
                if ($dado['tipo'] === 'funcionario') {
                    $funcionario = new funcionario($dado['email'], $dado['placa']);
                    $this->funcionarios[] = $funcionario;
                } 
            }
        }
    }

    private function salvarFuncionarios(): void {
        $dados = [];

        foreach ($this->funcionarios as $funcionario) {
            $dados[] = [
                'tipo' => ($funcionario instanceof funcionario) ? 'funcionario' : 'pessoa',
                'email' => $funcionario->getEmail(),
                'placa' => $funcionario->getPreco(),
                'disponivel' => $funcionario->isDisponivel()
            ];
        }

        error_log("Salvando dados no JSON: " . print_r($dados, true));

        $dir = dirname(ARQUIVO_JSON);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // Remover veículo
    public function deletarVeiculo(string $email, string $preco): string {
        // Ajustar a comparação para garantir que os tipos sejam consistentes.
        foreach ($this->funcionarios as $key => $funcionario) {
            $emailFuncionario = trim($funcionario->getEmail());
            $precoFuncionario = (string) $funcionario->getPreco();
            error_log("Comparando: email={$emailFuncionario} preco={$precoFuncionario} com email={$email} preco={$preco}");
            if ($emailFuncionario === $email && $precoFuncionario === $preco) {
                unset($this->funcionarios[$key]);
                $this->funcionarios = array_values($this->funcionarios); // Reorganizar os índices
                $this->salvarFuncionarios();
                return "Funcionario '{$email}' removido com sucesso!";
            }
        }
        return "Funcionario não encontrado!";
    }

    // Alugar veículo por n dias
    public function alugarFuncionario(string $email, int $dias = 1): string {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getEmail() === $email && $funcionario->isDisponivel()) {
                $valorAluguel = $funcionario->calcularAluguel($dias);
                $mensagem = $funcionario->alugar();
                $this->salvarFuncionarios();
                return $mensagem . " Valor do aluguel: R$ " . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Funcionario não disponível.";
    }

    // Devolver veículo
    public function devolverFuncionario(string $email): string {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getEmail() === $email && !$funcionario->isDisponivel()) {
                $mensagem = $funcionario->devolver();
                $this->salvarFuncionarios();
                return $mensagem;
            }
        }
        return "Funcionario já disponível ou não encontrado.";
    }

    // Retorna a lista de veículos
    public function listarFuncionarios(): array {
        return $this->funcionarios;
    }

    // Ajustar a função calcularPrevisaoAluguel para usar o email do funcionário enviado no formulário.
    public function calcularPrevisaoAluguel(int $dias, string $tipo, string $email): float {
        if ($tipo === 'funcionario') {
            foreach ($this->funcionarios as $funcionario) {
                if ($funcionario->getEmail() === $email) {
                    return $dias * $funcionario->getPreco();
                }
            }
            throw new RuntimeException("Funcionário com email {$email} não encontrado.");
        }
        throw new InvalidArgumentException("Tipo de cálculo inválido: {$tipo}");
    }
}