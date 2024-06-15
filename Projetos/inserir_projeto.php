<?php
require_once("../cabecalho.php");
require_once("../functions.php"); 
require_once("../connection.php");

$db = new Conexao();
$conn = $db->getConexao();

?>

<h3>Inserir Projeto</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Informe o nome</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="localizacao" class="form-label">Informe a localização</label>
            <input type="text" class="form-control" name="localizacao" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="data_inicio" class="form-label">Informe a data de início</label>
            <input type="date" class="form-control" name="data_inicio" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success mt-3">Salvar</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $data_inicio = $_POST['data_inicio'];

    // Verifica se todos os campos foram preenchidos
    if (!empty($nome) && !empty($localizacao) && !empty($data_inicio)) {

        // Prepara a declaração SQL com placeholders
        $sql = "INSERT INTO projetos (nome, localizacao, data_inicio) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $localizacao);
        $stmt->bindParam(3, $data_inicio);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Projeto inserido com sucesso!";
        } else {
            echo "Erro ao inserir o projeto: " . $stmt->errorInfo();
        }

        // Fecha a declaração
        $stmt->closeCursor();
    } else {
        echo "Preencha todos os campos!";
    }
}

require_once("../rodape.html"); // Inclui o rodapé da página
?>
