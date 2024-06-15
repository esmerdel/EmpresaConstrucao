<?php
require_once("../cabecalho.php");
require_once("../connection.php"); // Inclua o arquivo de conexão com o banco de dados

?>

<h3>Funcionários</h3>
<a href="inserir_funcionario.php" class="btn btn-primary">Adicionar Funcionário</a><br><br>

<?php

$db = new Conexao();
$conn = $db->conectar();


if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}


$sql = "SELECT * FROM funcionarios";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    echo "<table class='table'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Ações</th>
            </tr>";
    while ($funcionario = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $funcionario["id"] . "</td>
                <td>" . $funcionario["nome"] . "</td>
                <td>" . $funcionario["cargo"] . "</td>
                <td>" . $funcionario["departamento"] . "</td>
                <td>
                    <a href='alterar_funcionario.php?id=" . $funcionario["id"] . "' class='btn btn-warning'>Alterar</a>
                    <a href='excluir_funcionario.php?id=" . $funcionario["id"] . "' class='btn btn-danger'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum funcionário encontrado.";
}
?>

<?php require_once("../rodape.html"); ?>
