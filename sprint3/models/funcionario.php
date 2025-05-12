<?php
namespace Models;
use Interfaces\locavel;

// Classe que representa um funcionario
class funcionario extends Pessoa implements Locavel {
    private $data; // Propriedade para armazenar os dados do JSON

    // Ajustar o construtor para aceitar parâmetros e inicializar os dados corretamente.
    public function __construct(string $email, float $preco)
    {
        $this->data = [
            'email' => $email,
            'preco' => $preco
        ];
        $this->disponivel = true; // Inicializar como disponível
    }

    public function calcularAluguel(int $dias): float
    {
        return $dias * $this->data['preco'];
    }

    public function alugar(): string
    {
        if ($this->disponivel) {
            $this->disponivel = false;
            return "Funcionario '{$this->data['email']}' contratado com sucesso!";
        }
        return "Funcionario '{$this->data['email']}' já está contratado";
    }

    public function devolver(): string
    {
        if (!$this->disponivel) {
            $this->disponivel = true;
            return "Funcionario '{$this->data['email']}' teve seu expediente finalizado com sucesso!";
        }
        return "Funcionario '{$this->data['email']}' disponível para contratação";
    }

    // Adicionar os métodos getEmail e getPreco para acessar os dados do funcionário.
    public function getEmail(): string {
        return $this->data['email'] ?? '';
    }

    public function getPreco(): float {
        return $this->data['preco'] ?? 0.0;
    }
}
?>