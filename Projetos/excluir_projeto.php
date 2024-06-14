<?php
require_once("../cabecalho.php");
require_once("../connection.php"); // Inclua o arquivo de conexão com o banco de dados

// Verifique se um ID foi fornecido na URL
if (!isset($_GET['id'])) {
    die("ID do projeto não fornecido.");
}

$id = $_GET['id'];

// Criar uma instância da conexão com o banco de dados
$db = new Conexao();
$conn = $db->conectar();

// Verificar se houve erro na conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}

// Excluir o projeto do banco de dados
$sql = "DELETE FROM projetos WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "Projeto excluído com sucesso!";
    // Redirecionar para a lista de projetos após exclusão
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao excluir o projeto: " . $stmt->errorInfo()[2];
}

require_once("../rodape.html");
?>
