<?php require_once("../cabecalho.php"); ?>
<?php require_once("../connection.php"); ?>

<h3>Inserir Material</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome do Material</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="projeto_id" class="form-label">Projeto</label>
            <select class="form-select" name="projeto_id" required>
                <option value="">Selecione um projeto</option>
                <?php
                // Criar uma instância da conexão com o banco de dados
                $db = new Conexao();
                $conn = $db->conectar();

                // Query para selecionar todos os projetos
                $sql = "SELECT id, nome FROM projetos";
                $result = $conn->query($sql);

                while ($projeto = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$projeto['id']}'>{$projeto['nome']}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>

<?php
if ($_POST) {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $projeto_id = $_POST['projeto_id'];

    if ($nome != "" && $quantidade != "" && $projeto_id != "") {
        $sql = "INSERT INTO materiais (nome, quantidade, projeto_id) VALUES (:nome, :quantidade, :projeto_id)";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':projeto_id', $projeto_id);
            $stmt->execute();
            
            echo "Material inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao inserir o material: " . $e->getMessage();
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

<?php require_once("../rodape.html"); ?>
