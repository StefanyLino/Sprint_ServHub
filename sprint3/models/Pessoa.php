<?php
namespace models;

// Classe abstrata para todos ps tipos de veículos

abstract class Pessoa {
    protected string $funcao;
    protected string $cpf;
    protected bool $disponivel;

    public function __construct(string $funcao, string $cpf)
    {
        $this -> funcao = $funcao;
        $this -> cpf = $cpf;
        $this -> disponivel = true;
    }

    // Função para calculo do aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel():  bool {
        return $this->disponivel;
    }

    public function getFuncao():  string {
        return $this->funcao;
    }

    public function getCpf():  string {
        return $this->cpf;
    }

    public function setDisponivel(bool $disponivel) : void {
        $this->disponivel = $disponivel;
    }
}


?>