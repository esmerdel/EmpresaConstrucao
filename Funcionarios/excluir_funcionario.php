<?php
require_once("../connection.php"); 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do funcionário não foi fornecido.");
}

$id = $_GET['id'];

$db = new Conexao();
$conn = $db->conectar();

if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}


$sql = "DELETE FROM funcionarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":id", $id);

if ($stmt->execute()) {
    echo "Funcionário excluído com sucesso!";
} else {
    echo "Erro ao excluir o funcionário.";
}
?>

<br>
<a href="index.php" class="btn btn-primary">Voltar para a lista de funcionários</a>
