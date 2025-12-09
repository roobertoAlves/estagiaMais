<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'ESTAGIA+'; ?></title>
    
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #F5F7FA;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .student-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .student-sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--azul) 0%, #0D2158 100%);
            color: var(--branco);
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-brand {
            padding: var(--spacing-lg);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-brand h2 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--branco);
        }

        .sidebar-brand .subtitle {
            font-size: 0.8rem;
            color: var(--amarelo);
            margin-top: 4px;
        }

        .sidebar-user {
            padding: var(--spacing-md);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-user img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--amarelo);
            object-fit: cover;
        }

        .sidebar-user h3 {
            margin: var(--spacing-sm) 0 4px;
            font-size: 1rem;
            color: var(--branco);
        }

        .sidebar-user p {
            margin: 0;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-menu {
            list-style: none;
            padding: var(--spacing-md) 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px var(--spacing-lg);
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--branco);
            border-left-color: var(--amarelo);
        }

        .sidebar-menu a.active {
            background: rgba(242, 196, 0, 0.15);
            color: var(--amarelo);
            border-left-color: var(--amarelo);
            font-weight: 600;
        }

        .sidebar-menu i {
            width: 24px;
            margin-right: var(--spacing-sm);
            font-size: 1.1rem;
        }

        /* Main Content */
        .student-main {
            margin-left: 260px;
            flex: 1;
            padding: var(--spacing-lg);
        }

        .student-header {
            background: var(--branco);
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: var(--spacing-lg);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .student-header h1 {
            margin: 0;
            color: var(--azul);
            font-size: 1.8rem;
        }

        .student-header .breadcrumb {
            color: var(--cinza-medio);
            font-size: 0.9rem;
        }

        .student-content {
            background: var(--branco);
            padding: var(--spacing-lg);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .stat-card {
            background: var(--branco);
            padding: var(--spacing-md);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-right: var(--spacing-md);
        }

        .stat-icon.blue { background: rgba(11, 25, 79, 0.1); color: var(--azul); }
        .stat-icon.yellow { background: rgba(242, 196, 0, 0.1); color: var(--amarelo); }
        .stat-icon.green { background: rgba(76, 175, 80, 0.1); color: #4CAF50; }
        .stat-icon.red { background: rgba(244, 67, 54, 0.1); color: #F44336; }

        .stat-info h3 {
            margin: 0 0 4px;
            font-size: 2rem;
            color: var(--azul);
        }

        .stat-info p {
            margin: 0;
            color: var(--cinza-medio);
            font-size: 0.9rem;
        }

        /* Vaga Card */
        .vagas-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: var(--spacing-md);
            margin-top: var(--spacing-md);
        }

        .vaga-card {
            background: var(--branco);
            border: 2px solid var(--cinza-claro);
            border-radius: 8px;
            padding: var(--spacing-md);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .vaga-card:hover {
            border-color: var(--azul);
            box-shadow: 0 4px 20px rgba(11, 25, 79, 0.15);
            transform: translateY(-4px);
        }

        .vaga-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: var(--spacing-sm);
        }

        .vaga-title {
            flex: 1;
        }

        .vaga-title h3 {
            margin: 0 0 4px;
            color: var(--azul);
            font-size: 1.2rem;
        }

        .vaga-company {
            color: var(--cinza-medio);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .vaga-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-remoto { background: #E3F2FD; color: #1976D2; }
        .badge-presencial { background: #F3E5F5; color: #7B1FA2; }
        .badge-hibrido { background: #FFF3E0; color: #F57C00; }

        .vaga-details {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-sm);
            margin: var(--spacing-sm) 0;
            padding: var(--spacing-sm) 0;
            border-top: 1px solid var(--cinza-claro);
            border-bottom: 1px solid var(--cinza-claro);
        }

        .vaga-detail {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--cinza-escuro);
            font-size: 0.85rem;
        }

        .vaga-detail i {
            color: var(--azul);
        }

        .vaga-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: var(--spacing-sm);
        }

        .vaga-salary {
            font-size: 1.1rem;
            font-weight: 700;
            color: #4CAF50;
        }

        .btn-apply {
            background: var(--amarelo);
            color: var(--azul);
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-apply:hover {
            background: #E0B200;
            transform: scale(1.05);
        }

        .btn-applied {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: default;
        }

        /* Filters */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--cinza-claro);
            border-radius: 8px;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            font-weight: 600;
            color: var(--azul);
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid var(--cinza-medio);
            border-radius: 6px;
            font-size: 0.9rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: var(--spacing-xl);
            color: var(--cinza-medio);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: var(--spacing-md);
            opacity: 0.3;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: var(--spacing-sm);
            border-bottom: 2px solid var(--cinza-claro);
            margin-bottom: var(--spacing-lg);
        }

        .tab {
            padding: var(--spacing-sm) var(--spacing-md);
            background: none;
            border: none;
            color: var(--cinza-medio);
            font-weight: 600;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: var(--azul);
            border-bottom-color: var(--amarelo);
        }

        .tab:hover {
            color: var(--azul);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--branco);
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--azul), #0D2158);
            color: var(--branco);
            padding: var(--spacing-lg);
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--branco);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .modal-body {
            padding: var(--spacing-lg);
        }

        .modal-footer {
            padding: var(--spacing-md) var(--spacing-lg);
            border-top: 1px solid var(--cinza-claro);
            display: flex;
            gap: var(--spacing-sm);
            justify-content: flex-end;
        }

        .alert-info {
            background: #E3F2FD;
            border-left: 4px solid #2196F3;
            padding: var(--spacing-md);
            border-radius: 6px;
            margin-bottom: var(--spacing-md);
            color: #1565C0;
        }

        .alert-success {
            background: #E8F5E9;
            border-left: 4px solid #4CAF50;
            padding: var(--spacing-md);
            border-radius: 6px;
            margin-bottom: var(--spacing-md);
            color: #2E7D32;
        }

        .alert-warning {
            background: #FFF3E0;
            border-left: 4px solid #FF9800;
            padding: var(--spacing-md);
            border-radius: 6px;
            margin-bottom: var(--spacing-md);
            color: #E65100;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 2px solid var(--cinza-medio);
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: var(--spacing-md);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--azul);
        }

        label {
            display: block;
            font-weight: 600;
            color: var(--azul);
            margin-bottom: 6px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .student-sidebar {
                transform: translateX(-260px);
            }

            .student-sidebar.open {
                transform: translateX(0);
            }

            .student-main {
                margin-left: 0;
            }

            .vagas-list {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="student-wrapper">
        <!-- Sidebar -->
        <aside class="student-sidebar">
            <div class="sidebar-brand">
                <h2>ESTAGIA<span style="color: var(--amarelo);">+</span></h2>
                <p class="subtitle">Painel do Estudante</p>
            </div>

            <div class="sidebar-user">
                <img src="<?php echo $user['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($user['name'] ?? 'User') . '&background=F2C400&color=0B194F'; ?>" alt="Avatar">
                <h3><?php echo htmlspecialchars($user['name'] ?? 'Estudante'); ?></h3>
                <p><?php echo htmlspecialchars($user['course'] ?? 'Curso não definido'); ?></p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="<?php echo url('/aluno/dashboard'); ?>" class="<?php echo ($page === 'dashboard' ? 'active' : ''); ?>">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/aluno/vagas'); ?>" class="<?php echo ($page === 'vagas' ? 'active' : ''); ?>">
                        <i class="fas fa-briefcase"></i>
                        <span>Explorar Vagas</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/aluno/candidaturas'); ?>" class="<?php echo ($page === 'candidaturas' ? 'active' : ''); ?>">
                        <i class="fas fa-paper-plane"></i>
                        <span>Minhas Candidaturas</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/aluno/curriculo'); ?>" class="<?php echo ($page === 'curriculo' ? 'active' : ''); ?>">
                        <i class="fas fa-file-alt"></i>
                        <span>Meu Currículo</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/aluno/perfil'); ?>" class="<?php echo ($page === 'perfil' ? 'active' : ''); ?>">
                        <i class="fas fa-user-circle"></i>
                        <span>Meu Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/aluno/favoritos'); ?>" class="<?php echo ($page === 'favoritos' ? 'active' : ''); ?>">
                        <i class="fas fa-star"></i>
                        <span>Vagas Favoritas</span>
                    </a>
                </li>
                <li style="margin-top: var(--spacing-lg);">
                    <a href="<?php echo url('/'); ?>">
                        <i class="fas fa-arrow-left"></i>
                        <span>Voltar ao Site</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/logout'); ?>">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="student-main">
            <?php echo $content ?? ''; ?>
        </main>
    </div>

    <!-- Modal Detalhes da Vaga -->
    <div id="modalVagaDetalhes" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalVagaTitulo">Detalhes da Vaga</h2>
                <button class="modal-close" onclick="closeModal('modalVagaDetalhes')">&times;</button>
            </div>
            <div class="modal-body" id="modalVagaBody">
                <!-- Conteúdo será inserido dinamicamente -->
            </div>
            <div class="modal-footer">
                <button class="btn-apply" style="background: var(--cinza-medio); color: white;" onclick="closeModal('modalVagaDetalhes')">
                    <i class="fas fa-times"></i> Fechar
                </button>
                <button class="btn-apply" id="btnCandidatarModal">
                    <i class="fas fa-paper-plane"></i> Candidatar-se
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Candidatura -->
    <div id="modalCandidatura" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirmar Candidatura</h2>
                <button class="modal-close" onclick="closeModal('modalCandidatura')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert-info">
                    <i class="fas fa-info-circle"></i> <strong>Atenção!</strong> Você está prestes a se candidatar para esta vaga.
                </div>
                <p id="vagaCandidaturaInfo" style="color: var(--cinza-escuro); margin-bottom: var(--spacing-md);"></p>
                
                <label for="mensagemCandidatura">Mensagem para o Recrutador (Opcional)</label>
                <textarea id="mensagemCandidatura" class="form-control" rows="4" 
                          placeholder="Escreva uma breve apresentação ou destaque pontos relevantes do seu perfil..."></textarea>
                
                <label>
                    <input type="checkbox" id="usarCurriculoPadrao" checked>
                    Usar meu currículo cadastrado na plataforma
                </label>
            </div>
            <div class="modal-footer">
                <button class="btn-apply" style="background: var(--cinza-medio); color: white;" onclick="closeModal('modalCandidatura')">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button class="btn-apply" onclick="confirmarCandidatura()">
                    <i class="fas fa-check"></i> Confirmar Candidatura
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Experiência -->
    <div id="modalExperiencia" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Adicionar Experiência</h2>
                <button class="modal-close" onclick="closeModal('modalExperiencia')">&times;</button>
            </div>
            <div class="modal-body">
                <label for="cargoExp">Cargo</label>
                <input type="text" id="cargoExp" class="form-control" placeholder="Ex: Desenvolvedor Júnior">
                
                <label for="empresaExp">Empresa</label>
                <input type="text" id="empresaExp" class="form-control" placeholder="Ex: Tech Company">
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm);">
                    <div>
                        <label for="inicioExp">Início</label>
                        <input type="month" id="inicioExp" class="form-control">
                    </div>
                    <div>
                        <label for="fimExp">Fim</label>
                        <input type="month" id="fimExp" class="form-control">
                    </div>
                </div>
                
                <label>
                    <input type="checkbox" id="atualExp" onchange="document.getElementById('fimExp').disabled = this.checked">
                    Trabalho aqui atualmente
                </label>
                
                <label for="descricaoExp">Descrição das Atividades</label>
                <textarea id="descricaoExp" class="form-control" rows="4" 
                          placeholder="Descreva suas principais responsabilidades e conquistas..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn-apply" style="background: var(--cinza-medio); color: white;" onclick="closeModal('modalExperiencia')">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button class="btn-apply" onclick="salvarExperiencia()">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Habilidade -->
    <div id="modalHabilidade" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Adicionar Habilidade</h2>
                <button class="modal-close" onclick="closeModal('modalHabilidade')">&times;</button>
            </div>
            <div class="modal-body">
                <label for="nomeHabilidade">Nome da Habilidade</label>
                <input type="text" id="nomeHabilidade" class="form-control" placeholder="Ex: Python, React, SQL...">
                
                <label for="nivelHabilidade">Nível de Proficiência</label>
                <select id="nivelHabilidade" class="form-control">
                    <option value="basico">Básico</option>
                    <option value="intermediario">Intermediário</option>
                    <option value="avancado">Avançado</option>
                    <option value="especialista">Especialista</option>
                </select>
                
                <label for="categoriaHabilidade">Categoria</label>
                <select id="categoriaHabilidade" class="form-control">
                    <option value="programacao">Programação</option>
                    <option value="design">Design</option>
                    <option value="dados">Análise de Dados</option>
                    <option value="infraestrutura">Infraestrutura</option>
                    <option value="soft">Soft Skills</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn-apply" style="background: var(--cinza-medio); color: white;" onclick="closeModal('modalHabilidade')">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button class="btn-apply" onclick="salvarHabilidade()">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Formação -->
    <div id="modalFormacao" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Adicionar Formação</h2>
                <button class="modal-close" onclick="closeModal('modalFormacao')">&times;</button>
            </div>
            <div class="modal-body">
                <label for="cursoForm">Curso</label>
                <input type="text" id="cursoForm" class="form-control" placeholder="Ex: Análise e Desenvolvimento de Sistemas">
                
                <label for="instituicaoForm">Instituição</label>
                <input type="text" id="instituicaoForm" class="form-control" placeholder="Ex: IFSP - Guarulhos">
                
                <label for="nivelForm">Nível</label>
                <select id="nivelForm" class="form-control">
                    <option value="tecnico">Técnico</option>
                    <option value="tecnólogo">Tecnólogo</option>
                    <option value="bacharelado">Bacharelado</option>
                    <option value="licenciatura">Licenciatura</option>
                    <option value="pos">Pós-Graduação</option>
                    <option value="mestrado">Mestrado</option>
                    <option value="doutorado">Doutorado</option>
                </select>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm);">
                    <div>
                        <label for="inicioForm">Início</label>
                        <input type="month" id="inicioForm" class="form-control">
                    </div>
                    <div>
                        <label for="fimForm">Conclusão</label>
                        <input type="month" id="fimForm" class="form-control">
                    </div>
                </div>
                
                <label>
                    <input type="checkbox" id="cursandoForm" onchange="document.getElementById('fimForm').disabled = this.checked">
                    Cursando atualmente
                </label>
            </div>
            <div class="modal-footer">
                <button class="btn-apply" style="background: var(--cinza-medio); color: white;" onclick="closeModal('modalFormacao')">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button class="btn-apply" onclick="salvarFormacao()">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sistema de persistência com localStorage
        const StorageManager = {
            get: function(key) {
                const data = localStorage.getItem(key);
                return data ? JSON.parse(data) : null;
            },
            set: function(key, value) {
                localStorage.setItem(key, JSON.stringify(value));
            },
            addToSet: function(key, value) {
                const set = this.get(key) || [];
                if (!set.includes(value)) {
                    set.push(value);
                    this.set(key, set);
                }
                return set;
            },
            removeFromSet: function(key, value) {
                let set = this.get(key) || [];
                set = set.filter(item => item !== value);
                this.set(key, set);
                return set;
            },
            isInSet: function(key, value) {
                const set = this.get(key) || [];
                return set.includes(value);
            }
        };

        // Dados da aplicação
        let vagaAtual = null;
        let todasVagas = [];
        let candidaturasRealizadas = StorageManager.get('candidaturas') || [];
        let vagasFavoritas = StorageManager.get('favoritos') || [];

        // Atualizar contadores no carregamento
        window.addEventListener('DOMContentLoaded', function() {
            atualizarEstatisticas();
            ocultarVagasCandidatadas();
            marcarFavoritos();
        });

        // Atualizar estatísticas
        function atualizarEstatisticas() {
            const candidaturas = StorageManager.get('candidaturas') || [];
            const favoritos = StorageManager.get('favoritos') || [];
            
            // Atualizar números nos cards de estatísticas
            const statCards = document.querySelectorAll('.stat-info h3');
            if (statCards[0]) statCards[0].textContent = candidaturas.length;
            if (statCards[1]) statCards[1].textContent = favoritos.length;
            
            // Calcular candidaturas em análise (excluir entrevistas e rejeitadas)
            const emAnalise = candidaturas.filter(c => {
                const cand = StorageManager.get('candidatura_' + c);
                return cand && cand.status === 'Em análise';
            }).length;
            if (statCards[2]) statCards[2].textContent = emAnalise;
        }

        // Ocultar vagas já candidatadas
        function ocultarVagasCandidatadas() {
            const candidaturas = StorageManager.get('candidaturas') || [];
            
            document.querySelectorAll('.vaga-card').forEach(card => {
                const btnCandidatar = card.querySelector('.btn-apply');
                if (!btnCandidatar) return;
                
                // Extrair ID da vaga do onclick
                const onclickAttr = btnCandidatar.getAttribute('onclick') || card.getAttribute('onclick');
                if (!onclickAttr) return;
                
                const match = onclickAttr.match(/(?:verDetalhesVaga|vagaAtual.*id:\s*)(\d+)/);
                if (match) {
                    const vagaId = parseInt(match[1]);
                    
                    if (candidaturas.includes(vagaId)) {
                        // Não ocultar, mas marcar como candidatado
                        if (btnCandidatar.textContent.includes('Candidatar')) {
                            btnCandidatar.innerHTML = '<i class="fas fa-check-circle"></i> Candidatado';
                            btnCandidatar.classList.add('btn-applied');
                            btnCandidatar.disabled = true;
                            btnCandidatar.style.background = '#4CAF50';
                            btnCandidatar.style.color = 'white';
                            btnCandidatar.style.cursor = 'not-allowed';
                        }
                    }
                }
            });
        }

        // Marcar vagas favoritas
        function marcarFavoritos() {
            const favoritos = StorageManager.get('favoritos') || [];
            
            document.querySelectorAll('.vaga-card').forEach(card => {
                const btnFavorito = card.querySelector('button[onclick*="toggleFavorito"]');
                if (!btnFavorito) return;
                
                const onclickAttr = btnFavorito.getAttribute('onclick');
                const match = onclickAttr.match(/toggleFavorito\((\d+)/);
                
                if (match) {
                    const vagaId = parseInt(match[1]);
                    
                    if (favoritos.includes(vagaId)) {
                        btnFavorito.style.background = 'var(--amarelo)';
                        btnFavorito.style.border = '2px solid var(--amarelo)';
                        btnFavorito.innerHTML = '<i class="fas fa-star" style="color: var(--azul);"></i>';
                    }
                }
            });
        }

        // Toggle sidebar mobile
        function toggleSidebar() {
            document.querySelector('.student-sidebar').classList.toggle('open');
        }

        // Tab functionality
        function switchTab(tabName) {
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });
            const targetTab = document.getElementById(tabName);
            if (targetTab) {
                targetTab.style.display = 'block';
            }
        }

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Fechar modal clicando fora
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        }

        // Exibir detalhes da vaga
        function verDetalhesVaga(vagaId, titulo, empresa, tipo, salary, location, hours, description) {
            vagaAtual = { id: vagaId, titulo, empresa, tipo, salary, location, hours, description };
            
            const candidaturas = StorageManager.get('candidaturas') || [];
            const jaCandidatou = candidaturas.includes(vagaId);
            
            document.getElementById('modalVagaTitulo').textContent = titulo;
            document.getElementById('modalVagaBody').innerHTML = `
                <div style="margin-bottom: var(--spacing-md);">
                    <h3 style="color: var(--azul); margin-bottom: var(--spacing-sm);">${titulo}</h3>
                    <p style="color: var(--cinza-medio); margin: 0;">
                        <i class="fas fa-building"></i> ${empresa}
                    </p>
                </div>

                ${jaCandidatou ? '<div class="alert-success"><i class="fas fa-check-circle"></i> Você já se candidatou para esta vaga!</div>' : ''}

                <div style="display: flex; flex-wrap: wrap; gap: var(--spacing-sm); margin-bottom: var(--spacing-md);">
                    <span class="vaga-badge badge-${tipo.toLowerCase()}">${tipo}</span>
                    <span style="padding: 6px 12px; background: #E8F5E9; color: #2E7D32; border-radius: 20px; font-size: 0.85rem;">
                        <i class="fas fa-dollar-sign"></i> ${salary}
                    </span>
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: 8px; color: var(--cinza-escuro);">
                        <i class="fas fa-map-marker-alt" style="color: var(--azul);"></i>
                        <span>${location}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--spacing-sm); color: var(--cinza-escuro);">
                        <i class="fas fa-clock" style="color: var(--azul);"></i>
                        <span>${hours}</span>
                    </div>
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <h4 style="color: var(--azul); margin-bottom: 8px;">Descrição da Vaga</h4>
                    <p style="color: var(--cinza-escuro); line-height: 1.6;">${description}</p>
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <h4 style="color: var(--azul); margin-bottom: 8px;">Requisitos</h4>
                    <ul style="color: var(--cinza-escuro); line-height: 1.8;">
                        <li>Cursando ensino superior em área relacionada</li>
                        <li>Conhecimento em tecnologias relevantes</li>
                        <li>Boa comunicação e trabalho em equipe</li>
                        <li>Proatividade e vontade de aprender</li>
                    </ul>
                </div>

                <div style="background: #E3F2FD; padding: var(--spacing-md); border-radius: 8px;">
                    <h4 style="color: var(--azul); margin: 0 0 8px;">Benefícios</h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        <span style="padding: 4px 12px; background: white; border-radius: 16px; font-size: 0.85rem;">
                            <i class="fas fa-utensils"></i> Vale Alimentação
                        </span>
                        <span style="padding: 4px 12px; background: white; border-radius: 16px; font-size: 0.85rem;">
                            <i class="fas fa-bus"></i> Vale Transporte
                        </span>
                        <span style="padding: 4px 12px; background: white; border-radius: 16px; font-size: 0.85rem;">
                            <i class="fas fa-graduation-cap"></i> Auxílio Educação
                        </span>
                        <span style="padding: 4px 12px; background: white; border-radius: 16px; font-size: 0.85rem;">
                            <i class="fas fa-heartbeat"></i> Plano de Saúde
                        </span>
                    </div>
                </div>
            `;

            const btnCandidatar = document.getElementById('btnCandidatarModal');
            if (jaCandidatou) {
                btnCandidatar.innerHTML = '<i class="fas fa-check"></i> Já Candidatado';
                btnCandidatar.disabled = true;
                btnCandidatar.style.background = '#4CAF50';
                btnCandidatar.style.cursor = 'not-allowed';
            } else {
                btnCandidatar.innerHTML = '<i class="fas fa-paper-plane"></i> Candidatar-se';
                btnCandidatar.disabled = false;
                btnCandidatar.style.background = 'var(--amarelo)';
                btnCandidatar.style.cursor = 'pointer';
                btnCandidatar.onclick = () => {
                    closeModal('modalVagaDetalhes');
                    abrirModalCandidatura();
                };
            }

            openModal('modalVagaDetalhes');
        }

        // Abrir modal de candidatura
        function abrirModalCandidatura() {
            if (!vagaAtual) return;
            
            document.getElementById('vagaCandidaturaInfo').innerHTML = `
                <strong>Vaga:</strong> ${vagaAtual.titulo}<br>
                <strong>Empresa:</strong> ${vagaAtual.empresa}
            `;
            
            openModal('modalCandidatura');
        }

        // Confirmar candidatura
        function confirmarCandidatura() {
            if (!vagaAtual) return;
            
            const mensagem = document.getElementById('mensagemCandidatura').value;
            const usarCurriculo = document.getElementById('usarCurriculoPadrao').checked;
            
            // Salvar candidatura
            StorageManager.addToSet('candidaturas', vagaAtual.id);
            
            // Salvar detalhes da candidatura
            const candidatura = {
                id: vagaAtual.id,
                title: vagaAtual.titulo,
                company: vagaAtual.empresa,
                type: vagaAtual.tipo,
                salary: vagaAtual.salary,
                location: vagaAtual.location,
                status: 'Em análise',
                date: new Date().toLocaleDateString('pt-BR'),
                mensagem: mensagem,
                usouCurriculo: usarCurriculo
            };
            
            StorageManager.set('candidatura_' + vagaAtual.id, candidatura);
            
            closeModal('modalCandidatura');
            
            // Limpar formulário
            document.getElementById('mensagemCandidatura').value = '';
            
            // Atualizar UI
            ocultarVagasCandidatadas();
            atualizarEstatisticas();
            
            // Mostrar mensagem de sucesso
            showNotification('Candidatura enviada com sucesso! 🎉 Você pode acompanhá-la em "Minhas Candidaturas"', 'success');
            
            // Se estiver na página de candidaturas, recarregar
            if (window.location.href.includes('/aluno/candidaturas')) {
                setTimeout(() => location.reload(), 1500);
            }
        }

        // Favoritar vaga
        function toggleFavorito(vagaId, btnElement) {
            if (StorageManager.isInSet('favoritos', vagaId)) {
                StorageManager.removeFromSet('favoritos', vagaId);
                btnElement.style.background = 'transparent';
                btnElement.style.border = '2px solid var(--amarelo)';
                btnElement.innerHTML = '<i class="fas fa-star"></i>';
                showNotification('Vaga removida dos favoritos', 'info');
            } else {
                StorageManager.addToSet('favoritos', vagaId);
                btnElement.style.background = 'var(--amarelo)';
                btnElement.style.border = '2px solid var(--amarelo)';
                btnElement.innerHTML = '<i class="fas fa-star" style="color: var(--azul);"></i>';
                showNotification('Vaga adicionada aos favoritos! ⭐', 'success');
            }
            
            atualizarEstatisticas();
            
            // Se estiver na página de favoritos, recarregar
            if (window.location.href.includes('/aluno/favoritos')) {
                setTimeout(() => location.reload(), 1000);
            }
        }

        // Remover dos favoritos
        function removerFavorito(vagaId) {
            StorageManager.removeFromSet('favoritos', vagaId);
            showNotification('Vaga removida dos favoritos', 'info');
            atualizarEstatisticas();
            
            // Recarregar página
            setTimeout(() => location.reload(), 500);
        }

        // Salvar experiência
        function salvarExperiencia() {
            const cargo = document.getElementById('cargoExp').value;
            const empresa = document.getElementById('empresaExp').value;
            
            if (!cargo || !empresa) {
                showNotification('Preencha os campos obrigatórios', 'warning');
                return;
            }
            
            // Salvar no localStorage
            const experiencias = StorageManager.get('experiencias') || [];
            const novaExp = {
                id: Date.now(),
                cargo: cargo,
                empresa: empresa,
                inicio: document.getElementById('inicioExp').value,
                fim: document.getElementById('fimExp').value,
                atual: document.getElementById('atualExp').checked,
                descricao: document.getElementById('descricaoExp').value
            };
            
            experiencias.push(novaExp);
            StorageManager.set('experiencias', experiencias);
            
            closeModal('modalExperiencia');
            showNotification('Experiência adicionada com sucesso!', 'success');
            
            // Limpar formulário
            document.getElementById('cargoExp').value = '';
            document.getElementById('empresaExp').value = '';
            document.getElementById('inicioExp').value = '';
            document.getElementById('fimExp').value = '';
            document.getElementById('descricaoExp').value = '';
            document.getElementById('atualExp').checked = false;
            
            // Recarregar se estiver na página de currículo
            if (window.location.href.includes('/aluno/curriculo')) {
                setTimeout(() => location.reload(), 1000);
            }
        }

        // Salvar habilidade
        function salvarHabilidade() {
            const nome = document.getElementById('nomeHabilidade').value;
            
            if (!nome) {
                showNotification('Digite o nome da habilidade', 'warning');
                return;
            }
            
            // Salvar no localStorage
            const habilidades = StorageManager.get('habilidades') || [];
            const novaHab = {
                id: Date.now(),
                nome: nome,
                nivel: document.getElementById('nivelHabilidade').value,
                categoria: document.getElementById('categoriaHabilidade').value
            };
            
            habilidades.push(novaHab);
            StorageManager.set('habilidades', habilidades);
            
            closeModal('modalHabilidade');
            showNotification('Habilidade adicionada com sucesso!', 'success');
            
            // Limpar formulário
            document.getElementById('nomeHabilidade').value = '';
            
            // Recarregar se estiver na página de currículo
            if (window.location.href.includes('/aluno/curriculo')) {
                setTimeout(() => location.reload(), 1000);
            }
        }

        // Salvar formação
        function salvarFormacao() {
            const curso = document.getElementById('cursoForm').value;
            const instituicao = document.getElementById('instituicaoForm').value;
            
            if (!curso || !instituicao) {
                showNotification('Preencha os campos obrigatórios', 'warning');
                return;
            }
            
            // Salvar no localStorage
            const formacoes = StorageManager.get('formacoes') || [];
            const novaForm = {
                id: Date.now(),
                curso: curso,
                instituicao: instituicao,
                nivel: document.getElementById('nivelForm').value,
                inicio: document.getElementById('inicioForm').value,
                fim: document.getElementById('fimForm').value,
                cursando: document.getElementById('cursandoForm').checked
            };
            
            formacoes.push(novaForm);
            StorageManager.set('formacoes', formacoes);
            
            closeModal('modalFormacao');
            showNotification('Formação adicionada com sucesso!', 'success');
            
            // Limpar formulário
            document.getElementById('cursoForm').value = '';
            document.getElementById('instituicaoForm').value = '';
            
            // Recarregar se estiver na página de currículo
            if (window.location.href.includes('/aluno/curriculo')) {
                setTimeout(() => location.reload(), 1000);
            }
        }

        // Sistema de notificações
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 16px 24px;
                background: ${type === 'success' ? '#4CAF50' : type === 'warning' ? '#FF9800' : '#2196F3'};
                color: white;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                z-index: 10001;
                animation: slideInRight 0.3s ease;
                font-weight: 500;
                max-width: 350px;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Adicionar animações CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
