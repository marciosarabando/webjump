<?php

require_once('./Classe/Conexao.php');
require_once('./Classe/Categoria.php');

class Produto {
    private $id, $nome, $sku, $descricao, $quantidade, $preco, $categorias;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSku(){
        return $this->sku;
    }

    public function setSku($sku){
        $this->sku = $sku;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function setPreco($preco){
        $this->preco = $preco;
    }

    public function getCategorias(){
        $categorias = new ArrayObject();
        $conn = new Conexao();
        $query = "SELECT * from produtocategoria WHERE produto_id = {$this->id}";
        $result = $conn->executeCommand($query, false);
        while ($dado = $result->fetch_array()){
            $categoria = new Categoria();
            $categoria->getById($dado["categoria_id"]);
            $categorias->append($categoria);
        }
        return $categorias;
    }

    public function getAll() {
        $produtos = new ArrayObject();
        $conn = new Conexao();
        $query = "SELECT * from produto";
        $result = $conn->executeCommand($query, false);

        while ($dado = $result->fetch_array()){
            $produto = new Produto();
            $produto->id = $dado["id"];
            $produto->nome = $dado["nome"];
            $produto->sku = $dado["sku"];
            $produto->descricao = $dado["descricao"];
            $produto->quantidade = $dado["quantidade"];
            $produto->preco = $dado["preco"];
            $produtos->append($produto);
        }
        return $produtos;
    }

    public function getById($id) {
        $conn = new Conexao();
        $query = "SELECT * FROM produto WHERE id={$id}";
        $result = $conn->executeCommand($query, false);
        while ($dado = $result->fetch_array()){
            $this->id = $dado["id"];
            $this->nome = $dado["nome"];
            $this->sku = $dado["sku"];
            $this->descricao = $dado["descricao"];
            $this->quantidade = $dado["quantidade"];
            $this->preco = $dado["preco"];
        }
        return $this;
    }

    public function save($categorias, $funcao){
        $conn = new Conexao();
        if($funcao == "new"){
            $query = "INSERT INTO produto VALUES (
                null,
                '$this->nome',
                '$this->sku',
                '$this->descricao',
                $this->quantidade,
                $this->preco
            )";
        } else if ($funcao == "edit"){
            $query = "DELETE FROM produtocategoria WHERE produto_id = $this->id";
            $conn->executeCommand($query, false);
            
            $query = "UPDATE produto 
            SET nome = '$this->nome',
                sku = '$this->sku',
                descricao = '$this->descricao',
                quantidade = $this->quantidade,
                preco = $this->preco
            WHERE id = $this->id";
        }
        $produto_id = $conn->executeCommand($query, true);
        
        if($funcao == "edit")
            $produto_id = $this->id;
        foreach($categorias as $categoria_id){
            $this->addCategoria($produto_id, $categoria_id);
        }
        return $produto_id;
    }

    private function addCategoria($produto_id, $categoria_id){
        $conn = new Conexao();
        $query = "INSERT INTO produtocategoria VALUES (
            {$produto_id},
            {$categoria_id}
        )";
        $id = $conn->executeCommand($query, true);
    }

    public function delete($id){
        $conn = new Conexao();
        $query = "DELETE FROM produtocategoria WHERE produto_id = $id";
        $conn->executeCommand($query, false);

        $query = "DELETE FROM produto WHERE id = $id";
        $conn->executeCommand($query, false);
        return true;
    }
}