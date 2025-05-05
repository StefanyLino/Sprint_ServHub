<?php

namespace interfaces;

// define os metodos necessarios para um funcionario alugavel

interface Locavel
{
    public function alugar();
    public function devolver();
    public function isDisponivel();
    
}
?>