<?php
namespace src;

class Produto {
    public $nome;
    public $preco;
    public $quantidade;

   

     public function setNome(string $novoNome): void {
         
        $this->nome = $novoNome;
        if (is_numeric($novoNome)) {
            throw new \InvalidArgumentException(
                'Nome precisa ter apenas caracteres'
            );
        }

    }

     public function getNome(): string 
    {
        return $this->nome ; 
    }

    public function setPreco($preco) {
    if ($preco < 0) {
        throw new \InvalidArgumentException(
            'O preço não pode ser negativo ou zero.'
        );
    }
    $this->preco = $preco;
}


public function getPreco() {
    return $this->preco;
}





   public function setQtd(int $qtd): void 
    {
        if ($qtd < 0) {
            throw new \InvalidArgumentException(
                'A quantidade não pode ser negativa.'
            );
        }

        $this->quantidade = $qtd;
    }

    public function getQtd(): int
    {
        return $this->quantidade;
    }




    

    public function AumeEsto($qtd) {
        if ($qtd > 0) {
            $this->quantidade += $qtd;
        }
    }

   public function RemoEsto(int $qtd): bool 
    {
        if ($qtd > 0 && $qtd <= $this->quantidade) {
            $this->quantidade -= $qtd;
            return true;
        }
        else{
             $this->quantidade = 0;
        }
           
        return false;
    }

    public function CalPreEsto() {
        return $this->preco * $this->quantidade;
    }
}