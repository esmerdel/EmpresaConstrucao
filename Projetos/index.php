<?php
require_once("../cabecalho.php");
require_once("../connection.php"); 

?>

<h3>Projetos</h3>
<a href="inserir_projeto.php" class="btn btn-primary">Adicionar Projeto</a><br><br>

<?php

$db = new Conexao();
$conn = $db->conectar();

if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}

$sql = "SELECT * FROM projetos";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    echo "<table class='table'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Localização</th>
                <th>Data de Início</th>
                <th>Ações</th>
            </tr>";
    while ($projeto = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $projeto["id"] . "</td>
                <td>" . $projeto["nome"] . "</td>
                <td>" . $projeto["localizacao"] . "</td>
                <td>" . $projeto["data_inicio"] . "</td>
                <td>
                    <a href='alterar_projeto.php?id=" . $projeto["id"] . "' class='btn btn-warning'>Alterar</a>
                    <a href='excluir_projeto.php?id=" . $projeto["id"] . "' class='btn btn-danger'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum projeto encontrado.";
}
?>
<?php require_once("../rodape.html"); ?>
