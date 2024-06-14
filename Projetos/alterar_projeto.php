<?php
require_once("../cabecalho.php");
require_once("../connection.php"); // Inclua o arquivo de conexão com o banco de dados

// Verifique se um ID foi fornecido na URL
if (!isset($_GET['id'])) {
    die("ID do projeto não fornecido.");
}

$id = $_GET['id'];

// Criar uma instância da conexão com o banco de dados
$db = new Conexao();
$conn = $db->conectar();

// Verificar se houve erro na conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados");
}

// Carregar os dados atuais do projeto
$sql = "SELECT * FROM projetos WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$projeto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$projeto) {
    die("Projeto não encontrado.");
}

// Atualizar os dados do projeto no banco de dados
if ($_POST) {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $data_inicio = $_POST['data_inicio'];

    if ($nome != "" && $localizacao != "" && $data_inicio != "") {
        $sql = "UPDATE projetos SET nome = :nome, localizacao = :localizacao, data_inicio = :data_inicio WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':localizacao', $localizacao);
        $stmt->bindValue(':data_inicio', $data_inicio);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Projeto atualizado com sucesso!";
            // Redirecionar para a lista de projetos após atualização
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao atualizar o projeto: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

<h3>Alterar Projeto</h3>
<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Informe o nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($projeto['nome']); ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="localizacao" class="form-label">Informe a localização</label>
            <input type="text" class="form-control" name="localizacao" value="<?php echo htmlspecialchars($projeto['localizacao']); ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="data_inicio" class="form-label">Informe a data de início</label>
            <input type="date" class="form-control" name="data_inicio" value="<?php echo htmlspecialchars($projeto['data_inicio']); ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success mt-3">Salvar</button>
        </div>
    </div>
</form>

<?php require_once("../rodape.html"); ?>
