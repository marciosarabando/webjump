<?php

require_once('./Classe/Conexao.php');

class Categoria {
    private $id = null, $codigo = null, $nome = null, $selected;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setSelected(){
        $this->selected = true;
    }

    public function isSelected(){
        return $this->selected;
    }

    public function getAll() {
        $categorias = new ArrayObject();
        $conn = new Conexao();
        $query = "SELECT * FROM categoria";
        $result = $conn->executeCommand($query, false);
        while ($dado = $result->fetch_array()){
            $categoria = new Categoria();
            $categoria->id = $dado["id"];
            $categoria->codigo = $dado["codigo"];
            $categoria->nome = $dado["nome"];
            $categorias->append($categoria);
        }
        return $categorias;
    }

    public function getById($id) {
        $conn = new Conexao();
        $query = "SELECT * FROM categoria WHERE id={$id}";
        $result = $conn->executeCommand($query, false);
        while ($dado = $result->fetch_array()){
            $this->id = $dado["id"];
            $this->codigo = $dado["codigo"];
            $this->nome = $dado["nome"];
        }
        return $this;
    }

    public function save($funcao){
        $conn = new Conexao();
        if($funcao == "new"){
            $query = "INSERT INTO categoria VALUES (
                null,
                '$this->codigo',
                '$this->nome'
            )";
        }else if ($funcao == "edit"){
            $query = "UPDATE categoria SET 
                codigo = '$this->codigo',
                nome = '$this->nome'
                WHERE id = '$this->id'
            ";
        }
        return $conn->executeCommand($query, true);
    }

    public function delete($id){
        $conn = new Conexao();
        $query = "DELETE FROM produtocategoria WHERE categoria_id = $id";
        $conn->executeCommand($query, false);

        $query = "DELETE FROM categoria WHERE id = $id";
        $conn->executeCommand($query, false);

        return true;
    }

}