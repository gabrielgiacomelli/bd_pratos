<?php

include "../infra/conexao.php";

$id = $_GET["id"];
$sql = "SELECT * FROM pratos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql );

$prato =mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>

    <header>
        <h1>Editar Prato</h1>
    </header>

    <main>

        <h2>Editando o prato <?php echo $prato["nome"]?>!</h2>
        <form action="atualizar_prato.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $prato["id"]?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $prato["nome"]?>">
            <br>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" value="<?php echo $prato["descricao"]?>">
            <br>
            <label for="preco">Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?php echo $prato["preco"]?>">
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" value="<?php echo $prato["categoria"]?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
    
</body>
</html>
