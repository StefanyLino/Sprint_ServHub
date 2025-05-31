<?php
namespace Models;

// Classe abstrata para todos os tipos de veículos

abstract class Pessoa {
    protected string $nome;
    protected string $email;
    protected int $experiencia;
    protected bool $disponivel = true;

    public function __construct(string $nome, string $email, int $experiencia) {
        $this->nome = $nome;
        $this->email = $email;
        $this->experiencia = $experiencia;
    }

    public function getNome(): string {
        return $this->nome;
    }

    

    public function getExperiencia(): string {
        return $this->experiencia;
    }
    
    public function isDisponivel(): bool {
        return $this->disponivel;
    }



    public function alugar(): string {
        $this->disponivel = false;
        return "Funcionário {$this->nome} alugado.";
    }

    public function devolver(): string {
        $this->disponivel = true;
        return "Funcionário {$this->nome} devolvido.";
    }

    abstract public function calcularAluguel(int $dias): float;
}