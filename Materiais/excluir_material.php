<?php
require_once("../cabecalho.php");
require_once("../connection.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_material = $_GET['id'];

    $sql = "DELETE FROM materiais WHERE id = :id";
    
    try {
        $db = new Conexao();
        $conn = $db->conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id_material);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<div class='alert alert-success' role='alert'>Material excluído com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir o material.</div>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>ID do material não fornecido.</div>";
}

echo "<a href='index.php' class='btn btn-primary mt-3'>Voltar</a>";

require_once("../rodape.html");
?>
