<?php
require_once("../cabecalho.php");
require_once("../connection.php"); // Inclua o arquivo de conexão com o banco de dados

?>

<h3>Materiais</h3>
<a href="inserir_material.php" class="btn btn-primary">Adicionar Material</a><br><br>

<?php
// Criar uma instância da conexão com o banco de dados
$db = new Conexao();
$conn = $db->conectar();

// Verificar se houve erro na conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}

// Query para selecionar todos os materiais e os nomes dos projetos correspondentes
$sql = "SELECT m.id, m.nome, m.quantidade, p.nome AS projeto
        FROM materiais m
        JOIN projetos p ON m.projeto_id = p.id";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    echo "<table class='table'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Projeto</th>
                <th>Ações</th>
            </tr>";
    while ($material = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $material["id"] . "</td>
                <td>" . $material["nome"] . "</td>
                <td>" . $material["quantidade"] . "</td>
                <td>" . $material["projeto"] . "</td>
                <td>
                    <a href='alterar_material.php?id=" . $material["id"] . "' class='btn btn-warning'>Alterar</a>
                    <a href='excluir_material.php?id=" . $material["id"] . "' class='btn btn-danger'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum material encontrado.";
}
?>

<?php require_once("../rodape.html"); ?>
