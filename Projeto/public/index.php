<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Funcionario.php';
require __DIR__ . '/../src/Triangulo.php';
require __DIR__ . '/../src/pessoa.php';
require __DIR__ . '/../src/Nota.php';
require __DIR__ . '/../src/Produto.php';

use src\Funcionario;
use src\Triangulo;
use src\pessoa;
use src\Nota;
use src\Produto;

$app = \Slim\Factory\AppFactory:: create();

$app->setBasePath('/FelipeGamezSanches/Projeto/public/index.php');

$app->post('/imc', function ($request, $response){

    $dados = $request->getParsedBody();

    $nome = $dados['txtNome'] ?? '';
    $nome = strip_tags($nome);

    $peso = (float)$dados['txtPeso'] ?? 0;
    $altura = (float)$dados['txtValorAltura'] ?? 0;

    $pessoa = new pessoa();

    $pessoa->setNome($nome);
    $pessoa->setPeso($peso);
    $pessoa->setAltura($altura);

    $imc = $pessoa->calcularIMC();
    $ClassIMC = $pessoa ->classificarIMC();
 
    $response->getBody()->write("
<!DOCTYPE HTML>
<html>
<head>
<title>Atributos Fisicos</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>	
<style>
</style>
</head>
<body>
<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
  <div class='container-fluid'>
    <ul class='navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/index.html'>Página Inicial</a>
              <li class='nav-item'>
        <a class='nav-link ' href='/FelipeGamezSanches/Projeto/public/Pessoa.html'>Pessoa</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Produto.html'>Produto</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Nota.html'>Nota</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Funcionario.html'>Funcionário</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Triangulo.html'>Triângulo</a>
      </li>
    </ul>
  </div>
</nav>
<br><br>
<h1 class='text-center'>Resultado do IMC calculado</h1>
<br><br>
<div class='container'>
 <table class='table table-bordered table-striped text-center'>
    <thead class='table-dark'>
        <tr>
            <th>Campo</th>
            <th>Valor</th>
       </tr>
    </thead>

    <tbody>
     <tr>
      <td>
       <strong>Nome</strong></td>
      <td>$nome</td>
     </tr>
     <td>
       <strong>Peso</strong></td>
      <td>$peso kg</td>
     </tr>
      <td>
       <strong>Altura</strong></td>
      <td>$altura m</td>
     </tr>
     <td>
       <strong>Classificação do IMC</strong></td>
      <td>$ClassIMC</td>
     </tr>
    </tbody>
  </table>
</div>

</body>
</html>");


    return $response;
     

});


$app->post('/Produto', function ($request, $response) {
    $dados = $request->getParsedBody();
    
    $nomes    = $dados['txtProduto']    ?? [];
    $precos   = $dados['txtValor']      ?? [];
    $qtds     = $dados['txtQtd']        ?? [];
    $adds     = $dados['txtAdicionar']  ?? [];
    $removes  = $dados['txtTirar']      ?? [];

    $linhasTabela = "";

    for ($i = 0; $i < 5; $i++) {

    $nomes[$i] = strip_tags($nomes[$i] ?? "");
    if (is_numeric($nomes[$i])) {
            throw new \InvalidArgumentException(
                'Nome precisa ter apenas caracteres'
            );
        }

    $p = new \src\produto();

    $p->nome = (string)($nomes[$i] ?? "");
    $p->preco = (float)($precos[$i] ?? 0);
    if ($p->preco < 0) {
        throw new \InvalidArgumentException(
            'O preço não pode ser negativo.'
        );
    }
    $p->quantidade = (int)($qtds[$i] ?? 0);

    $qtdInicial = $p->quantidade;
    $qtdAdicionada = (int)($adds[$i] ?? 0);
    $qtdRemovida   = (int)($removes[$i] ?? 0);

    if ($qtdAdicionada > 0) $p->AumeEsto($qtdAdicionada);
    if ($qtdRemovida > 0)   $p->RemoEsto($qtdRemovida);

    $valorSubtotal = $p->CalPreEsto();

    $linhasTabela .= "
    <tr>

        <td><strong>{$p->nome}</strong></td>
        <td>{$qtdInicial}</td>
        <td>R$ " . number_format($p->preco, 2, ',', '.') . "</td> 
        <td class='text-danger'>-{$qtdRemovida}</td>
        <td class='text-success'>+{$qtdAdicionada}</td>
        <td>{$p->quantidade}</td>
        <td><strong>R$ " . number_format($valorSubtotal, 2, ',', '.') . "</strong></td>
    </tr>";
}
    
    $response->getBody()->write("
<!DOCTYPE HTML>
<html>
<head>
    <title>Resultado de Estoque</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
  <div class='container-fluid'>
    <ul class='navbar-nav'>
      <li class='nav-item'><a class='nav-link' href='/FelipeGamezSanches/Projeto/public/index.html'>Página Inicial</a></li>
      <li class='nav-item'><a class='nav-link' href='/FelipeGamezSanches/Projeto/public/Pessoa.html'>Pessoa</a></li>
      <li class='nav-item'><a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Produto.html'>Produto</a></li>
      <li class='nav-item'><a class='nav-link' href='/FelipeGamezSanches/Projeto/public/Nota.html'>Nota</a></li>
      <li class='nav-item'><a class='nav-link' href='/FelipeGamezSanches/Projeto/public/Funcionario.html'>Funcionário</a></li>
      <li class='nav-item'><a class='nav-link' href='/FelipeGamezSanches/Projeto/public/Triangulo.html'>Triângulo</a></li>
    </ul>
  </div>
</nav>
<br>
<h1 class='text-center'>Relatório Final de Estoque</h1>
<div class='container'>
 <table class='table table-bordered table-striped text-center shadow-sm'>
    <thead class='table-dark'>
        <tr>
            <th>Produto</th>
            <th>Quantidade Inicial</th>
            <th>Preço Unitário</th>
            <th>Tirou</th>
            <th>Adicionou</th>
            <th>Quantidade Final</th>
            <th>Valor em Estoque</th>
       </tr>
    </thead>
    <tbody>
        $linhasTabela
    </tbody>
  </table>
  <div class='text-center mb-5'>
    <a href='/FelipeGamezSanches/Projeto/public/Produto.html' class='btn btn-primary'>Voltar</a>
  </div>
</div>
</body>
</html>");

    return $response;
});


$app->post('/Nota', function ($request, $response) {

    $dados = $request->getParsedBody();

    $aluno_nome = strip_tags($dados['txtAluno'] ?? '');
    if (is_numeric($aluno_nome)) {
          throw new \InvalidArgumentException(
              'Nome precisa ter apenas caracteres'
           );
    }
    $n1 = (float)($dados['txtNota1'] ?? 0);
    $n2 = (float)($dados['txtNota2'] ?? 0);

    $notaObj = new nota();
    $notaObj->setNota1($n1);
    $notaObj->setNota2($n2);

    $resultado = $notaObj->CalNotaResul(); 
    $media = $notaObj->getMedia(); 

    
    $response->getBody()->write("
<!DOCTYPE HTML>
<html>
<head>
    <title>Resultado de Notas</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
  <div class='container-fluid'>
    <ul class='navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/index.html'>Página Inicial</a>
              <li class='nav-item'>
        <a class='nav-link ' href='/FelipeGamezSanches/Projeto/public/Pessoa.html'>Pessoa</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Produto.html'>Produto</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Nota.html'>Nota</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Funcionario.html'>Funcionário</a>
              <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Triangulo.html'>Triângulo</a>
      </li>
    </ul>
  </div>
</nav>
<br>
<h1 class='text-center'>Resultado das Notas - $aluno_nome</h1>
<div class='container'>
 <table class='table table-bordered table-striped text-center'>
    <thead class='table-dark'>
        <tr>
            <th>$aluno_nome</th>
            <th>Resultado</th>
       </tr>
    </thead>
    <tbody>
     <tr>
      <td><strong>Nota 1</strong></td>
      <td>$n1</td>
     </tr>
     <tr>
      <td><strong>Nota 2</strong></td>
      <td>$n2</td>
     </tr>
      <tr>
      <td><strong>Média</strong></td>
      <td>$media</td>
     </tr>
     <tr>
      <td><strong>Resultado</strong></td>
      <td>$resultado</td>
     </tr>
    </tbody>
  </table>
</div>
</body>
</html>");

     return $response;
}); 



$app->post('/salario', function ($request, $response){

    $dados = $request->getParsedBody();

    $nome = $dados['txtNome'  ] ?? '';
    $nome = strip_tags($nome);

    $valorHoras = (float) ($dados['txtValorHora'] ?? 0);
    $valorHorasExtras = (float) ($dados['txtValorHoraExtra'] ?? 0);
    $horas = (float) ($dados['txtQtdHoras'] ?? 0);
    $horasExtras = (float) ($dados['txtQtdHorasExtra'] ?? 0);
    $funcionario = new Funcionario();

    $funcionario->setNome($nome);
    $funcionario->setValorHora($valorHoras);
    $funcionario->setValorExtra($valorHorasExtras);
    $funcionario->setQtdHoras($horas);
    $funcionario->setQtdHorasExtras($horasExtras);

    $salario = $funcionario->calcularSalario();

    $response->getBody()->write("<!DOCTYPE html>
<html>
<head>
<title>Salário Final do Funcionário</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>	
</head>
<body>
<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
  <div class='container-fluid'>
    <ul class='navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link' href='/FelipeGamezSanches/Projeto/public/index.html'>Página Inicial</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active'  href='/FelipeGamezSanches/Projeto/public/Pessoa.html'>Pessoa</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Produto.html'>Produto</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link ' href='/FelipeGamezSanches/Projeto/public/Nota.html'>Nota</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Funcionario.html'>Funcionário</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Triangulo.html'>Triângulo</a>
      </li>
    </ul>
  </div>
</nav>
<br><br><br>
<h1 class='text-center'>Resultado</h1>
<br><br>
<div class='container'>
    <table class='table table-bordered table-striped text-center'>
        <thead class='table-dark'>
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><strong>Nome</strong></td>
                <td>$nome</td>
            </tr>
            
            <tr>
                <td><strong>Horas</strong></td>
                <td>R$ $valorHoras</td>
            </tr>
            <tr>
                <td><strong>Horas Extra</strong></td>
                <td>R$ $valorHorasExtras</td>
            </tr>
            <tr>
                <td><strong>Horas Trabalhadas</strong></td>
                <td>$horas</td>
            </tr>
            <tr>
                <td><strong>Horas Extra Trabalhadas</strong></td>
                <td>$horasExtras</td> 
            </tr>
            <tr>
               <td><strong>Salário</strong></td>
                <td>R$ $salario</td>
            </tr>
        </tbody>
    </table>
</div>


</body>
</html>");

    return $response;

});

$app->post('/triangulo', function ($request, $response){

    $dados = $request->getParsedBody();
    
    $lado01 = (float) ($dados['txtLado01'] ?? 0);
    $lado02 = (float) ($dados['txtLado02'] ?? 0);
    $lado03 = (float) ($dados['txtLado03'] ?? 0);

   $triangulo = new Triangulo();
   
   $triangulo->setLado01($lado01);
   $triangulo->setLado02($lado02);
   $triangulo->setLado03($lado03);

   $area = $triangulo->calcularArea();
   if(is_nan($area) == true){

        $area = 'Não existe';
        $perimetro = 'Não existe';
        $tipo = 'Não existe';

   }else {
        $perimetro = $triangulo->calcularPerimetro();
        $tipo = $triangulo->calcularTipo();
   }  
  
   $response->getBody()->write("<!DOCTYPE html>
<html>
<head>
<title>Salário Final do Funcionário</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>	
</head>
<body>
<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
  <div class='container-fluid'>
    <ul class='navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link' href='/FelipeGamezSanches/Projeto/public/index.html'>Página Inicial</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active'  href='/FelipeGamezSanches/Projeto/public/Pessoa.html'>Pessoa</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Produto.html'>Produto</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link ' href='/FelipeGamezSanches/Projeto/public/Nota.html'>Nota</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Funcionario.html'>Funcionário</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' href='/FelipeGamezSanches/Projeto/public/Triangulo.html'>Triângulo</a>
      </li>
    </ul>
  </div>
</nav>
<br><br><br>
<h1 class='text-center'>Resultado</h1>
<br><br>
<div class='container'>
    <table class='table table-bordered table-striped text-center'>
        <thead class='table-dark'>
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><strong>1º Lado</strong></td>
                <td>$lado01 cm</td>
            </tr>
            <tr>
                <td><strong>2º Lado</strong></td>
                <td>$lado02 cm</td>
            </tr>
            <tr>
                <td><strong>3º Lado</strong></td>
                <td>$lado03 cm</td>
            </tr>
            <tr>
                <td><strong>Área</strong></td>
                <td>$area</td>
            </tr>
            <tr>
                <td><strong>Perímetro</strong></td>
                <td>$perimetro</td>
            </tr>
            <tr>
                <td><strong>Tipo</strong></td>
                <td>$tipo</td>
            </tr>
        </tbody>
    </table>
</div>


</body>
</html>");
    return $response;
   
});



$app->run();
