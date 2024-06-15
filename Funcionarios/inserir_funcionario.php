<?php
require_once("../cabecalho.php");
require_once("../connection.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];

    if (!empty($nome) && !empty($cargo) && !empty($departamento)) {
        try {
            $db = new Conexao();
            $conn = $db->conectar();

            $sql = "INSERT INTO funcionarios (nome, cargo, departamento) VALUES (:nome, :cargo, :departamento)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cargo', $cargo);
            $stmt->bindParam(':departamento', $departamento);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success' role='alert'>Funcionário inserido com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Erro ao inserir o funcionário.</div>";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    } else {
        echo "<div class='alert alert-warning' role='alert'>Por favor, preencha todos os campos.</div>";
    }
}
?>

<h3>Inserir Funcionário</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" name="cargo" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" class="form-control" name="departamento" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success mt-3">Salvar</button>
            <a href="index.php" class="btn btn-secondary mt-3">Cancelar</a>
        </div>
    </div>
</form>

<?php require_once("../rodape.html"); ?>
