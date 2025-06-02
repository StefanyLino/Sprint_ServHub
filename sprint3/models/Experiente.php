<?php
namespace Models;

require_once __DIR__ . '/../config/config.php';

use Interfaces\Locavel;



class Experiente extends Pessoa implements Locavel { // Alterado para herdar de Pessoa

    public function calcularAluguel(int $dias): float {
        return $dias * SEMANAL_EXPERIENTE; 
    }

    public function alugar(): string{
        if ($this->disponivel){
            $this->disponivel = false;
            return "Funcionario '{$this->nome}' alugado com sucesso!";
        }
        return "Funcionario '{$this->nome}' não está disponivel.";
    }

    public function devolver(): string
    {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Funcionario '{$this->nome}' devolvido com sucesso!";
        }
        return "Funcionario '{$this->nome}' está disponivel.";
    }

    public function getNivelExperiencia(): string {
        return 'experiente';
    }
}