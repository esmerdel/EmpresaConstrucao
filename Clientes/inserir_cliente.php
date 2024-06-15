<?php require_once("../cabecalho.php"); ?>

<h3>Inserir Cliente</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">Salvar</button>
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
        require_once("../connection.php");
        $db = new Conexao();
        $conn = $db->conectar();
        
        $sql = "INSERT INTO clientes (nome, telefone, email) VALUES (:nome, :telefone, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            echo "Cliente inserido com sucesso!";
        } else {
            echo "Erro ao inserir o cliente: " . $conn->errorInfo();
        }
        
        $conn = null;
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

<?php require_once("../rodape.html"); ?>
