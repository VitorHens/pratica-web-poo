<?php 

declare(strict_types=1); 
namespace src;

class Triangulo{

    private float $lado01;
    private float $lado02;
    private float $lado03;
    
    public function getLado01(): float
    {
        return $this->lado01;
    }
    public function getLado02(): float
    {
        return $this->lado02;
    }
    public function getLado03(): float
    {
        return $this->lado03;
    }

    public function setLado01(float $novoLado01): void
    {
        if ($novoLado01 <= 0) {
            throw new \InvalidArgumentException(
                'O lado do quadrado não pode ser negativo.'
            );
        }

        $this->lado01 = $novoLado01;
    }

    public function setLado02(float $novoLado02): void
    {
         if ($novoLado02 <= 0) {
            throw new \InvalidArgumentException(
                'O lado do quadrado não pode ser negativo.'
            );
        }
        $this->lado02 = $novoLado02;
    }

    public function setLado03(float $novoLado03): void
    {
         if ($novoLado03 <= 0) {
            throw new \InvalidArgumentException(
                'O lado do quadrado não pode ser negativo.'
            );
        }
        $this->lado03 = $novoLado03;
    }
    

    public function calcularArea(): float
    {
        $semiPeri = ($this->lado01 + $this->lado02 + $this->lado03) / 2;
        return sqrt($semiPeri * ($semiPeri - $this->lado01) * ($semiPeri - $this->lado02) * ($semiPeri - $this->lado03));

    }
    
    public function calcularPerimetro(): float
    {

        return $this->lado01 + $this->lado02 + $this->lado03;

    }

    public function calcularTipo(): string
    {

        if($this->lado01 == $this->lado02 and  $this->lado01 == $this->lado03){

            return "Equilátero";

        }elseif($this->lado01 == $this->lado02 or $this->lado01 == $this->lado03 or $this->lado01 == $this->lado03){

            return "Isósceles";

        } else{

            return "Escaleno";

        }


    }


}


