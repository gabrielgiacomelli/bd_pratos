<?php

include "../infra/conexao.php";

$id = $_GET["id"];
$sql = "SELECT * FROM pratos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql );

$prato =mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

    <style>
        body {
            background-color: #f5f6f8;
            color: #212529;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #212529, #343a40);
        }

        .card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #eee;
            padding: 20px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
        }

        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.15);
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }
    </style>
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
                <h2>Editando o prato: <span class="semi-bold"><?php echo $prato["nome"]?></span></h2>
                
                <form action="atualizar_prato.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $prato["id"]?>">
                    
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $prato["nome"]?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo $prato["descricao"]?>" required>
                    </div>

                    <div class="form-group">
                        <label for="preco">Preço (R$)</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $prato["preco"]?>" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $prato["categoria"]?>" required>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-check-circle me-2"></i>Atualizar Dados
                            </button>
                            <a href="../index.php" class="btn btn-light border">
                                <i class="bi bi-arrow-left me-2"></i>Voltar para o Início
                            </a>
                        </div>
                </form>
            </div>

        </div>
    </main>

    <footer class="text-center py-4">
        <div class="container">
            <i class="bi bi-shop me-1"></i>
            Sistema de Controle de Restaurante
        </div>
    </footer>
    
</body>
</html>
