<?php
namespace Services;

use Models\{Pessoa, Inicial, Experiente, Senior};

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
                    $pessoa = new pessoa($dado['nome'], $dado['experiencia']); // Alterado de 'email' e 'placa/preco' para 'nome' e 'experiencia'
                    $this->funcionarios[] = $pessoa;
                } 
            }
        }
    }

    private function salvarFuncionarios(): void {
        $dados = [];

        foreach ($this->funcionarios as $funcionario) {
            $dados[] = [
                'tipo' => ($funcionario instanceof funcionario) ? 'funcionario' : 'pessoa',
                'nome' => $funcionario->getNome(), // Alterado de 'getEmail' para 'getNome'
                'experiencia' => $funcionario->getExperiencia(), // Alterado de 'getPreco' para 'getExperiencia'
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
    public function deletarVeiculo(string $nome, string $experiencia): string { // Alterado de 'email' e 'preco' para 'nome' e 'experiencia'
        // Ajustar a comparação para garantir que os tipos sejam consistentes.
        foreach ($this->funcionarios as $key => $funcionario) {
            $nomeFuncionario = trim($funcionario->getNome()); // Alterado de 'getEmail' para 'getNome'
            $experienciaFuncionario = (string) $funcionario->getExperiencia(); // Alterado de 'getPreco' para 'getExperiencia'
            error_log("Comparando: nome={$nomeFuncionario} experiencia={$experienciaFuncionario} com nome={$nome} experiencia={$experiencia}");
            if ($nomeFuncionario === $nome && $experienciaFuncionario === $experiencia) {
                unset($this->funcionarios[$key]);
                $this->funcionarios = array_values($this->funcionarios); // Reorganizar os índices
                $this->salvarFuncionarios();
                return "Funcionario '{$nome}' removido com sucesso!";
            }
        }
        return "Funcionario não encontrado!";
    }

    // Alugar veículo por n dias
    public function alugarFuncionario(string $nome, int $dias = 1): string { // Alterado de 'email' para 'nome'
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getNome() === $nome && $funcionario->isDisponivel()) { // Alterado de 'getEmail' para 'getNome'
                $valorAluguel = $funcionario->calcularAluguel($dias);
                $mensagem = $funcionario->alugar();
                $this->salvarFuncionarios();
                return $mensagem . " Valor do aluguel: R$ " . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Funcionario não disponível.";
    }

    // Devolver veículo
    public function devolverFuncionario(string $nome): string { // Alterado de 'email' para 'nome'
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getNome() === $nome && !$funcionario->isDisponivel()) { // Alterado de 'getEmail' para 'getNome'
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
    public function calcularPrevisaoAluguel(int $dias, string $tipo, string $nome): float { // Alterado de 'email' para 'nome'
        if ($tipo === 'funcionario') {
            foreach ($this->funcionarios as $funcionario) {
                if ($funcionario->getNome() === $nome) { // Alterado de 'getEmail' para 'getNome'
                    return $dias * $funcionario->getExperiencia(); // Alterado de 'getPreco' para 'getExperiencia'
                }
            }
            throw new RuntimeException("Funcionário com nome {$nome} não encontrado.");
        }
        throw new InvalidArgumentException("Tipo de cálculo inválido: {$tipo}");
    }
}