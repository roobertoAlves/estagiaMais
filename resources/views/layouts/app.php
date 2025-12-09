<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description ?? ''; ?>">
    <title><?php echo $title ?? 'ESTAGIA+'; ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="/estagiaMais/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    
    <!-- AOS - Scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--azul) 0%, #0D2158 100%);
            color: var(--branco);
            padding: 8rem 0;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(242, 196, 0, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
        }

        .hero h1 {
            color: var(--branco);
            font-size: 3.5rem;
            margin-bottom: var(--spacing-md);
            animation: slideInDown 0.8s ease;
        }

        .hero .subtitle {
            font-size: 1.25rem;
            margin-bottom: var(--spacing-lg);
            color: var(--cinza-claro);
            line-height: 1.8;
            animation: slideInUp 0.8s ease 0.2s both;
        }

        .hero .cta-buttons {
            display: flex;
            gap: var(--spacing-md);
            margin-top: var(--spacing-lg);
            animation: fadeIn 1s ease 0.4s both;
        }

        /* Header/Navbar */
        header {
            background: var(--branco);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-md) 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--azul);
        }

        .navbar-brand span {
            color: var(--amarelo);
        }

        .navbar-menu {
            display: flex;
            gap: var(--spacing-lg);
            align-items: center;
        }

        .navbar-menu a {
            color: var(--cinza-escuro);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .navbar-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--amarelo);
            transition: width 0.3s ease;
        }

        .navbar-menu a:hover::after {
            width: 100%;
        }

        /* Seção Sobre */
        .about-section {
            padding: var(--spacing-xl) 0;
            background: var(--cinza-claro);
        }

        .about-section h2 {
            text-align: center;
            margin-bottom: var(--spacing-lg);
            position: relative;
            padding-bottom: var(--spacing-md);
        }

        .about-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--amarelo);
            border-radius: 2px;
        }

        .values-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .value-card {
            background: var(--branco);
            padding: var(--spacing-lg);
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border-left: 4px solid var(--amarelo);
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .value-card h3 {
            color: var(--azul);
            margin-bottom: var(--spacing-sm);
        }

        /* SWOT Analysis */
        .swot-section {
            padding: var(--spacing-xl) 0;
        }

        .swot-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .swot-card {
            padding: var(--spacing-lg);
            border-radius: 8px;
            color: var(--branco);
        }

        .swot-strengths {
            background: linear-gradient(135deg, #4CAF50, #45a049);
        }

        .swot-weaknesses {
            background: linear-gradient(135deg, #F44336, #da190b);
        }

        .swot-opportunities {
            background: linear-gradient(135deg, #2196F3, #0b7dda);
        }

        .swot-threats {
            background: linear-gradient(135deg, #FF9800, #e68900);
        }

        .swot-card h3 {
            color: var(--branco);
            margin-bottom: var(--spacing-md);
            font-size: 1.5rem;
        }

        .swot-card ul {
            list-style: none;
            padding-left: 0;
        }

        .swot-card li {
            padding-left: var(--spacing-md);
            position: relative;
            margin-bottom: var(--spacing-sm);
        }

        .swot-card li::before {
            content: '✓';
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* Team Section */
        .team-section {
            padding: var(--spacing-xl) 0;
            background: var(--cinza-claro);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .team-card {
            background: var(--branco);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .team-card-header {
            background: linear-gradient(135deg, var(--azul), #0D2158);
            color: var(--branco);
            padding: var(--spacing-lg);
            text-align: center;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .team-card-avatar {
            width: 100px;
            height: 100px;
            background: var(--amarelo);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin-bottom: var(--spacing-sm);
            overflow: hidden;
        }

        .team-card-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-card-avatar i {
            color: var(--azul);
        }

        .team-card-body {
            padding: var(--spacing-md);
            flex: 1;
        }

        .team-card-body h3 {
            color: var(--azul);
            margin-bottom: var(--spacing-xs);
        }

        .team-card-role {
            color: var(--amarelo);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: var(--spacing-sm);
        }

        .team-card-bio {
            color: var(--cinza-escuro);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: var(--spacing-md);
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-xs);
        }

        .skill-tag {
            background: var(--azul-claro);
            color: var(--azul);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Vagas Section */
        .vagas-section {
            padding: var(--spacing-xl) 0;
        }

        /* Localização */
        .location-section {
            padding: var(--spacing-xl) 0;
            background: #f9fafb;
        }

        .location-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: var(--spacing-lg);
            align-items: stretch;
        }

        .map-card, .location-card {
            background: var(--branco);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            padding: var(--spacing-lg);
            height: 100%;
        }

        .map-card iframe {
            width: 100%;
            height: 380px;
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .location-card h3 {
            color: var(--azul);
            margin-bottom: var(--spacing-md);
        }

        .location-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: var(--spacing-sm);
        }

        .location-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: var(--cinza-escuro);
        }

        .location-list i {
            color: var(--amarelo);
            margin-top: 3px;
        }

        .map-actions {
            display: flex;
            gap: var(--spacing-sm);
            flex-wrap: wrap;
            margin-top: var(--spacing-md);
        }

        .vagas-placeholder {
            background: var(--cinza-claro);
            padding: var(--spacing-xl);
            border-radius: 8px;
            text-align: center;
            border: 2px dashed var(--cinza-medio);
        }

        /* Footer */
        footer {
            background: var(--azul);
            color: var(--branco);
            padding: var(--spacing-xl) 0;
            margin-top: var(--spacing-xl);
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .footer-section h4 {
            color: var(--amarelo);
            margin-bottom: var(--spacing-md);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: var(--spacing-sm);
        }

        .footer-section a {
            color: var(--branco);
        }

        .footer-section a:hover {
            color: var(--amarelo);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: var(--spacing-md);
            text-align: center;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: var(--branco);
            margin: 5% auto;
            padding: var(--spacing-lg);
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            animation: slideInDown 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
            border-bottom: 2px solid var(--cinza-claro);
            padding-bottom: var(--spacing-md);
        }

        .modal-close {
            font-size: 28px;
            font-weight: bold;
            color: var(--cinza-medio);
            cursor: pointer;
            background: none;
            border: none;
        }

        .modal-close:hover {
            color: var(--cinza-escuro);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .navbar-menu {
                flex-direction: column;
                gap: var(--spacing-sm);
            }

            .hero .cta-buttons {
                flex-direction: column;
            }

            .swot-grid {
                grid-template-columns: 1fr;
            }

            .team-grid {
                grid-template-columns: 1fr;
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body id="top">
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="navbar-brand">
                    ESTAGIA<span>+</span>
                </div>
                <div class="navbar-menu">
                    <a href="#top" class="<?php echo $page === 'home' ? 'active' : ''; ?>">Início</a>
                    <a href="#sobre">Sobre</a>
                    <a href="#membros">Membros</a>
                    <a href="#local">Local</a>
                    <a href="#vagas">Vagas</a>
                    <a href="#contato">Contato</a>
                    <?php if ($user ?? false): ?>
                        <a href="/estagiaMais/perfil" class="btn btn-secondary btn-sm">Meu Perfil</a>
                        <a href="/estagiaMais/logout" class="btn btn-outline btn-sm">Sair</a>
                    <?php else: ?>
                        <a href="/estagiaMais/login" class="btn btn-primary">Entrar</a>
                        <a href="/estagiaMais/registro" class="btn btn-secondary">Cadastrar</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <!-- Conteúdo da página -->
    <?php if ($page === 'home'): ?>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container hero-content">
                <h1><?php echo $title; ?></h1>
                <p class="subtitle">
                    <?php echo $description; ?>
                </p>
                <div class="cta-buttons">
                    <?php if (!($user ?? false)): ?>
                        <a href="/estagiaMais/registro" class="btn btn-secondary btn-lg">
                            <i class="fas fa-user-plus"></i> Criar Conta
                        </a>
                        <a href="#sobre" class="btn btn-outline btn-lg" style="color: var(--branco); border-color: var(--branco);">
                            <i class="fas fa-arrow-down"></i> Saiba Mais
                        </a>
                    <?php else: ?>
                        <a href="/perfil" class="btn btn-secondary btn-lg">
                            <i class="fas fa-user"></i> Ir para Perfil
                        </a>
                        <a href="#vagas" class="btn btn-outline btn-lg" style="color: var(--branco); border-color: var(--branco);">
                            <i class="fas fa-briefcase"></i> Ver Vagas
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Sobre a Empresa -->
        <section class="about-section" id="sobre">
            <div class="container">
                <h2>Sobre ESTAGIA+</h2>

                <div class="grid-3 mt-lg">
                    <div class="card" data-aos="fade-up">
                        <h3 style="color: var(--amarelo);">Missão</h3>
                        <p>Oferecer aos estudantes uma plataforma integrada e acessível que centraliza oportunidades de estágio, facilita a comunicação com professores e empresas, e promove o desenvolvimento profissional por meio de ferramentas digitais eficientes, seguras e alinhadas ao ambiente acadêmico.</p>
                    </div>

                    <div class="card" data-aos="fade-up" data-aos-delay="100">
                        <h3 style="color: var(--amarelo);">Visão</h3>
                        <p>Tornar-se a principal plataforma acadêmica de apoio à empregabilidade estudantil no IFSP e, futuramente, expandir-se para instituições de ensino em todo o país.</p>
                    </div>

                    <div class="card" data-aos="fade-up" data-aos-delay="200">
                        <h3 style="color: var(--amarelo);">Valores</h3>
                        <p><strong>Acessibilidade</strong> • <strong>Inovação</strong> • <strong>Ética</strong> • <strong>Responsabilidade Social</strong> • <strong>Colaboração</strong> • <strong>Credibilidade</strong> • <strong>Desenvolvimento Contínuo</strong></p>
                    </div>
                </div>

                <!-- Valores (Cards) -->
                <h3 class="mt-xl mb-lg">Nossos Valores</h3>
                <div class="values-cards">
                    <div class="value-card" data-aos="fade-up">
                        <h3><i class="fas fa-universal-access"></i> Acessibilidade</h3>
                        <p>Garantir que todos os estudantes tenham acesso igualitário às oportunidades.</p>
                    </div>
                    <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                        <h3><i class="fas fa-lightbulb"></i> Inovação</h3>
                        <p>Promover soluções criativas e tecnológicas que otimizem o processo de busca por estágios.</p>
                    </div>
                    <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                        <h3><i class="fas fa-shield-alt"></i> Ética e Transparência</h3>
                        <p>Tratar dados com responsabilidade seguindo rigorosamente a LGPD.</p>
                    </div>
                    <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                        <h3><i class="fas fa-handshake"></i> Colaboração</h3>
                        <p>Estimular a interação entre alunos, professores e empresas.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SWOT Analysis -->
        <section class="swot-section">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: var(--spacing-lg);">Análise SWOT</h2>

                <div class="swot-grid">
                    <div class="swot-card swot-strengths" data-aos="fade-right">
                        <h3><i class="fas fa-check-circle"></i> Strengths</h3>
                        <ul>
                            <li>Centralização de vagas em único ambiente</li>
                            <li>Integração com dados da instituição</li>
                            <li>Feedback direto de professores</li>
                            <li>Chat integrado</li>
                            <li>Interface personalizada para IFSP</li>
                        </ul>
                    </div>

                    <div class="swot-card swot-weaknesses" data-aos="fade-left">
                        <h3><i class="fas fa-times-circle"></i> Weaknesses</h3>
                        <ul>
                            <li>Dependência de APIs externas</li>
                            <li>Necessidade de apoio administrativo</li>
                            <li>Complexidade do escopo inicial</li>
                            <li>Manutenção contínua requerida</li>
                            <li>Inexperiência gerencial</li>
                        </ul>
                    </div>

                    <div class="swot-card swot-opportunities" data-aos="fade-right" data-aos-delay="100">
                        <h3><i class="fas fa-star"></i> Opportunities</h3>
                        <ul>
                            <li>Alta demanda por soluções de empregabilidade</li>
                            <li>Expansão para outros campi do IFSP</li>
                            <li>Parcerias com empresas</li>
                            <li>Acesso a editais de inovação</li>
                            <li>Gamificação e trilhas de capacitação</li>
                        </ul>
                    </div>

                    <div class="swot-card swot-threats" data-aos="fade-left" data-aos-delay="100">
                        <h3><i class="fas fa-exclamation-circle"></i> Threats</h3>
                        <ul>
                            <li>Concorrência com plataformas consolidadas</li>
                            <li>Restrições da LGPD</li>
                            <li>Barreiras técnicas em integrações</li>
                            <li>Possível baixa adesão inicial</li>
                            <li>Dependência de engajamento de professores</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Membros da Equipe -->
        <section class="team-section" id="membros">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: var(--spacing-lg);">Nossa Equipe</h2>

                <div class="team-grid">
                    <?php foreach ($team_members as $member): ?>
                        <div class="team-card" data-aos="fade-up" onclick="openMemberModal(<?php echo $member['id']; ?>)">
                            <div class="team-card-header">
                                <div class="team-card-avatar">
                                    <?php if (isset($member['image']) && !empty($member['image'])): ?>
                                        <img src="/estagiaMais/public/images/avatars/<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                                    <?php else: ?>
                                        <i class="fas fa-user"></i>
                                    <?php endif; ?>
                                </div>
                                <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                            </div>
                            <div class="team-card-body">
                                <p class="team-card-role"><?php echo htmlspecialchars($member['role']); ?></p>
                                <p class="team-card-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
                                <div style="margin-bottom: var(--spacing-sm);">
                                    <strong style="font-size: 0.85rem; color: var(--azul);">Hard Skills</strong>
                                    <div class="skills-list mt-xs">
                                        <?php foreach (array_slice($member['hard_skills'], 0, 3) as $skill): ?>
                                            <span class="skill-tag"><?php echo htmlspecialchars($skill); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <p style="font-size: 0.75rem; color: var(--cinza-medio);">
                                    <i class="fas fa-arrow-right"></i> Clique para ver mais
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Vagas -->
        <section class="location-section" id="local">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: var(--spacing-lg);">Onde estamos</h2>
                <div class="location-grid">
                    <div class="map-card" data-aos="fade-right">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.013624833186!2d-46.5269449!3d-23.4696273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef4dce2742357%3A0x5c83b1d5d4df5d9b!2sInstituto%20Federal%20de%20S%C3%A3o%20Paulo%20-%20Campus%20Guarulhos!5e0!3m2!1spt-BR!2sbr!4v1700000000000!5m2!1spt-BR!2sbr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa do IFSP Guarulhos"></iframe>
                    </div>
                    <div class="location-card" data-aos="fade-left">
                        <h3><i class="fas fa-map-marker-alt"></i> IFSP Campus Guarulhos</h3>
                        <ul class="location-list">
                            <li><i class="fas fa-location-dot"></i><span>Av. Sete de Setembro, 1271 - Centro, Guarulhos - SP</span></li>
                            <li><i class="fas fa-bus"></i><span>Linhas de ônibus: 253, 256, 263, 276 (pontos na avenida)</span></li>
                            <li><i class="fas fa-train"></i><span>Próximo à estação "Cecap" da CPTM (Linha 13 - Jade)</span></li>
                            <li><i class="fas fa-clock"></i><span>Horário de atendimento administrativo: 08h às 18h</span></li>
                            <li><i class="fas fa-phone"></i><span>Telefone: (11) 1024-5580 | Email: contato@ifsp.edu.br</span></li>
                        </ul>
                        <div class="map-actions">
                            <a class="btn btn-primary" href="https://maps.google.com/?q=Instituto+Federal+de+S%C3%A3o+Paulo+-+Campus+Guarulhos" target="_blank" rel="noopener">Abrir no Google Maps</a>
                            <a class="btn btn-outline" href="#contato">Ver contatos</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="vagas-section" id="vagas">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: var(--spacing-lg);">Vagas de Estágio</h2>

                <div class="vagas-placeholder" data-aos="fade-up">
                    <i class="fas fa-briefcase" style="font-size: 3rem; color: var(--amarelo); margin-bottom: var(--spacing-md);"></i>
                    <h3 style="color: var(--azul);">Vagas em Breve</h3>
                    <p style="color: var(--cinza-medio); margin-bottom: var(--spacing-md);">
                        Estamos integrando plataformas externas para oferecer oportunidades incríveis!
                    </p>
                    <button class="btn btn-primary" onclick="showAlert('Integração de plataformas em desenvolvimento')">
                        <i class="fas fa-link"></i> Conectar Plataformas Externas
                    </button>
                </div>
            </div>
        </section>

        <!-- Modal para Membros -->
        <div id="memberModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalName">Membro da Equipe</h2>
                    <button class="modal-close" onclick="closeMemberModal()">&times;</button>
                </div>
                <div id="modalBody"></div>
            </div>
        </div>

    <?php endif; ?>

    <!-- Footer -->
    <footer id="contato">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Sobre</h4>
                    <ul>
                        <li><a href="#sobre">Sobre ESTAGIA+</a></li>
                        <li><a href="#membros">Nossa Equipe</a></li>
                        <li><a href="/estagiaMais/login">Entrar</a></li>
                        <li><a href="/estagiaMais/registro">Criar Conta</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>IFSP Guarulhos</h4>
                    <ul>
                        <li>Av. Sete de Setembro, 1271</li>
                        <li>Guarulhos - SP</li>
                        <li><a href="tel:+551102455800">(11) 1024-5580</a></li>
                        <li><a href="mailto:contato@ifsp.edu.br">contato@ifsp.edu.br</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="/privacidade">Política de Privacidade</a></li>
                        <li><a href="/termos">Termos de Serviço</a></li>
                        <li><a href="/lgpd">LGPD</a></li>
                        <li><a href="/acessibilidade">Acessibilidade</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Redes Sociais</h4>
                    <ul>
                        <li><a href="#" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-github"></i> GitHub</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 ESTAGIA+ - Desenvolvido por alunos do IFSP Guarulhos. Todos os direitos reservados.</p>
                <p style="font-size: 0.9rem; margin-top: var(--spacing-sm); color: rgba(255, 255, 255, 0.7);">
                    Plataforma desenvolvida para centralizar oportunidades de estágio e conectar estudantes com o mercado de trabalho.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Inicializar AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Dados dos membros
        const teamMembers = <?php echo json_encode($team_members ?? []); ?>;

        function openMemberModal(memberId) {
            const member = teamMembers.find(m => m.id === memberId);
            if (!member) return;

            document.getElementById('modalName').textContent = member.name;
            
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = `
                <div class="modal-body">
                    <p style="margin-bottom: var(--spacing-md);">
                        <strong>Cargo:</strong> ${member.role}
                    </p>
                    <p style="margin-bottom: var(--spacing-md);">
                        <strong>Bio:</strong> ${member.bio}
                    </p>

                    <h4 style="color: var(--azul); margin-bottom: var(--spacing-sm);">Hard Skills</h4>
                    <div class="skills-list mb-lg">
                        ${member.hard_skills.map(skill => `<span class="skill-tag">${skill}</span>`).join('')}
                    </div>

                    <h4 style="color: var(--azul); margin-bottom: var(--spacing-sm);">Soft Skills</h4>
                    <div class="skills-list">
                        ${member.soft_skills.map(skill => `<span class="skill-tag" style="background: var(--amarelo-claro); color: var(--amarelo);">${skill}</span>`).join('')}
                    </div>
                </div>
            `;

            document.getElementById('memberModal').style.display = 'block';
        }

        function closeMemberModal() {
            document.getElementById('memberModal').style.display = 'none';
        }

        // Fechar modal ao clicar fora
        window.onclick = function(event) {
            const modal = document.getElementById('memberModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        function showAlert(message) {
            alert(message);
        }

        // Smooth scroll para links âncora
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
