<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Projeto</title>
</head>
<body>
    <h2>Adicionar Projeto</h2>
    <form action="save_projeto.php" method="post">
        Nome: <input type="text" name="nome"><br>
        Localização: <input type="text" name="localizacao"><br>
        Data de Início: <input type="date" name="data_inicio"><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
