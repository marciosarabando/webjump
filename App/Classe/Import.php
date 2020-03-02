<?php

require_once('./Classe/Produto.php');

class Import {

    public function importarCSV($path){
    
    $produto = new Produto();

    $content = file_get_contents($path);
    $linhas = explode("\n", $content);
    foreach ($linhas as $key => $linha){
        if($key > 0){
            $colunas = explode(";", $linha);
            
            $produto->setNome($colunas[0]);
            $produto->setSku($colunas[1]);
            $produto->setDescricao($colunas[2]);
            $produto->setQuantidade($colunas[3]);
            $produto->setPreco($colunas[4]);
            
            $categoria = $colunas[5];

            $categorias = explode("|", $categoria);

            foreach ($categorias as $key => $categoria){
                echo $categoria;
            }
        }
    }

    }
}