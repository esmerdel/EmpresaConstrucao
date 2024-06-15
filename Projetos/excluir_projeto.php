<?php
require_once("../cabecalho.php");
require_once("../connection.php");

if (!isset($_GET['id'])) {
    die("ID do projeto não fornecido.");
}

$id = $_GET['id'];

$db = new Conexao();
$conn = $db->conectar();

if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}

$sql = "DELETE FROM projetos WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "Projeto excluído com sucesso!";
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao excluir o projeto: " . $stmt->errorInfo()[2];
}

require_once("../rodape.html");
?>
