<?php 

declare(strict_types=1); 
namespace src;

class Pessoa{

    private string $nome;
    private float $peso;
    private float $altura;



    public function getNome(): string 
    {
        return $this->nome ; 
    }

    public function getPeso(): float 
    {
        return $this-> peso;
    }

    public function getAltura(): float 
    {
        return $this->altura;
    }
     public function setNome(string $novoNome): void {
         if (is_numeric($novoNome)) {
            throw new \InvalidArgumentException(
                'Nome precisa ter apenas caracteres'
            );
        }
        $this->nome = $novoNome;
       
    }

    public function setPeso(float $novoPeso): void {
         if ($novoPeso <= 0) {
            throw new \InvalidArgumentException(
                'O peso não pode ser negativo ou zero.'
            );
        }
        $this->peso = $novoPeso;
        
    }

    public function setAltura(float $novaAltura): void {
         if ($novaAltura <= 0) {
            throw new \InvalidArgumentException(
                'A altura não pode ser negativo ou zero.'
            );
        }
        $this->altura = $novaAltura;
    }

    public function calcularIMC(): float
    {

        return $this->peso / ($this->altura * $this->altura);

    }
    public function classificarIMC(): string 
    {
        $ClassIMC = $this->calcularIMC();

        if ($ClassIMC < 18.5) {
            return "Abaixo do peso";
        }elseif ($ClassIMC > 18.5 && $ClassIMC < 24.9){
            return "Peso Normal";
        }elseif ($ClassIMC > 24.9 && $ClassIMC < 30.0){
        return "Sobrepeso";
        }else
        return "Obesidade";
    }



}