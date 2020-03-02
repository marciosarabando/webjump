<?php

class Conexao {
    private $server, $user, $password, $dbname;

    public function __construct(){
        $this->server = 'mysql-webjump-container';
        $this->user = 'root';
        $this->password = 'msdev123';
        $this->dbname = 'webjump';
    }

    public function getConn(){
        if(!isset(self::$mysqli)):
            return $mysqli = new mysqli($this->server, $this->user, $this->password, $this->dbname);
        else:
            return seff::$mysqli;
        endif;
        if($mysqli->connect_errno)
            echo "Falha na conexão com: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    public function executeCommand($query, $isInsert){
        $mysqli = $this->getConn();
        $result = $mysqli->query($query) or $this->throw_ex($mysqli->error());
        if($isInsert)
        {
            $result = $mysqli->insert_id;
        }
        $mysqli->close();
        return $result;
    }

    public function throw_ex($er){  
        throw new Exception($er);  
    }

}