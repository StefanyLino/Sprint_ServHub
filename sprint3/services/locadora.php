<?php
namespace Services;

use Models\{Pessoa, Iniciante, Experiente, Senior};

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

    private function salvarFuncionariosData(): void {
        $arquivoJson = __DIR__ . '/../data/data_funcionario.json';

        // Carrega os dados atuais
        $dadosAtuais = [];
        if (file_exists($arquivoJson)) {
            $dadosAtuais = json_decode(file_get_contents($arquivoJson), true);
            if (!is_array($dadosAtuais)) {
                $dadosAtuais = [];
            }
        }

        // Reorganiza para acesso fácil por nome
        $mapaDados = [];
        foreach ($dadosAtuais as $item) {
            if (isset($item['nome'])) {
                $mapaDados[$item['nome']] = $item;
            }
        }

        // Atualiza ou adiciona os dados
        foreach ($this->funcionarios as $funcionario) {
            $nome = $funcionario->getNome();

            $tipo = $funcionario->getTipo();

            // Mantém dados antigos ou cria novo
            $mapaDados[$nome]['nome'] = $nome;
            $mapaDados[$nome]['experiencia'] = $tipo; 
            $mapaDados[$nome]['disponivel'] = $funcionario->isDisponivel();
        }


        // Salva de volta como array
        $dadosParaSalvar = array_values($mapaDados);

        error_log("Salvando dados no JSON: " . print_r($dadosParaSalvar, true));

        file_put_contents($arquivoJson, json_encode($dadosParaSalvar, JSON_PRETTY_PRINT));
    }

    // Remover funcionário
    public function removerFuncionario(string $nome): string {
        $removido = false;

        // Remove da lista de funcionários
        foreach ($this->funcionarios as $key => $funcionario) {
            if ($funcionario->getNome() === $nome) {
                unset($this->funcionarios[$key]);
                $this->funcionarios = array_values($this->funcionarios);
                $this->salvarFuncionarios();
                $removido = true;
                break;
            }
        }

        if (!$removido) {
            return "Erro: Funcionário '{$nome}' não encontrado.";
        }

        // Arquivos onde também será removido
        $arquivos = [
            __DIR__ . '/../data/usuario.json',
            __DIR__ . '/../data/data_funcionario.json'
        ];

        foreach ($arquivos as $arquivo) {
            $this->removerDeArquivo($nome, $arquivo);
        }

        return "Funcionário '{$nome}' removido com sucesso de todos os arquivos!";
    }


    private function removerDeArquivo(string $nome, string $caminhoArquivo): void {
        if (!file_exists($caminhoArquivo)) {
            return; // Arquivo não existe, então não precisa fazer nada
        }

        $dados = json_decode(file_get_contents($caminhoArquivo), true);

        if (!is_array($dados)) {
            return; // Dados inválidos, evita erro
        }

        // Remove todos os registros que tenham o mesmo nome
        $dados = array_filter($dados, function($item) use ($nome) {
            return !(isset($item['nome']) && $item['nome'] === $nome);
        });

        // Reorganiza os índices
        $dados = array_values($dados);

        // Salva novamente
        file_put_contents($caminhoArquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }


    // Contratar funcionario por n dias
    public function alugarFuncionario(string $nome, string $tipo, int $dias = 1): string {
        foreach ($this->funcionarios as $key => $funcionario) {
            if ($funcionario->getNome() === $nome && $funcionario->isDisponivel()) {
                if($tipo === 'iniciante') {
                    $valorAluguel = (new Iniciante('', '', 1))->calcularAluguel($dias);
                } elseif ($tipo === 'experiente') {
                    $valorAluguel = (new Experiente('', '', 3))->calcularAluguel($dias);
                } elseif ($tipo === 'senior') {
                    $valorAluguel = (new Senior('', '', 5))->calcularAluguel($dias);
                } else {
                    return "Tipo de funcionário inválido.";
                }
                $mensagem = $funcionario->alugar();
                // Atualiza o funcionário na lista para manter a alteração
                $this->funcionarios[$key] = $funcionario;
                $this->salvarFuncionariosData($tipo);
                return $mensagem . " Valor do aluguel: R$ " . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Funcionário não disponível ou não encontrado.";
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