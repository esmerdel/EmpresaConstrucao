<?php
require_once("../cabecalho.php");
require_once("../connection.php"); 

?>

<h3>Clientes</h3>
<a href="inserir_cliente.php" class="btn btn-primary">Adicionar Cliente</a><br><br>

<?php

$db = new Conexao();
$conn = $db->conectar();


if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}


$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    echo "<table class='table'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>";
    while ($cliente = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $cliente["id"] . "</td>
                <td>" . $cliente["nome"] . "</td>
                <td>" . $cliente["telefone"] . "</td>
                <td>" . $cliente["email"] . "</td>
                <td>
                    <a href='alterar_cliente.php?id=" . $cliente["id"] . "' class='btn btn-warning'>Alterar</a>
                    <a href='excluir_cliente.php?id=" . $cliente["id"] . "' class='btn btn-danger'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum cliente encontrado.";
}
?>

<?php require_once("../rodape.html"); ?>
