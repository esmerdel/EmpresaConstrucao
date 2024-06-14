<?php
require_once("connection.php");

// Função para inserir um novo projeto
function inserirProjeto($nome, $localizacao, $data_inicio) {
    global $conn;
    try {
        $sql = "INSERT INTO projetos (nome, localizacao, data_inicio) VALUES (:nome, :localizacao, :data_inicio)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->bindParam(':data_inicio', $data_inicio);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
}
?>
