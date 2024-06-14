<?php

class Conexao{
    private $servidor = "localhost";
    private $dbname = "empresa_construcao";
    private $username = "root";
    private $senha = "";
    private $conn;

    public function conectar(){
        try{
            $dsn = "mysql:host={$this->servidor};dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->username, $this->senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        }catch(PDOException $e){
            die("erro de conexão " . $e->getMessage());
        }
    }

    public function getConexao(){
        if(!$this->conn){
            $this->conectar();
        }
        return $this->conn;
    }
}