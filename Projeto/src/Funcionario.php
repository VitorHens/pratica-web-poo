<?php 

declare(strict_types=1); 
namespace src;

class Funcionario{

    private string $nome;
    private float $valorHoras;
    private float $valorHorasExtras;
    private float $qtdHoras;
    private float $qtdHorasExtras;

 public function getNome(): string
    {
        return $this-> nome ;
    }
    
    public function getValorHora(): float
    {
       return $this->valorHoras;
    }

    public function getValorExtra(): float
    {
        return $this->valorHorasExtras ;
    }

    public function getQtdHoras(): float
    {
        return $this->qtdHoras ;
    }


    public function getQtdHorasExtras(): float
    {
       return  $this->qtdHorasExtras ;
    }

    public function setNome(string $novoNome): void
    {
        $this->nome = $novoNome;
         if (is_numeric($novoNome)) {
          throw new \InvalidArgumentException(
              'Nome precisa ter apenas caracteres'
           );
    }
    }
    
    public function setValorHora(float $novoValorHora): void
    {
        $this->valorHoras = $novoValorHora;
        if ($novoValorHora < 0) {
            throw new \InvalidArgumentException(
                'O valor não pode ser negativo ou zero.'
            );
        }
    }

    public function setValorExtra(float $novoValorExtra): void
    {
        $this->valorHorasExtras = $novoValorExtra;
          if ($novoValorExtra < 0) {
            throw new \InvalidArgumentException(
                'O valor não pode ser negativo ou zero.'
            );
        }
    }

    public function setQtdHoras(float $novoHora): void
    {
        $this->qtdHoras = $novoHora;
         if ($novoHora < 0) {
            throw new \InvalidArgumentException(
                'O valor não pode ser negativo ou zero.'
            );
        }
    }


    public function setQtdHorasExtras(float $novoExtra): void
    {
        $this->qtdHorasExtras = $novoExtra;
        if ($novoExtra < 0) {
            throw new \InvalidArgumentException(
                'O valor não pode ser negativo ou zero.'
            );
        }
    }

    public function calcularSalario(): float
    {

        return $this->valorHoras * $this->qtdHoras + $this->valorHorasExtras * $this->qtdHorasExtras;

    }
    



}


