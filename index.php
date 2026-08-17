<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Pratos - Restaurante</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #1f1c2c, #928dab);
            --card-users: linear-gradient(135deg, #667eea, #764ba2);
            --card-dishes: linear-gradient(135deg, #11998e, #38ef7d);
        }
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
            letter-spacing: -0.5px;
        }
        .dashboard-container {
            margin-top: 50px;
        }
        .main-card {
            border: none;
            border-radius: 20px;
            color: white;
            padding: 35px 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        }
        .main-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        .card-users { background: var(--card-users); }
        .card-dishes { background: var(--card-dishes); }
        
        .card-icon {
            font-size: 3.5rem;
            opacity: 0.2;
            position: absolute;
            right: 25px;
            top: 20px;
            transition: transform 0.3s ease;
        }
        .main-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
            opacity: 0.3;
        }
        .btn-custom {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s ease;
        }
        .btn-custom:hover {
            background: #ffffff;
            color: #2d3748;
            border-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .section-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 8px;
        }
        .section-desc {
            font-size: 0.95rem;
            opacity: 0.85;
            margin-bottom: 30px;
            max-width: 85%;
        }
    </style>
</head>
<body>

    <!-- Header Totalmente Limpo (Apenas o Nome do Site) -->
    <header class="header-clean text-center">
        <div class="container">
            <span class="brand-title">
                <i class="bi bi-fire text-danger me-2"></i>ChefControl Sistema
            </span>
        </div>
    </header>

    <!-- Painel de Botões e Ações -->
    <main class="container dashboard-container flex-grow-1">
        <div class="row g-4 justify-content-center">
            
            <!-- Módulo de Usuários (RF1) -->
            <div class="col-lg-5 col-md-6">
                <div class="card main-card card-users">
                    <i class="bi bi-person-badge card-icon"></i>
                    <h2 class="section-title">Colaboradores</h2>
                    <p class="section-desc">Cadastre e gerencie a equipe responsável por registrar as receitas do restaurante.</p>
                    
                    <div class="d-grid gap-3">
                        <a href="cadastrar_usuario.php" class="btn btn-custom">
                            <i class="bi bi-person-plus-fill"></i> Cadastrar Usuário
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Módulo de Pratos (RF2, RF3, RF4, RF5, RF6) -->
            <div class="col-lg-5 col-md-6">
                <div class="card main-card card-dishes">
                    <i class="bi bi-egg-fried card-icon"></i>
                    <h2 class="section-title">Gerenciamento de Pratos</h2>
                    <p class="section-desc">Controle o cardápio vinculando cada prato ao seu respectivo criador.</p>
                    
                    <div class="d-grid gap-3">
                        <a href="cadastrar_prato.php" class="btn btn-custom">
                            <i class="bi bi-plus-circle-fill"></i> Cadastrar Novo Prato
                        </a>
                        <a href="listar_pratos.php" class="btn btn-custom">
                            <i class="bi bi-journal-text"></i> Listar, Editar e Excluir
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer Discreto -->
    <footer class="text-center py-4 text-muted mt-5" style="font-size: 0.85rem;">
        <div class="container">
            &copy; 2026 ChefControl - Painel de Controle de Pratos Acadêmico.
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://jsdelivr.net"></script>
</body>
</html>