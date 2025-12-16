<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description ?? ''; ?>">
    <title><?php echo $title ?? 'ESTAGIA+'; ?></title>
    
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/app-home.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                    <a href="#contato">Contato</a>
                    <?php if ($user ?? false): ?>
                        <a href="<?php echo url('perfil'); ?>" class="btn btn-secondary btn-sm">Meu Perfil</a>
                        <a href="<?php echo url('logout'); ?>" class="btn btn-outline btn-sm">Sair</a>
                    <?php else: ?>
                        <a href="<?php echo url('login'); ?>" class="btn btn-primary">Entrar</a>
                        <a href="<?php echo url('registro'); ?>" class="btn btn-secondary">Cadastrar</a>
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
                        <a href="<?php echo url('registro'); ?>" class="btn btn-secondary btn-lg">
                            <i class="fas fa-user-plus"></i> Criar Conta
                        </a>
                        <a href="#sobre" class="btn btn-outline btn-lg" style="color: var(--branco); border-color: var(--branco);">
                            <i class="fas fa-arrow-down"></i> Saiba Mais
                        </a>
                    <?php else: ?>
                        <a href="<?php echo url('perfil'); ?>" class="btn btn-secondary btn-lg">
                            <i class="fas fa-user"></i> Ir para Perfil
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
                        <h3 style="color: var(--amarelo);"><i class="fas fa-bullseye"></i> Missão</h3>
                        <p>Oferecer aos estudantes uma plataforma integrada e acessível que centraliza oportunidades de estágio, facilita a comunicação com professores e empresas, e promove o desenvolvimento profissional por meio de ferramentas digitais eficientes, seguras e alinhadas ao ambiente acadêmico.</p>
                    </div>

                    <div class="card" data-aos="fade-up" data-aos-delay="100">
                        <h3 style="color: var(--amarelo);"><i class="fas fa-eye"></i> Visão</h3>
                        <p>Tornar-se a principal plataforma acadêmica de apoio à empregabilidade estudantil no IFSP e, futuramente, expandir-se para instituições de ensino em todo o país.</p>
                    </div>

                    <div class="card" data-aos="fade-up" data-aos-delay="200">
                        <h3 style="color: var(--amarelo);"><i class="fas fa-gem"></i> Valores</h3>
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
                        <h3><i class="fas fa-check-circle"></i> Forças</h3>
                        <ul>
                            <li>Centralização de vagas em único ambiente</li>
                            <li>Integração com dados da instituição</li>
                            <li>Feedback direto de professores</li>
                            <li>Chat integrado</li>
                            <li>Interface personalizada para IFSP</li>
                        </ul>
                    </div>

                    <div class="swot-card swot-weaknesses" data-aos="fade-left">
                        <h3><i class="fas fa-times-circle"></i> Fraquezas</h3>
                        <ul>
                            <li>Dependência de APIs externas</li>
                            <li>Necessidade de apoio administrativo</li>
                            <li>Complexidade do escopo inicial</li>
                            <li>Manutenção contínua requerida</li>
                            <li>Inexperiência gerencial</li>
                        </ul>
                    </div>

                    <div class="swot-card swot-opportunities" data-aos="fade-right" data-aos-delay="100">
                        <h3><i class="fas fa-star"></i> Oportunidades</h3>
                        <ul>
                            <li>Alta demanda por soluções de empregabilidade</li>
                            <li>Expansão para outros campi do IFSP</li>
                            <li>Parcerias com empresas</li>
                            <li>Acesso a editais de inovação</li>
                            <li>Gamificação e trilhas de capacitação</li>
                        </ul>
                    </div>

                    <div class="swot-card swot-threats" data-aos="fade-left" data-aos-delay="100">
                        <h3><i class="fas fa-exclamation-circle"></i> Ameaças</h3>
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
                                        <img src="<?php echo asset('images/avatars/' . htmlspecialchars($member['image'])); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
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

        <!-- Vagas removidas da home -->

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
                        <li><a href="<?php echo url('login'); ?>">Entrar</a></li>
                        <li><a href="<?php echo url('registro'); ?>">Criar Conta</a></li>
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
