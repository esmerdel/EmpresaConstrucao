<?php
require_once("../cabecalho.php");
require_once("../connection.php");

$id = $_GET['id'];

$sql = "SELECT * FROM projetos WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h3>Editar Projeto</h3>
<form action="atualizar_projeto.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Informe o nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $row['nome']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="localizacao" class="form-label">Informe a localização</label>
            <input type="text" class="form-control" name="localizacao" value="<?php echo $row['localizacao']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="data_inicio" class="form-label">Informe a data de início</label>
            <input type="date" class="form-control" name="data_inicio" value="<?php echo $row['data_inicio']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success mt-3">Atualizar</button>
        </div>
    </div>
</form>

<?php require_once("../rodape.php"); ?>
