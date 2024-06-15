<?php
require_once("../cabecalho.php");
require_once("../connection.php");


$id = $_GET['id'];


$db = new Conexao();
$conn = $db->conectar();


$sql = "SELECT * FROM clientes WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h3>Alterar Cliente</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $cliente['nome']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $cliente['email']; ?>" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>

<?php
if ($_POST){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    if ($nome != "" && $telefone != "" && $email != ""){
        $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            echo "Cliente atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o cliente: " . $conn->errorInfo();
        }
        
        $conn = null;
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

<?php require_once("../rodape.html"); ?>
