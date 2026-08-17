<?php

include "../infra/conexao.php";

$id = $_GET["id"];
$sql = "SELECT * FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conexao, $sql );

$usuario =mysqli_fetch_assoc($resultado);

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
        <h1>Editar Usuário</h1>
    </header>

    <main>

        <h2>Editando o usuário <?php echo $usuario["nome"]?>!</h2>
        <form action="atualizar_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario["id"]?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $usuario["nome"]?>">
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $usuario["email"]?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
    
</body>
</html>
