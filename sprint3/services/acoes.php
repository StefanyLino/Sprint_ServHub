<?php
namespace Services;

use models\{pessoas, funcionario};
use services\auth;

// Classe para gerenciar a locação
class Locadora {
    private array $funcionarios = [];

    public function __construct()
    {
        $this->carregarFuncionarios();
    }

    private function carregarFuncionarios(): void
    {
        if (file_exists(pessoas_JSON)) {
            // Verifica se o arquivo JSON existe e carrega os dados
            $dados = json_decode(file_get_contents(pessoas_JSON), true);

            foreach ($dados as $dado) {
                if ($dado['profissao'] === 'funcionario') {
                    $funcionario = new funcionario($dado['funcao'], $dado['cpf']);
                    $funcionario->setDisponivel($dado['disponivel']);
                    $this->funcionarios[] = $funcionario;
                }
            }
        }
    }

    private function salvarFuncionarios(): void
    {
        $dados = [];

        foreach ($this->funcionarios as $funcionario) {
            $dados[] = [
                'profissao' => $funcionario->getProfissao(),
                'cpf' => $funcionario->getCpf(),
                'disponivel' => $funcionario->isDisponivel()
            ];
        }

        $dir = dirname(pessoas_JSON);

        // Verifica se o diretório existe, se não existir cria o diretório
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents(pessoas_JSON, json_encode($dados, JSON_PRETTY_PRINT));
    }

    public function adicionarFuncionario(funcionario $funcionario): void
    {
        $this->funcionarios[] = $funcionario;
        $this->salvarFuncionarios();
    }

    public function deletarFuncionario(string $cpf): string
    {
        foreach ($this->funcionarios as $key => $funcionario) {
            if ($funcionario->getCpf() === $cpf) {
                unset($this->funcionarios[$key]); // Remove o funcionário do array
                $this->funcionarios = array_values($this->funcionarios); // Reindexa o array
                $this->salvarFuncionarios(); // Salva as alterações no arquivo JSON
                return "Funcionário com CPF '{$cpf}' removido com sucesso!";
            }
        }

        return "Funcionário com CPF '{$cpf}' não encontrado!";
    }

    public function alugarFuncionario(string $cpf, int $dias = 1): string
    {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getCpf() === $cpf && $funcionario->isDisponivel()) {
                $valorAluguel = $funcionario->calcularAluguel($dias);

                // Marcar como alugado
                $mensagem = $funcionario->alugar();

                $this->salvarFuncionarios(); // Salva as alterações no arquivo JSON
                return "{$mensagem}, Funcionário '{$funcionario->getProfissao()}' alugado por {$dias} dias. Valor total: R$" . number_format($valorAluguel, 2, ',', '.');
            }
        }

        return "Funcionário com CPF '{$cpf}' não está disponível para contratação!";
    }

    public function devolverFuncionario(string $cpf): string
    {
        foreach ($this->funcionarios as $funcionario) {
            if ($funcionario->getCpf() === $cpf && !$funcionario->isDisponivel()) {
                $mensagem = $funcionario->devolver(); // Marca como devolvido
                $this->salvarFuncionarios(); // Salva as alterações no arquivo JSON
                return "{$mensagem}, Funcionário com CPF '{$cpf}' devolvido com sucesso!";
            }
        }

        return "Funcionário com CPF '{$cpf}' não encontrado ou já devolvido!";
    }

    public function listarFuncionarios(): array
    {
        return $this->funcionarios;
    }
}
?>