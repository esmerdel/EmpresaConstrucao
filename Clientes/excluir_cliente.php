<?php
require_once("../connection.php");

$id = $_GET['id'];

$db = new Conexao();
$conn = $db->conectar();


$sql = "DELETE FROM clientes WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "Cliente excluído com sucesso!";
} else {
    echo "Erro ao excluir o cliente: " . $conn->errorInfo();
}

$conn = null;


header("Location: index.php");
exit();
?>
