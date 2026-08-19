<?php
include "infra/conexao.php";

// Mostrar erros do MySQL durante o desenvolvimento
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Consultas ao banco de dados
$usuarios = mysqli_query($conexao, "SELECT * FROM usuarios");

$pratos = mysqli_query($conexao, "
    SELECT pratos.*, usuarios.nome AS cadastrado_por
    FROM pratos
    INNER JOIN usuarios ON pratos.usuario_id = usuarios.id
");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle de Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

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

    <header class="navbar-custom text-white shadow-sm mb-4">
        <div class="container py-4">

            <div class="d-flex align-items-center gap-3">
                <div
                    class="bg-white text-dark rounded-3 d-flex align-items-center justify-content-center"
                    style="width: 50px; height: 50px;"
                >
                    <i class="bi bi-shop fs-4"></i>
                </div>

                <div>
                    <h1 class="h3 mb-1">Painel de Controle</h1>

                    <p class="mb-0 text-white-50">
                        Gerenciamento de usuários e cardápio
                    </p>
                </div>
            </div>

        </div>
    </header>

    <main class="container mb-5">

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <section class="card shadow-sm h-100">

                    <div class="card-header bg-white py-3">
                        <h2 class="h5 mb-0 section-title">
                            <span class="icon-title icon-user">
                                <i class="bi bi-person-plus"></i>
                            </span>
                            Cadastrar Novo Usuário
                        </h2>
                    </div>
                    <div class="card-body p-4">

                        <form action="public/cadastrar_usuario.php" method="POST">
                            <div class="mb-3">
                                <label for="nome_usuario" class="form-label fw-semibold">
                                    Nome
                                </label>
                                <input type="text" name="nome" id="nome_usuario" class="form-control" placeholder="Ex: João Silva" required>
                            </div>

                            <div class="mb-4">
                                <label for="email_usuario" class="form-label fw-semibold">
                                    E-mail
                                </label>
                                <input type="email" name="email" id="email_usuario" class="form-control" placeholder="Ex: joao@email.com" required>

                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                <i class="bi bi-person-plus-fill me-1"></i>
                                Cadastrar Usuário
                            </button>
                        </form>

                    </div>

                </section>
            </div>

            <div class="col-lg-6">
                <section class="card shadow-sm h-100">

                    <div class="card-header bg-white py-3">
                        <h2 class="h5 mb-0 section-title">

                            <span class="icon-title icon-prato">
                                <i class="bi bi-egg-fried"></i>
                            </span>
                            Cadastrar Novo Prato
                        </h2>

                    </div>

                    <div class="card-body p-4">

                        <form action="public/cadastrar_prato.php" method="POST">
                            <div class="mb-3">
                                <label for="nome_prato" class="form-label fw-semibold">
                                    Nome do Prato
                                </label>
                                <input type="text" name="nome" id="nome_prato" class="form-control" placeholder="Ex: Fettuccine Alfredo" required>
                            </div>

                            <div class="mb-3">
                                <label for="descricao_prato" class="form-label fw-semibold">
                                    Descrição
                                </label>
                                <textarea name="descricao" id="descricao_prato" class="form-control" rows="2" placeholder="Ingredientes e detalhes do prato..." required ></textarea>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="preco_prato" class="form-label fw-semibold">
                                        Preço (R$)
                                    </label>
                                    <input type="number" name="preco" id="preco_prato" class="form-control" step="0.01" min="0" placeholder="0,00" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="categoria_prato" class="form-label fw-semibold">
                                        Categoria
                                    </label>
                                    <input type="text" name="categoria" id="categoria_prato" class="form-control" placeholder="Ex: Massas" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="usuario_id" class="form-label fw-semibold">
                                    Cadastrado por
                                </label>
                                <select name="usuario_id" id="usuario_id" class="form-select" required>
                                    <option value="">
                                        Selecione um usuário...
                                    </option>

                                    <?php
                                    mysqli_data_seek($usuarios, 0);

                                    while ($user_option = mysqli_fetch_assoc($usuarios)) {
                                    ?>

                                        <option value="<?php echo $user_option['id']; ?>">
                                            <?php echo htmlspecialchars($user_option['nome']); ?>
                                        </option>

                                    <?php } ?>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold">
                                <i class="bi bi-plus-circle-fill me-1"></i>
                                Cadastrar Prato
                            </button>
                        </form>

                    </div>

                </section>
            </div>
        </div>

        <section class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0 section-title">
                        <i class="bi bi-people-fill text-primary me-2"></i>
                        Usuários Cadastrados
                    </h2>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>

                            <th>Nome</th>

                            <th>E-mail</th>

                            <th class="text-center pe-4">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        mysqli_data_seek($usuarios, 0);

                        while ($user = mysqli_fetch_assoc($usuarios)) {
                        ?>

                            <tr>
                                <td class="ps-4 text-muted">
                                    #<?php echo $user['id']; ?>
                                </td>

                                <td class="fw-semibold">
                                    <?php echo htmlspecialchars($user['nome']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </td>

                                <td class="text-center pe-4 acoes">
                                    <div class="d-inline-flex gap-2">
                                        <a href="public/editar_usuario.php?id=<?php echo $user['id']; ?>"class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-pencil-square"></i>
                                            Editar
                                        </a>

                                        <a href="public/excluir_usuario.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Tem certeza que deseja excluir este usuário?');" >
                                            <i class="bi bi-trash3"></i>
                                            Excluir
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </section>

        <section class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h2 class="h5 mb-0 section-title">
                    <i class="bi bi-journal-text text-success me-2"></i>
                    Pratos Cadastrados
                </h2>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>

                            <th>Nome do Prato</th>

                            <th>Descrição</th>

                            <th>Preço</th>

                            <th>Categoria</th>

                            <th>Cadastrado Por</th>

                            <th class="text-center pe-4">Ações</th>
                        </tr>

                    </thead>


                    <tbody>

                        <?php
                        while ($prato = mysqli_fetch_assoc($pratos)) {
                        ?>

                            <tr>

                                <td class="ps-4 text-muted">
                                    #<?php echo $prato['id']; ?>
                                </td>


                                <td class="fw-semibold">

                                    <?php echo htmlspecialchars($prato['nome']); ?>

                                </td>


                                <td class="descricao">

                                    <?php echo htmlspecialchars($prato['descricao']); ?>

                                </td>


                                <td class="preco">

                                    R$
                                    <?php
                                    echo number_format(
                                        $prato['preco'],
                                        2,
                                        ',',
                                        '.'
                                    );
                                    ?>

                                </td>


                                <td>

                                    <span class="badge-categoria">
                                        <?php echo htmlspecialchars($prato['categoria']); ?>
                                    </span>

                                </td>


                                <td>

                                    <?php echo htmlspecialchars($prato['cadastrado_por']); ?>

                                </td>


                                <td class="text-center pe-4 acoes">

                                    <div class="d-inline-flex gap-2">

                                        <a
                                            href="public/editar_prato.php?id=<?php echo $prato['id']; ?>"
                                            class="btn btn-sm btn-outline-success"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                            Editar
                                        </a>


                                        <a
                                            href="public/excluir_prato.php?id=<?php echo $prato['id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Tem certeza que deseja excluir este prato?');"
                                        >
                                            <i class="bi bi-trash3"></i>
                                            Excluir
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

    <footer class="text-center py-4">
        <div class="container">
            <i class="bi bi-shop me-1"></i>
            Sistema de Controle de Restaurante
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>