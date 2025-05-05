<?php
namespace models;
use Interfaces\locavel;

// Classe que representa um funcionario
class funcionario extends pessoas implements Locavel {
    private $data; // Propriedade para armazenar os dados do JSON

    public function __construct()
    {
        // Inicializa a propriedade $data com os dados do JSON
        $jsonString = file_get_contents(__DIR__ . '/../data/funcionarios.json');
        $this->data = json_decode($jsonString, true);
    }

    public function calcularAluguel(int $dias): float
    {
        return $dias * $this->data['servico'];
    }

    public function alugar(): string
    {
        if ($this->disponivel) {
            $this->disponivel = false;
            return "Funcionario '{$this->data['nome']}' contratado com sucesso!";
        }
        return "Funcionario '{$this->data['nome']}' já está contratado";
    }

    public function devolver(): string
    {
        if (!$this->disponivel) {
            $this->disponivel = true;
            return "Funcionario '{$this->data['nome']}' teve seu expediente finalizado com sucesso!";
        }
        return "Funcionario '{$this->data['nome']}' disponível para contratação";
    }
}
?>