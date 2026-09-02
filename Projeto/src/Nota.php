<?php

declare(strict_types=1); 
namespace src;

class nota {
    public $aluno;
    public float $nota1 = 0;
    public float $nota2 = 0;
    public float $media = 0;
    public $resultado;

    public function setNota1(float $n1): void {
        $this->nota1 = $n1;
         if ($n1 < 0) {
            throw new \InvalidArgumentException(
                'A nota não pode ser negativa.'
            );
        }
    }

    public function setNota2(float $n2): void {
        $this->nota2 = $n2;
         if ($n2 < 0) {
            throw new \InvalidArgumentException(
                'A nota não pode ser negativa.'
            );
        }
    }

    public function getMedia(): float {
        return $this->media;
    }

    public function CalNotaResul() {
        $this->media = ($this->nota1 + $this->nota2) / 2;

        if ($this->media >= 6) {
            $this->resultado = "Aprovado";
        } elseif ($this->media >= 5) {
            $this->resultado = "Recuperação";
        } else {
            $this->resultado = "Reprovado";
        }

        return $this->resultado;
    }
}