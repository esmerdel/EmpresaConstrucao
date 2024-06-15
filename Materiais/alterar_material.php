<?php require_once("../cabecalho.php"); ?>
<?php require_once("../connection.php"); ?>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do material não foi especificado.";
    exit;
}

$id_material = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $projeto_id = $_POST['projeto_id'];

    if ($nome != "" && $quantidade != "" && $projeto_id != "") {
        $db = new Conexao();
        $conn = $db->conectar();

        $sql = "UPDATE materiais SET nome = :nome, quantidade = :quantidade, projeto_id = :projeto_id WHERE id = :id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':projeto_id', $projeto_id);
            $stmt->bindValue(':id', $id_material);
            $stmt->execute();

            echo "Material atualizado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao atualizar o material: " . $e->getMessage();
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

$db = new Conexao();
$conn = $db->conectar();

$sql = "SELECT * FROM materiais WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id_material);
$stmt->execute();
$material = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$material) {
    echo "Material não encontrado.";
    exit;
}
?>

<h3>Alterar Material</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome do Material</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $material['nome']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" value="<?php echo $material['quantidade']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="projeto_id" class="form-label">Projeto</label>
            <select class="form-select" name="projeto_id" required>
                <?php

                $sql_projetos = "SELECT id, nome FROM projetos";
                $result_projetos = $conn->query($sql_projetos);

                while ($projeto = $result_projetos->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($projeto['id'] == $material['projeto_id']) ? "selected" : "";
                    echo "<option value='{$projeto['id']}' {$selected}>{$projeto['nome']}</option>";
                }
                ?>
            </select>
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
