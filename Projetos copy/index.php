<?php
require_once("../cabecalho.php");
?>
<h1>Projetos</h1>
<a href="inserir_projeto.php" class="btn btn-primary mt-3">Adicionar Projeto</a>

<table class="mt-3 table table-hover table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Localização</th>
            <th>Data de Início</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Função que retorna os projetos (você precisará definir esta função)
        $linhas = retornarProjetos(); 
        while ($l = $linhas->fetch(PDO::FETCH_ASSOC)){
    ?>
        <tr>
            <td><?= $l['id'] ?></td>
            <td><?= $l['nome'] ?></td>
            <td><?= $l['localizacao'] ?></td>
            <td><?= $l['data_inicio'] ?></td>
            <td>
                <a href="alterar_projeto.php?id=<?= $l['id'] ?>" class="btn btn-warning">Alterar</a>
                <a href="excluir_projeto.php?id=<?= $l['id'] ?>" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>

<?php
require_once("../rodape.html");
?>
