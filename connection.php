<?php

class Conexao {
    private $servidor = "localhost";
    private $dbname = "empresa_construcao";
    private $username = "root";
    private $senha = "";
    private $conn;

    public function conectar() {
        try {
            $dsn = "mysql:host={$this->servidor};dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->username, $this->senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function getConexao() {
        if(!$this->conn) {
            $this->conectar();
        }
        return $this->conn;
    }

    public function retornarProjetos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM projetos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return array(); // Retorna um array vazio em caso de erro
        }
    }
}

?>
