<?php
 namespace Models;

 // Classe abstrata para todos os tipos de veículos

 abstract class Pessoa {
    protected string $nome;
    protected string $experiencia;
    protected bool $disponivel;

    public function __construct (string $nome, string $experiencia){
        $this -> nome = $nome;
        $this -> experiencia = $experiencia;
        $this -> disponivel = true;
    }

    // Função para cálculo de aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel():bool {
        return $this->disponivel;
    }
    public function getNome(): string {
        return $this->nome;
    }
    public function getExperiencia(): string {
        return $this->experiencia;
    }
    public function setDisponivel(bool $disponivel): void {
        $this->disponivel = $disponivel;
    }
 }