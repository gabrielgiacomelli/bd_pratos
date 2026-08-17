<?php
// Inclui a conexão com o banco de dados
include_once 'conexao.php';

$mensagem = "";
$status = "";

// Processa o formulário quando enviado (RNF1 - Validação)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    // RNF1 — Validação de campos obrigatórios vazios
    if (empty($nome) || empty($email)) {
        $mensagem = "Todos os campos são obrigatórios!";
        $status = "danger";
    } else {
        try {
            // RNF2 — Segurança utilizando Prepared Statements
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email
            ]);
            
            $mensagem = "Colaborador cadastrado com sucesso!";
            $status = "success";
        } catch (PDOException $e) {
            // Verifica se o e-mail já existe (duplicado)
            if ($e->getCode() == 23000) {
                $mensagem = "Este e-mail já está cadastrado no sistema.";
            } else {
                $mensagem = "Erro ao cadastrar: " . $e->getMessage();
            }
            $status = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Colaboradores</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header-clean {
            background: #ffffff;
            padding: 25px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e9ecef;
        }
        .brand-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2d3748;
            text-decoration: none;
        }
        .center-card {
            max-width: 550px;
            margin: 60px auto;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: white;
            padding: 40px;
        }
        .btn-trigger {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.3);
            transition: all 0.3s;
        }
        .btn-trigger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(118, 75, 162, 0.4);
            color: white;
        }
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }
        .modal-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-bottom: none;
            padding: 25px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>

    <!-- Header Limpo -->
    <header class="header-clean text-center">
        <div class="container">
            <a href="index.php" class="brand-title">
                <i class="bi bi-arrow-left me-3 text-muted" style="font-size: 1.4rem;"></i>
                <i class="bi bi-fire text-danger me-2"></i>ChefControl Sistema
            </a>
        </div>
    </header>

    <main class="container flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="text-center center-card w-100">
            
            <!-- Mensagens de Alerta Flutuantes do PHP -->
            <?php if (!empty($mensagem)): ?>
                <div class="alert alert-<?= $status ?> alert-dismissible fade show border-0 rounded-3 mb-4 shadow-sm" role="alert">
                    <i class="bi <?= $status === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?> me-2"></i>
                    <?= $mensagem ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="mb-4 text-muted">
                <i class="bi bi-person-badge text-primary" style="font-size: 4rem;"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Área do Colaborador</h2>
            <p class="text-muted mb-4">Clique no botão abaixo para abrir o formulário flutuante e registrar um novo usuário no sistema.</p>
            
            <!-- Botão que Dispara o Pop-up (Modal) -->
            <button type="button" class="btn btn-trigger w-100 py-3" data-bs-toggle="modal" data-bs-target="#modalCadastro">
                <i class="bi bi-person-plus-fill me-2"></i> Abrir Formulário de Cadastro
            </button>
            
            <a href="index.php" class="btn btn-link text-decoration-none mt-3 text-muted d-inline-block">
                <i class="bi bi-house-door me-1"></i> Voltar ao Painel Principal
            </a>
        </div>
    </main>

    <!-- POP-UP (MODAL) DE CADASTRO -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalCadastroLabel">
                        <i class="bi bi-person-plus me-2"></i>Novo Colaborador
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="cadastrar_usuario.php" method="POST">
                    <div class="modal-body p-4">
                        
                        <!-- Campo Nome -->
                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold text-secondary">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João Silva" required>
                        </div>
                        
                        <!-- Campo E-mail -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-secondary">E-mail Corporativo</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ex: joao@restaurante.com" required>
                        </div>

                    </div>
                    <div class="modal-footer bg-light border-0 p-3">
                        <button type="button" class="btn btn-outline-secondary rounded-3 px-4" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 style" style="background: #764ba2; border: none;">Salvar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS (Obrigatório para o Pop-up funcionar) -->
    <script src="https://jsdelivr.net"></script>

    <!-- Script automático para reabrir o modal caso dê erro de digitação/validação -->
    <?php if (!empty($mensagem) && $status === 'danger'): ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('modalCadastro'));
        myModal.show();
    </script>
    <?php endif; ?>
</body>
</html>