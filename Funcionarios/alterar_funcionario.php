<?php
require_once("../cabecalho.php");
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

$sql = "SELECT * FROM funcionarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":id", $id);
$stmt->execute();
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$funcionario) {
    die("Funcionário não encontrado.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];


    $sqlUpdate = "UPDATE funcionarios SET nome = :nome, cargo = :cargo, departamento = :departamento WHERE id = :id";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bindValue(":nome", $nome);
    $stmtUpdate->bindValue(":cargo", $cargo);
    $stmtUpdate->bindValue(":departamento", $departamento);
    $stmtUpdate->bindValue(":id", $id);

    if ($stmtUpdate->execute()) {
        echo "Funcionário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o funcionário.";
    }
}
?>

<h3>Alterar Funcionário</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $funcionario['nome']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" name="cargo" value="<?php echo $funcionario['cargo']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" class="form-control" name="departamento" value="<?php echo $funcionario['departamento']; ?>" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>

<?php require_once("../rodape.html"); ?>
