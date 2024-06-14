<?php
require_once("../cabecalho.php");
require_once("../connection.php"); // Inclua o arquivo de conexão com o banco de dados

// Verifica se foi passado o parâmetro ID na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_material = $_GET['id'];

    // Prepara a consulta SQL para excluir o material
    $sql = "DELETE FROM materiais WHERE id = :id";
    
    try {
        // Conecta ao banco de dados
        $db = new Conexao();
        $conn = $db->conectar();

        // Prepara e executa a query de exclusão
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id_material);
        $stmt->execute();

        // Verifica se a exclusão foi bem sucedida
        if ($stmt->rowCount() > 0) {
            echo "<div class='alert alert-success' role='alert'>Material excluído com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir o material.</div>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    } finally {
        // Fecha a conexão com o banco de dados
        $conn = null;
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>ID do material não fornecido.</div>";
}

// Botão para voltar à página anterior
echo "<a href='index.php' class='btn btn-primary mt-3'>Voltar</a>";

require_once("../rodape.html"); // Inclui o rodapé da página
?>
