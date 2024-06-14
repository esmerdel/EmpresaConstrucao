<?php
require_once("../connection.php");

$id = $_GET['id'];

$sql = "DELETE FROM projetos WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Projeto excluído com sucesso!";
} else {
    echo "Erro ao excluir o projeto: " . $conn->error;
}

$conn->close();
?>
<a href="index.php">Voltar aos Projetos</a>
