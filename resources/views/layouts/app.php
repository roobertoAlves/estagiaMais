<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($description ?? 'ESTAGIA+'); ?>">
    <meta name="theme-color" content="#071126">
    <title><?php echo e($title ?? 'ESTAGIA+'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/app-home.css'); ?>">
</head>
<body class="page-home" data-base-url="<?php echo e(BASE_URL); ?>">
    <a class="skip-link" href="#conteudo">Pular para o conteúdo</a>
    <div class="page-loader" aria-hidden="true"><span></span></div>

    <header class="site-header">
        <div class="shell header-inner">
            <a class="brand" href="#top" aria-label="ESTAGIA+ — voltar ao início">
                <span class="brand-mark">+</span>
                <span>ESTAGIA<span>+</span></span>
            </a>
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-navigation" aria-label="Abrir menu">
                <span></span><span></span>
            </button>
            <nav class="main-nav" id="main-navigation" aria-label="Navegação principal">
                <a class="nav-link is-active" href="#top">Início</a>
                <a class="nav-link" href="#sobre">Sobre</a>
                <a class="nav-link" href="#membros">Membros</a>
                <a class="nav-link" href="#local">Local</a>
                <a class="nav-link" href="#contato">Contato</a>
            </nav>
            <a class="header-cta" href="#membros"><span>Conheça a equipe</span><span aria-hidden="true">↗</span></a>
        </div>
    </header>

    <main id="conteudo">
        <section class="hero section-dark" id="top" aria-labelledby="hero-title">
            <div class="hero-noise" aria-hidden="true"></div>
            <div class="hero-grid" aria-hidden="true"></div>
            <div class="hero-banner" data-reveal="scale" aria-hidden="true">
                <img class="hero-banner-image" src="<?php echo asset('images/hero/estagiamais-hero-banner.webp'); ?>" alt="Estudante trabalhando em um campus conectado a novas oportunidades">
                <div class="hero-banner-overlay"></div>
                <div class="hero-banner-caption"><span>conexão que gera futuro</span><span>ESTAGIA+ / IFSP</span></div>
            </div>
            <div class="shell hero-layout">
                <div class="hero-copy" data-reveal="up">
                    <p class="section-kicker"><span class="status-dot"></span> IFSP · Guarulhos · 2024/25</p>
                    <h1 id="hero-title">O primeiro <em>+</em><br><span>da sua carreira.</span></h1>
                    <p class="hero-description">Uma plataforma acadêmica para descobrir oportunidades, compartilhar possibilidades e transformar intenção em experiência.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#sobre">Explorar o projeto <span aria-hidden="true">↘</span></a>
                        <a class="text-link" href="#membros">Conhecer os membros <span aria-hidden="true">→</span></a>
                    </div>
                    <div class="hero-meta">
                        <div><strong>01</strong><span>Conexão entre<br>talentos e futuro</span></div>
                        <div><strong>02</strong><span>Feito por alunos<br>para a comunidade</span></div>
                    </div>
                </div>
            </div>
            <div class="hero-scroll"><span>Role para descobrir</span><span class="scroll-line"></span></div>
        </section>

        <section class="intro section-light" id="sobre" aria-labelledby="about-title">
            <div class="shell intro-grid">
                <div class="section-heading" data-reveal="up">
                    <p class="section-kicker">01 / sobre</p>
                    <h2 id="about-title">Oportunidade<br><em>não espera.</em></h2>
                </div>
                <div class="intro-copy" data-reveal="up">
                    <p class="lead">O ESTAGIA+ nasce para aproximar estudantes, professores e empresas em um espaço mais claro, acessível e humano.</p>
                    <p>Centralizamos possibilidades de estágio, organizamos caminhos e damos visibilidade aos talentos que estão construindo o próximo capítulo da própria carreira.</p>
                    <a class="underlined-link" href="#contato">Fale com a gente <span aria-hidden="true">↗</span></a>
                </div>
            </div>
            <div class="shell about-profile">
                <div class="about-profile-header">
                    <p class="section-kicker">Sobre ESTAGIA+</p>
                    <h3>Estrutura para transformar oportunidade em desenvolvimento.</h3>
                </div>
                <div class="purpose-grid">
                    <article class="purpose-card"><span class="detail-label">Missão</span><p>Oferecer aos estudantes uma plataforma integrada e acessível que centraliza oportunidades de estágio, facilita a comunicação com professores e empresas, e promove o desenvolvimento profissional por meio de ferramentas digitais eficientes, seguras e alinhadas ao ambiente acadêmico.</p></article>
                    <article class="purpose-card"><span class="detail-label">Visão</span><p>Tornar-se a principal plataforma acadêmica de apoio à empregabilidade estudantil no IFSP e, futuramente, expandir-se para instituições de ensino em todo o país.</p></article>
                    <article class="purpose-card purpose-values"><span class="detail-label">Valores</span><p>Acessibilidade <span>•</span> Inovação <span>•</span> Ética <span>•</span> Responsabilidade Social <span>•</span> Colaboração <span>•</span> Credibilidade <span>•</span> Desenvolvimento Contínuo</p></article>
                </div>
            </div>
            <div class="shell principles-section">
                <div class="principles-heading"><p class="section-kicker">Nossos Valores</p><p>Princípios que orientam cada decisão, interação e funcionalidade do ESTAGIA+.</p></div>
                <div class="principles-grid">
                    <article class="principle-card"><span>01</span><h3>Acessibilidade</h3><p>Garantir que todos os estudantes tenham acesso igualitário às oportunidades.</p></article>
                    <article class="principle-card"><span>02</span><h3>Inovação</h3><p>Promover soluções criativas e tecnológicas que otimizem o processo de busca por estágios.</p></article>
                    <article class="principle-card"><span>03</span><h3>Ética e Transparência</h3><p>Tratar dados com responsabilidade seguindo rigorosamente a LGPD.</p></article>
                    <article class="principle-card"><span>04</span><h3>Colaboração</h3><p>Estimular a interação entre alunos, professores e empresas.</p></article>
                </div>
            </div>
            <div class="shell swot-section" aria-labelledby="swot-title">
                <div class="swot-heading"><p class="section-kicker">Análise SWOT</p><h3 id="swot-title">Visão clara para evoluir com responsabilidade.</h3></div>
                <div class="swot-grid">
                    <article class="swot-card strength"><span>Forças</span><ul><li>Centralização de vagas em único ambiente</li><li>Integração com dados da instituição</li><li>Feedback direto de professores</li><li>Chat integrado</li><li>Interface personalizada para IFSP</li></ul></article>
                    <article class="swot-card weakness"><span>Fraquezas</span><ul><li>Dependência de APIs externas</li><li>Necessidade de apoio administrativo</li><li>Complexidade do escopo inicial</li><li>Manutenção contínua requerida</li><li>Inexperiência gerencial</li></ul></article>
                    <article class="swot-card opportunity"><span>Oportunidades</span><ul><li>Alta demanda por soluções de empregabilidade</li><li>Expansão para outros campi do IFSP</li><li>Parcerias com empresas</li><li>Acesso a editais de inovação</li><li>Gamificação e trilhas de capacitação</li></ul></article>
                    <article class="swot-card threat"><span>Ameaças</span><ul><li>Concorrência com plataformas consolidadas</li><li>Restrições da LGPD</li><li>Barreiras técnicas em integrações</li><li>Possível baixa adesão inicial</li><li>Dependência de engajamento de professores</li></ul></article>
                </div>
            </div>
        </section>

        <section class="statement section-yellow" aria-label="Manifesto ESTAGIA+">
            <div class="shell statement-inner" data-reveal="up">
                <p class="section-kicker">uma plataforma com propósito</p>
                <h2>Mais que uma vaga.<br><span>Um ponto de partida.</span></h2>
                <div class="statement-footer"><span>ESTAGIA+ / IFSP Guarulhos</span><span>Construído para ir além.</span></div>
            </div>
        </section>

        <section class="members section-light" id="membros" aria-labelledby="members-title">
            <div class="shell">
                <div class="members-heading">
                    <div class="section-heading" data-reveal="up"><p class="section-kicker">02 / membros</p><h2 id="members-title">Quem faz<br><em>acontecer.</em></h2></div>
                    <p data-reveal="up">Ideias fortes ficam ainda melhores quando encontram pessoas com repertórios diferentes. Conheça quem constrói o ESTAGIA+.</p>
                </div>
                <div class="members-grid">
                    <?php foreach (($team_members ?? []) as $index => $member): ?>
                        <article class="member-card" data-member-card data-member-id="<?php echo e($member['id']); ?>" data-reveal="up" style="--delay: <?php echo ($index * 70); ?>ms">
                            <button class="member-card-button" type="button" aria-haspopup="dialog" aria-controls="member-modal" aria-label="Abrir dossiê de <?php echo e($member['name']); ?>">
                                <div class="member-image-wrap"><img src="<?php echo asset($member['image']); ?>" alt="Retrato de <?php echo e($member['name']); ?>" loading="lazy"><span class="member-arrow" aria-hidden="true">↗</span></div>
                                <div class="member-card-body"><p class="member-eyebrow"><?php echo e($member['eyebrow']); ?></p><h3><?php echo e($member['short_name']); ?></h3><p class="member-role"><?php echo e($member['role']); ?></p><span class="member-more">Ver dossiê <span aria-hidden="true">→</span></span></div>
                            </button>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="local section-dark" id="local" aria-labelledby="local-title">
            <div class="shell local-grid">
                <div class="section-heading" data-reveal="up"><p class="section-kicker">03 / local</p><h2 id="local-title">De Guarulhos<br><em>para o mundo.</em></h2></div>
                <div class="local-panel" data-reveal="up">
                    <div class="local-map"><div class="map-grid" aria-hidden="true"></div><div class="map-pin"><span></span></div><div class="map-label"><strong>IFSP</strong><span>Campus Guarulhos</span></div><span class="map-coordinate">23°27' S · 46°32' W</span></div>
                    <div class="local-details"><p class="local-address">Av. Sete de Setembro, 1271<br>Centro · Guarulhos — SP</p><div><span class="detail-label">Atendimento</span><span>Segunda a sexta · 08h às 18h</span></div><a class="underlined-link light-link" href="https://maps.google.com/?q=Instituto+Federal+de+S%C3%A3o+Paulo+-+Campus+Guarulhos" target="_blank" rel="noopener noreferrer">Abrir no Google Maps <span aria-hidden="true">↗</span></a></div>
                </div>
            </div>
        </section>

        <section class="contact section-yellow" id="contato" aria-labelledby="contact-title">
            <div class="shell contact-inner" data-reveal="up">
                <p class="section-kicker">04 / contato</p>
                <h2 id="contact-title">Vamos construir<br><em>o próximo +.</em></h2>
                <div class="contact-bottom"><p>Tem uma ideia, parceria ou oportunidade para compartilhar? Estamos por perto.</p><a class="contact-email" href="mailto:contato@ifsp.edu.br">contato@ifsp.edu.br <span aria-hidden="true">↗</span></a></div>
            </div>
        </section>
    </main>

    <footer class="site-footer section-dark">
        <div class="shell footer-inner"><a class="brand" href="#top"><span class="brand-mark">+</span><span>ESTAGIA<span>+</span></span></a><p>Feito por alunos do IFSP Guarulhos para aproximar talento e oportunidade.</p><span class="footer-year">© <?php echo date('Y'); ?> ESTAGIA+</span></div>
    </footer>

    <div class="modal-backdrop" id="member-modal" aria-hidden="true">
        <div class="member-modal" role="dialog" aria-modal="true" aria-labelledby="modal-member-name">
            <button class="modal-close" type="button" aria-label="Fechar dossiê">×</button>
            <div class="modal-accent" aria-hidden="true"></div>
            <div class="modal-grid">
                <div class="modal-profile"><div class="modal-image-wrap"><img id="modal-member-image" src="" alt=""></div><p id="modal-member-eyebrow" class="member-eyebrow"></p><p id="modal-member-role" class="modal-role"></p></div>
                <div class="modal-content"><p class="section-kicker">dossiê do membro</p><h2 id="modal-member-name"></h2><p id="modal-member-bio" class="modal-bio"></p><div><span class="detail-label">Pontos fortes</span><ul id="modal-member-strengths" class="strength-list"></ul></div><div><span class="detail-label">Stack & ferramentas</span><div id="modal-member-skills" class="skill-list"></div></div><div><span class="detail-label">Encontrar na rede</span><div id="modal-member-links" class="modal-links"></div></div></div>
            </div>
        </div>
    </div>

    <script>
        window.estagiaMembers = <?php echo json_encode($team_members ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
    <script src="<?php echo asset('js/app.js'); ?>"></script>
</body>
</html>
