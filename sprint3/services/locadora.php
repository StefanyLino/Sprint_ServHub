<?php
namespace Services;

use Models\{Pessoa, Iniciante, Experiente, Senior, Intermediario, Avancado};

// Classe para gerenciar a locação
class Locadora {
    private array $funcionarios = [];

    public function __construct() {
        $this->carregarFuncionarios();
    }

    // Adicionar logs para depuração ao carregar e salvar funcionários.
    private function carregarFuncionarios(): void {
        $dados = json_decode(file_get_contents(__DIR__ . '/../data/funcionarios.json'), true);

        foreach ($dados as $funcionario) {
            $experiencia = strtolower($funcionario['experiencia']);
            $nome = $funcionario['nome'];
            $disponivel = $funcionario['disponivel'];

            if ($experiencia === 'iniciante') {
                $this->funcionarios[] = new Iniciante($nome, '', 1, $disponivel);
            } elseif ($experiencia === 'experiente') {
                $this->funcionarios[] = new Experiente($nome, '', 3, $disponivel);
            } elseif ($experiencia === 'senior') {
                $this->funcionarios[] = new Senior($nome, '', 5, $disponivel);
            }
        }
    }

    private function salvarFuncionarios(): void {
        $dados = [];

        foreach ($this->funcionarios as $funcionario) {
            $dados[] = [
                'tipo' => ($funcionario instanceof Iniciante) ? 'iniciante' : (($funcionario instanceof Experiente) ? 'experiente' : 'senior'),
                'nome' => $funcionario->getNome(),
                'experiencia' => strtolower($funcionario->getNivelExperiencia()),
                'disponivel' => $funcionario->isDisponivel()
            ];
        }

        error_log("Salvando dados no JSON: " . print_r($dados, true));

        $arquivoJson = __DIR__ . '/../data/funcionarios.json';

        file_put_contents($arquivoJson, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // Remover funcionário
    public function removerFuncionario(string $nome): string {
        foreach ($this->funcionarios as $key => $funcionario) {
            if ($funcionario->getNome() === $nome) {
                unset($this->funcionarios[$key]);
                $this->funcionarios = array_values($this->funcionarios); // Reorganizar os índices
                $this->salvarFuncionarios();
                return "Funcionário '{$nome}' removido com sucesso!";
            }
        }
        return "Erro: Funcionário '{$nome}' não encontrado.";
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

    // Calcular previsão do valor de aluguel
    public function calcularPrevisaoAluguel(int $dias, string $tipo): float {
        $tipo = strtolower($tipo); // Normalizar o tipo para minúsculas

        if ($tipo === 'iniciante') {
            return (new Iniciante('', '', 1))->calcularAluguel($dias);
        } elseif ($tipo === 'experiente') {
            return (new Experiente('', '', 3))->calcularAluguel($dias);
        } elseif ($tipo === 'senior') {
            return (new Senior('', '', 5))->calcularAluguel($dias);
        }

        throw new \InvalidArgumentException("Tipo de funcionário inválido.");
    }

    public function alocarFuncionario(string $nome, int $dias): string {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getNome() === $nome && $funcionario->isDisponivel()) {
                $valorAluguel = $funcionario->calcularAluguel($dias);
                $funcionario->alugar();
                $this->salvarFuncionarios();
                return "Funcionário '{$nome}' alugado por {$dias} dias. Valor total: R$ " . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Erro: Funcionário '{$nome}' não encontrado ou indisponível.";
    }

    public function liberarFuncionario(string $nome): string {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getNome() === $nome && !$funcionario->isDisponivel()) {
                $mensagem = $funcionario->devolver();
                $this->salvarFuncionarios();
                return $mensagem;
            }
        }
        return "Erro: Funcionário '{$nome}' já está disponível ou não foi encontrado.";
    }
}