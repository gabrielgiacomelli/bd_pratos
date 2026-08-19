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

        .navbar-custom h1 {
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header {
            border-bottom: 1px solid #eee;
        }

        .card-title {
            color: #212529;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.15);
        }

        .btn {
            border-radius: 8px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #6c757d;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge-categoria {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 20px;
        }

        .preco {
            font-weight: 700;
            color: #198754;
            white-space: nowrap;
        }

        .descricao {
            max-width: 280px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .acoes {
            white-space: nowrap;
        }

        .section-title {
            font-weight: 700;
        }

        .icon-title {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-right: 10px;
        }

        .icon-user {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .icon-prato {
            background-color: #e8f5e9;
            color: #198754;
        }

        footer {
            color: #6c757d;
            font-size: 0.85rem;
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

                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="bi bi-check-circle me-2"></i> Atualizar Dados
                    </button>
                    
                    <a href="../index.php" class="btn btn-secondary" style="display: block; text-align: center; text-decoration: none; margin-top: 10px;">
                        Voltar para o Início</a>
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
