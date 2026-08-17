<?php
// Inclui a conexão com o banco de dados
include_once 'conexao.php';

$mensagem = "";
$status = "";

// 1. BUSCA OS USUÁRIOS PARA CRIAR A SELEÇÃO NO POP-UP
try {
    $stmtUsuarios = $pdo->query("SELECT id, nome FROM usuarios ORDER BY nome ASC");
    $listaUsuarios = $stmtUsuarios->fetchAll();
} catch (PDOException $e) {
    $listaUsuarios = [];
}

// 2. PROCESSA O CADASTRO DO PRATO QUANDO ENVIADO (RNF1 - Validação)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = trim($_POST['usuario_id']);
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $categoria = trim($_POST['categoria']);

    // RNF1 — Validação de campos obrigatórios vazios
    if (empty($usuario_id) || empty($nome) || empty($descricao) || empty($preco) || empty($categoria)) {
        $mensagem = "Todos os campos são obrigatórios!";
        $status = "danger";
    } else {
        try {
            // RNF2 — Segurança utilizando Prepared Statements
            $stmt = $pdo->prepare("INSERT INTO pratos (usuario_id, nome, descricao, preco, categoria) VALUES (:usuario_id, :nome, :descricao, :preco, :categoria)");
            $stmt->execute([
                ':usuario_id' => $usuario_id,
                ':nome' => $nome,
                ':descricao' => $descricao,
                ':preco' => $preco,
                ':categoria' => $categoria
            ]);
            
            $mensagem = "Prato cadastrado com sucesso!";
            $status = "success";
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar prato: " . $e->getMessage();
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
    <title>Cadastro de Pratos</title>
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
            background: linear-gradient(135deg, #11998e, #38ef7d);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.3);
            transition: all 0.3s;
        }
        .btn-trigger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(17, 153, 142, 0.4);
            color: white;
        }
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }
        .modal-header {
            background: linear-gradient(135deg, #11998e, #38ef7d);
            color: white;
            border-bottom: none;
            padding: 25px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus, .form-select:focus {
            border-color: #11998e;
            box-shadow: 0 0 0 0.25rem rgba(17, 153, 142, 0.25);
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
                <i class="bi bi-egg-fried text-success" style="font-size: 4rem;"></i>
            </div>
            <h2 class="fw-bold text-dark mb-3">Menu de Receitas</h2>
            <p class="text-muted mb-4">Clique no botão abaixo para abrir o formulário flutuante e inserir um novo prato vinculando-o a um colaborador.</p>
            
            <!-- Botão que Dispara o Pop-up (Modal) -->
            <button type="button" class="btn btn-trigger w-100 py-3" data-bs-toggle="modal" data-bs-target="#modalPrato">
                <i class="bi bi-plus-circle-fill me-2"></i> Abrir Formulário de Pratos
            </button>
            
            <a href="index.php" class="btn btn-link text-decoration-none mt-3 text-muted d-inline-block">
                <i class="bi bi-house-door me-1"></i> Voltar ao Painel Principal
            </a>
        </div>
    </main>

    <!-- POP-UP (MODAL) DE CADASTRO DE PRATO -->
    <div class="modal fade" id="modalPrato" tabindex="-1" aria-labelledby="modalPratoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalPratoLabel">
                        <i class="bi bi-egg me-2"></i>Novo Prato no Menu
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="cadastrar_prato.php" method="POST">
                    <div class="modal-body p-4">
                        
                        <!-- Seleção do Responsável (Relacionamento de tabelas) -->
                        <div class="mb-3">
                            <label for="usuario_id" class="form-label fw-semibold text-secondary">Responsável pelo Cadastro</label>
                            <select class="form-select" id="usuario_id" name="usuario_id" required>
                                <option value="" disabled selected>Selecione quem está cadastrando...</option>
                                <?php foreach ($listaUsuarios as $user): ?>
                                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Campo Nome do Prato -->
                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold text-secondary">Nome do Prato</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Risoto de Alho Poró" required>
                        </div>
                        
                        <!-- Campo Categoria -->
                        <div class="mb-3">
                            <label for="categoria" class="form-label fw-semibold text-secondary">Categoria</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Ex: Massas, Carnes, Sobremesas" required>
                        </div>

                        <!-- Campo Preço -->
                        <div class="mb-3">
                            <label for="preco" class="form-label fw-semibold text-secondary">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="0.00" required>
                        </div>

                        <!-- Campo Descrição -->
                        <div class="mb-3">
                            <label for="descricao" class="form-label fw-semibold text-secondary">Descrição / Ingredientes</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Detalhes do prato..." required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer bg-light border-0 p-3">
                        <button type="button" class="btn btn-outline-secondary rounded-3 px-4" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success rounded-3 px-4" style="background: #11998e; border: none;">Salvar Prato</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://jsdelivr.net"></script>