<?php

include "../infra/conexao.php";

$id = $_GET["id"];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <header>
        <div class="header-container">
            <h1>Painel de Controle</h1>
            <p>Gerenciamento e edição do sistema</p>
        </div>
    </header>

    <main class="container">
        <div class="container-cadastro" style="grid-template-columns: 1fr; max-width: 600px; margin: 0 auto;">
            
            <div class="card-cadastro">
                <h2>Editando o usuário: <span class="semi-bold"><?php echo $usuario["nome"]?></span></h2>
                
                <form action="atualizar_usuario.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario["id"]?>">
                    
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $usuario["nome"]?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Endereço de E-mail</label>
                        <input type="email" id="email" name="email" value="<?php echo $usuario["email"]?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar Dados</button>
                    
                    <a href="../index.php" class="btn btn-secondary" style="display: block; text-align: center; text-decoration: none; margin-top: 10px;">Voltar para o Início</a>
                </form>
            </div>

        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> - Sistema de Controle de Restaurante. Todos os direitos reservados.</p>
    </footer>
    
</body>
</html>
