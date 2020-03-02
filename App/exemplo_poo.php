<?php

include_once './Domain/Produto.php';
include_once './Repository/Produto.php';
include_once './Repository/Conexao.php';
//require('./Model/Produto.php');

final class Fabricante{
    private $nome;

    public function __construct($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }
}


final class Produto_Teste{
    private $descricao;
    private $preco;
    private $fabricante;

    public function __construct($descricao, $preco, Fabricante $fabricante){
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->fabricante = $fabricante;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($valor){
        $this->descricao = $valor;
    }

    public function getPreco(){
        return $this->preco;
    }
    
    public function setPreco($valor){
        $this->preco = $valor;
    }

    public function getDetalhes(){
        return "O produto {$this->descricao} custa {$this->preco} reais. Fabricante: {$this->fabricante->getNome()}";
    }
}

$f1 = new Fabricante('Editora B');
$p1 = new Produto_Teste('Código Limpo', '150', $f1);
//$p1->setDescricao('Livro Código Limpo');
//$p1->setPreco(250.00);

//var_dump($p1);
echo $p1->getDetalhes();

$ps1 = new App\Domain\Produto();
echo '<br>';
var_dump($ps1);

echo '<br>';
echo '<br>';echo '<br>';

//var_dump($conn);

$conn = new Conexao();
//var_dump($conn->getConn());
$mysqli = $conn->getConn();

$query = "select * from Produtos";
$conn = $mysqli->query($query) or die ($mysqli->error);

while ($dado = $conn->fetch_array()){
    echo($dado["Nome"]);
}


$produtos = new App\Repository\Produto();
$produtos.getAll();

