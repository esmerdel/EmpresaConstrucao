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

function retornarProjetos() {
    // Conexão com o banco de dados (ajuste conforme necessário)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empresa_construcao";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM projetos");
        $stmt->execute();

        return $stmt;
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    $conn = null;
}
