<?php
namespace App\Controllers;

/**
 * StudentController - Gerencia área do estudante
 */
class StudentController extends Controller {
    
    public function __construct() {
        // Verificar se está autenticado
        if (!$this->isAuthenticated()) {
            $this->redirect(url('/login'));
        }
    }

    public function dashboard() {
        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();
        
        // Estatísticas do estudante
        $stats = [
            'candidaturas_enviadas' => 12,
            'vagas_favoritas' => 8,
            'em_analise' => 5,
            'entrevistas_agendadas' => 2
        ];

        // Vagas recomendadas
        $recommended_vagas = [
            [
                'id' => 1,
                'title' => 'Estágio em Desenvolvimento Web',
                'company' => 'Tech Solutions Brasil',
                'type' => 'Remoto',
                'salary' => 'R$ 1.500,00',
                'location' => 'São Paulo - SP',
                'hours' => '20h/semana',
                'posted' => '2 dias atrás',
                'match' => '95%'
            ],
            [
                'id' => 2,
                'title' => 'Estágio em UX/UI Design',
                'company' => 'Creative Digital',
                'type' => 'Híbrido',
                'salary' => 'R$ 1.200,00',
                'location' => 'Guarulhos - SP',
                'hours' => '30h/semana',
                'posted' => '3 dias atrás',
                'match' => '88%'
            ],
            [
                'id' => 3,
                'title' => 'Estágio em Análise de Dados',
                'company' => 'Data Insights',
                'type' => 'Presencial',
                'salary' => 'R$ 1.800,00',
                'location' => 'São Paulo - SP',
                'hours' => '30h/semana',
                'posted' => '1 semana atrás',
                'match' => '82%'
            ]
        ];

        // Candidaturas recentes
        $recent_applications = [
            [
                'id' => 1,
                'title' => 'Desenvolvedor Frontend',
                'company' => 'WebCorp',
                'status' => 'Em análise',
                'date' => '05/12/2025'
            ],
            [
                'id' => 2,
                'title' => 'Estágio em Python',
                'company' => 'DataTech',
                'status' => 'Entrevista agendada',
                'date' => '03/12/2025'
            ]
        ];

        $content = $this->renderStudentDashboard($stats, $recommended_vagas, $recent_applications);

        echo $this->render('layouts/student', [
            'csrf_token' => $csrf_token,
            'title' => 'Dashboard - ESTAGIA+',
            'page' => 'dashboard',
            'user' => $user,
            'content' => $content
        ]);
    }

    public function vagas() {
        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();
        
        // Todas as vagas disponíveis
        $vagas = [
            [
                'id' => 1,
                'title' => 'Estágio em Desenvolvimento Web',
                'company' => 'Tech Solutions Brasil',
                'type' => 'Remoto',
                'salary' => 'R$ 1.500,00',
                'location' => 'São Paulo - SP',
                'hours' => '20h/semana',
                'posted' => '2 dias atrás',
                'description' => 'Buscamos estudante para auxiliar no desenvolvimento de aplicações web modernas.'
            ],
            [
                'id' => 2,
                'title' => 'Estágio em UX/UI Design',
                'company' => 'Creative Digital',
                'type' => 'Híbrido',
                'salary' => 'R$ 1.200,00',
                'location' => 'Guarulhos - SP',
                'hours' => '30h/semana',
                'posted' => '3 dias atrás',
                'description' => 'Oportunidade para aprender design de interfaces e experiência do usuário.'
            ],
            [
                'id' => 3,
                'title' => 'Estágio em Análise de Dados',
                'company' => 'Data Insights',
                'type' => 'Presencial',
                'salary' => 'R$ 1.800,00',
                'location' => 'São Paulo - SP',
                'hours' => '30h/semana',
                'posted' => '1 semana atrás',
                'description' => 'Vaga para quem deseja trabalhar com análise e visualização de dados.'
            ],
            [
                'id' => 4,
                'title' => 'Desenvolvedor Mobile - Flutter',
                'company' => 'AppMakers',
                'type' => 'Remoto',
                'salary' => 'R$ 2.000,00',
                'location' => 'Remoto',
                'hours' => '30h/semana',
                'posted' => '1 semana atrás',
                'description' => 'Desenvolvimento de aplicativos mobile multiplataforma com Flutter.'
            ],
            [
                'id' => 5,
                'title' => 'Estágio em DevOps',
                'company' => 'Cloud Services',
                'type' => 'Presencial',
                'salary' => 'R$ 1.700,00',
                'location' => 'São Paulo - SP',
                'hours' => '30h/semana',
                'posted' => '2 semanas atrás',
                'description' => 'Auxílio em infraestrutura, CI/CD e automação de processos.'
            ],
            [
                'id' => 6,
                'title' => 'Estágio em Suporte Técnico',
                'company' => 'HelpDesk Pro',
                'type' => 'Híbrido',
                'salary' => 'R$ 1.100,00',
                'location' => 'Guarulhos - SP',
                'hours' => '20h/semana',
                'posted' => '3 semanas atrás',
                'description' => 'Atendimento e suporte a usuários, resolução de problemas técnicos.'
            ]
        ];

        $content = $this->renderVagasList($vagas);

        echo $this->render('layouts/student', [
            'csrf_token' => $csrf_token,
            'title' => 'Explorar Vagas - ESTAGIA+',
            'page' => 'vagas',
            'user' => $user,
            'content' => $content
        ]);
    }

    public function candidaturas() {
        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();
        
        $applications = [
            [
                'id' => 1,
                'title' => 'Desenvolvedor Frontend',
                'company' => 'WebCorp',
                'status' => 'Em análise',
                'date' => '05/12/2025',
                'salary' => 'R$ 1.500,00',
                'type' => 'Remoto'
            ],
            [
                'id' => 2,
                'title' => 'Estágio em Python',
                'company' => 'DataTech',
                'status' => 'Entrevista agendada',
                'date' => '03/12/2025',
                'salary' => 'R$ 1.800,00',
                'type' => 'Híbrido',
                'interview_date' => '15/12/2025 às 14h00'
            ],
            [
                'id' => 3,
                'title' => 'Designer UI',
                'company' => 'PixelArt',
                'status' => 'Rejeitada',
                'date' => '28/11/2025',
                'salary' => 'R$ 1.200,00',
                'type' => 'Presencial'
            ]
        ];

        $content = $this->renderApplications($applications);

        echo $this->render('layouts/student', [
            'csrf_token' => $csrf_token,
            'title' => 'Minhas Candidaturas - ESTAGIA+',
            'page' => 'candidaturas',
            'user' => $user,
            'content' => $content
        ]);
    }

    public function curriculo() {
        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();

        $content = $this->renderCurriculo($user);

        echo $this->render('layouts/student', [
            'csrf_token' => $csrf_token,
            'title' => 'Meu Currículo - ESTAGIA+',
            'page' => 'curriculo',
            'user' => $user,
            'content' => $content
        ]);
    }

    public function perfil() {
        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();

        $content = $this->renderPerfil($user);

        echo $this->render('layouts/student', [
            'csrf_token' => $csrf_token,
            'title' => 'Meu Perfil - ESTAGIA+',
            'page' => 'perfil',
            'user' => $user,
            'content' => $content
        ]);
    }

    public function favoritos() {
        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();

        $favorites = [
            [
                'id' => 1,
                'title' => 'Estágio em Desenvolvimento Web',
                'company' => 'Tech Solutions Brasil',
                'type' => 'Remoto',
                'salary' => 'R$ 1.500,00',
                'location' => 'São Paulo - SP',
                'hours' => '20h/semana',
                'posted' => '2 dias atrás'
            ],
            [
                'id' => 4,
                'title' => 'Desenvolvedor Mobile - Flutter',
                'company' => 'AppMakers',
                'type' => 'Remoto',
                'salary' => 'R$ 2.000,00',
                'location' => 'Remoto',
                'hours' => '30h/semana',
                'posted' => '1 semana atrás'
            ]
        ];

        $content = $this->renderFavoritos($favorites);

        echo $this->render('layouts/student', [
            'csrf_token' => $csrf_token,
            'title' => 'Vagas Favoritas - ESTAGIA+',
            'page' => 'favoritos',
            'user' => $user,
            'content' => $content
        ]);
    }

    private function renderStudentDashboard($stats, $recommended_vagas, $recent_applications) {
        ob_start();
        ?>
        <div class="student-header">
            <div>
                <h1>Dashboard</h1>
                <p class="breadcrumb">Bem-vindo(a) de volta! 👋</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['candidaturas_enviadas']; ?></h3>
                    <p>Candidaturas Enviadas</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['vagas_favoritas']; ?></h3>
                    <p>Vagas Favoritas</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['em_analise']; ?></h3>
                    <p>Em Análise</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['entrevistas_agendadas']; ?></h3>
                    <p>Entrevistas Agendadas</p>
                </div>
            </div>
        </div>

        <!-- Vagas Recomendadas -->
        <div class="student-content">
            <h2 style="color: var(--azul); margin-bottom: var(--spacing-md);">
                <i class="fas fa-star" style="color: var(--amarelo);"></i> Vagas Recomendadas Para Você
            </h2>
            <div class="vagas-list">
                <?php foreach ($recommended_vagas as $vaga): ?>
                    <div class="vaga-card" onclick="verDetalhesVaga(<?php echo $vaga['id']; ?>, '<?php echo htmlspecialchars($vaga['title']); ?>', '<?php echo htmlspecialchars($vaga['company']); ?>', '<?php echo $vaga['type']; ?>', '<?php echo htmlspecialchars($vaga['salary']); ?>', '<?php echo htmlspecialchars($vaga['location']); ?>', '<?php echo htmlspecialchars($vaga['hours']); ?>', 'Buscamos estudante para auxiliar no desenvolvimento de aplicações web modernas.')">
                        <div class="vaga-header">
                            <div class="vaga-title">
                                <h3><?php echo htmlspecialchars($vaga['title']); ?></h3>
                                <p class="vaga-company">
                                    <i class="fas fa-building"></i>
                                    <?php echo htmlspecialchars($vaga['company']); ?>
                                </p>
                            </div>
                            <span class="vaga-badge badge-<?php echo strtolower($vaga['type']); ?>">
                                <?php echo $vaga['type']; ?>
                            </span>
                        </div>

                        <div class="vaga-details">
                            <div class="vaga-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($vaga['location']); ?>
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-clock"></i>
                                <?php echo htmlspecialchars($vaga['hours']); ?>
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-calendar"></i>
                                <?php echo htmlspecialchars($vaga['posted']); ?>
                            </div>
                            <div class="vaga-detail" style="color: #4CAF50; font-weight: 600;">
                                <i class="fas fa-check-circle"></i>
                                <?php echo htmlspecialchars($vaga['match']); ?> compatível
                            </div>
                        </div>

                        <div class="vaga-footer">
                            <span class="vaga-salary"><?php echo htmlspecialchars($vaga['salary']); ?></span>
                            <button class="btn-apply" onclick="event.stopPropagation(); abrirModalCandidatura(); vagaAtual = {id: <?php echo $vaga['id']; ?>, titulo: '<?php echo htmlspecialchars($vaga['title']); ?>', empresa: '<?php echo htmlspecialchars($vaga['company']); ?>'}">
                                <i class="fas fa-paper-plane"></i> Candidatar
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h2 style="color: var(--azul); margin: var(--spacing-lg) 0 var(--spacing-md);">
                <i class="fas fa-history"></i> Candidaturas Recentes
            </h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: var(--cinza-claro); text-align: left;">
                            <th style="padding: var(--spacing-sm); border-bottom: 2px solid var(--cinza-medio);">Vaga</th>
                            <th style="padding: var(--spacing-sm); border-bottom: 2px solid var(--cinza-medio);">Empresa</th>
                            <th style="padding: var(--spacing-sm); border-bottom: 2px solid var(--cinza-medio);">Status</th>
                            <th style="padding: var(--spacing-sm); border-bottom: 2px solid var(--cinza-medio);">Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_applications as $app): ?>
                            <tr style="border-bottom: 1px solid var(--cinza-claro);">
                                <td style="padding: var(--spacing-sm);"><?php echo htmlspecialchars($app['title']); ?></td>
                                <td style="padding: var(--spacing-sm);"><?php echo htmlspecialchars($app['company']); ?></td>
                                <td style="padding: var(--spacing-sm);">
                                    <span style="padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; background: #E3F2FD; color: #1976D2;">
                                        <?php echo htmlspecialchars($app['status']); ?>
                                    </span>
                                </td>
                                <td style="padding: var(--spacing-sm);"><?php echo htmlspecialchars($app['date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    private function renderVagasList($vagas) {
        ob_start();
        ?>
        <div class="student-header">
            <div>
                <h1>Explorar Vagas</h1>
                <p class="breadcrumb">Encontre o estágio ideal para você</p>
            </div>
        </div>

        <div class="student-content">
            <!-- Filtros -->
            <div class="filters">
                <div class="filter-group">
                    <label><i class="fas fa-search"></i> Buscar</label>
                    <input type="text" placeholder="Cargo, empresa ou palavra-chave...">
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-map-marker-alt"></i> Local</label>
                    <select>
                        <option>Todas as cidades</option>
                        <option>São Paulo - SP</option>
                        <option>Guarulhos - SP</option>
                        <option>Remoto</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-briefcase"></i> Tipo</label>
                    <select>
                        <option>Todos os tipos</option>
                        <option>Remoto</option>
                        <option>Presencial</option>
                        <option>Híbrido</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-dollar-sign"></i> Salário mín.</label>
                    <input type="number" placeholder="Ex: 1000">
                </div>
            </div>

            <p style="color: var(--cinza-medio); margin-bottom: var(--spacing-md);">
                <strong><?php echo count($vagas); ?></strong> vagas encontradas
            </p>

            <!-- Lista de Vagas -->
            <div class="vagas-list">
                <?php foreach ($vagas as $vaga): ?>
                    <div class="vaga-card">
                        <div class="vaga-header">
                            <div class="vaga-title">
                                <h3><?php echo htmlspecialchars($vaga['title']); ?></h3>
                                <p class="vaga-company">
                                    <i class="fas fa-building"></i>
                                    <?php echo htmlspecialchars($vaga['company']); ?>
                                </p>
                            </div>
                            <span class="vaga-badge badge-<?php echo strtolower($vaga['type']); ?>">
                                <?php echo $vaga['type']; ?>
                            </span>
                        </div>

                        <p style="color: var(--cinza-escuro); margin: var(--spacing-sm) 0; font-size: 0.9rem;">
                            <?php echo htmlspecialchars($vaga['description']); ?>
                        </p>

                        <div class="vaga-details">
                            <div class="vaga-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($vaga['location']); ?>
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-clock"></i>
                                <?php echo htmlspecialchars($vaga['hours']); ?>
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-calendar"></i>
                                <?php echo htmlspecialchars($vaga['posted']); ?>
                            </div>
                        </div>

                        <div class="vaga-footer">
                            <span class="vaga-salary"><?php echo htmlspecialchars($vaga['salary']); ?></span>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-apply" style="background: transparent; border: 2px solid var(--amarelo); color: var(--azul);" 
                                        onclick="toggleFavorito(<?php echo $vaga['id']; ?>, this)">
                                    <i class="fas fa-star"></i>
                                </button>
                                <button class="btn-apply" onclick="verDetalhesVaga(<?php echo $vaga['id']; ?>, '<?php echo htmlspecialchars($vaga['title']); ?>', '<?php echo htmlspecialchars($vaga['company']); ?>', '<?php echo $vaga['type']; ?>', '<?php echo htmlspecialchars($vaga['salary']); ?>', '<?php echo htmlspecialchars($vaga['location']); ?>', '<?php echo htmlspecialchars($vaga['hours']); ?>', '<?php echo htmlspecialchars($vaga['description']); ?>')">
                                    <i class="fas fa-eye"></i> Ver Detalhes
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    private function renderApplications($applications) {
        ob_start();
        ?>
        <div class="student-header">
            <div>
                <h1>Minhas Candidaturas</h1>
                <p class="breadcrumb">Acompanhe o status das suas aplicações</p>
            </div>
        </div>

        <div class="student-content">
            <div class="alert-info" style="margin-bottom: var(--spacing-md);">
                <i class="fas fa-info-circle"></i> <strong>Suas candidaturas serão carregadas automaticamente</strong>
            </div>

            <div class="tabs">
                <button class="tab active" onclick="filtrarCandidaturas('todas')">Todas (<span id="count-todas">0</span>)</button>
                <button class="tab" onclick="filtrarCandidaturas('analise')">Em Análise (<span id="count-analise">0</span>)</button>
                <button class="tab" onclick="filtrarCandidaturas('entrevista')">Entrevistas (<span id="count-entrevista">0</span>)</button>
                <button class="tab" onclick="filtrarCandidaturas('rejeitadas')">Rejeitadas (<span id="count-rejeitadas">0</span>)</button>
            </div>

            <div id="candidaturas-container" class="vagas-list" style="margin-top: var(--spacing-lg);">
                <!-- Candidaturas serão carregadas aqui -->
            </div>

            <div id="empty-candidaturas" class="empty-state" style="display: none;">
                <i class="fas fa-inbox"></i>
                <h3>Nenhuma candidatura encontrada</h3>
                <p>Explore as vagas disponíveis e candidate-se!</p>
                <a href="<?php echo url('/aluno/vagas'); ?>" class="btn-apply" style="display: inline-block; margin-top: var(--spacing-md);">
                    Ver Vagas Disponíveis
                </a>
            </div>
        </div>

        <script>
            // Carregar candidaturas do localStorage
            function carregarCandidaturas() {
                const candidaturas = StorageManager.get('candidaturas') || [];
                const container = document.getElementById('candidaturas-container');
                const emptyState = document.getElementById('empty-candidaturas');
                
                if (candidaturas.length === 0) {
                    container.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                }

                container.style.display = 'grid';
                emptyState.style.display = 'none';
                container.innerHTML = '';

                let countAnalise = 0, countEntrevista = 0, countRejeitadas = 0;

                candidaturas.forEach(vagaId => {
                    const candidatura = StorageManager.get('candidatura_' + vagaId);
                    if (!candidatura) return;

                    // Contar por status
                    if (candidatura.status === 'Em análise') countAnalise++;
                    else if (candidatura.status === 'Entrevista agendada') countEntrevista++;
                    else if (candidatura.status === 'Rejeitada') countRejeitadas++;

                    const card = document.createElement('div');
                    card.className = 'vaga-card candidatura-item';
                    card.dataset.status = candidatura.status.toLowerCase().replace(' ', '-');
                    
                    const badgeClass = candidatura.status === 'Entrevista agendada' ? 'badge-hibrido' : 
                                      (candidatura.status === 'Rejeitada' ? 'badge-presencial' : 'badge-remoto');
                    
                    card.innerHTML = `
                        <div class="vaga-header">
                            <div class="vaga-title">
                                <h3>${candidatura.title}</h3>
                                <p class="vaga-company">
                                    <i class="fas fa-building"></i>
                                    ${candidatura.company}
                                </p>
                            </div>
                            <span class="vaga-badge ${badgeClass}">
                                ${candidatura.status}
                            </span>
                        </div>

                        ${candidatura.status === 'Entrevista agendada' ? `
                        <div style="background: #FFF3E0; padding: var(--spacing-sm); border-radius: 6px; margin: var(--spacing-sm) 0;">
                            <strong><i class="fas fa-calendar-check"></i> Entrevista:</strong> Em breve
                        </div>
                        ` : ''}

                        ${candidatura.mensagem ? `
                        <div style="background: var(--cinza-claro); padding: var(--spacing-sm); border-radius: 6px; margin: var(--spacing-sm) 0;">
                            <strong>Sua mensagem:</strong>
                            <p style="margin: 4px 0 0; color: var(--cinza-escuro); font-style: italic;">"${candidatura.mensagem}"</p>
                        </div>
                        ` : ''}

                        <div class="vaga-details">
                            <div class="vaga-detail">
                                <i class="fas fa-dollar-sign"></i>
                                ${candidatura.salary}
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-briefcase"></i>
                                ${candidatura.type}
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-calendar"></i>
                                Candidatura em ${candidatura.date}
                            </div>
                        </div>

                        <div class="vaga-footer">
                            <button class="btn-apply" style="background: #F44336; color: white;" onclick="cancelarCandidatura(${vagaId})">
                                <i class="fas fa-times"></i> Cancelar Candidatura
                            </button>
                        </div>
                    `;
                    
                    container.appendChild(card);
                });

                // Atualizar contadores
                document.getElementById('count-todas').textContent = candidaturas.length;
                document.getElementById('count-analise').textContent = countAnalise;
                document.getElementById('count-entrevista').textContent = countEntrevista;
                document.getElementById('count-rejeitadas').textContent = countRejeitadas;
            }

            // Filtrar candidaturas por status
            function filtrarCandidaturas(filtro) {
                const items = document.querySelectorAll('.candidatura-item');
                
                items.forEach(item => {
                    if (filtro === 'todas') {
                        item.style.display = 'block';
                    } else if (filtro === 'analise') {
                        item.style.display = item.dataset.status === 'em-análise' ? 'block' : 'none';
                    } else if (filtro === 'entrevista') {
                        item.style.display = item.dataset.status === 'entrevista-agendada' ? 'block' : 'none';
                    } else if (filtro === 'rejeitadas') {
                        item.style.display = item.dataset.status === 'rejeitada' ? 'block' : 'none';
                    }
                });
            }

            // Cancelar candidatura
            function cancelarCandidatura(vagaId) {
                if (!confirm('Tem certeza que deseja cancelar esta candidatura?')) {
                    return;
                }

                StorageManager.removeFromSet('candidaturas', vagaId);
                localStorage.removeItem('candidatura_' + vagaId);
                
                showNotification('Candidatura cancelada com sucesso', 'info');
                atualizarEstatisticas();
                
                setTimeout(() => location.reload(), 1000);
            }

            // Carregar ao abrir a página
            window.addEventListener('DOMContentLoaded', carregarCandidaturas);
        </script>
        <?php
        return ob_get_clean();
    }

    private function renderCurriculo($user) {
        ob_start();
        ?>
        <div class="student-header">
            <div>
                <h1>Meu Currículo</h1>
                <p class="breadcrumb">Gerencie suas informações profissionais</p>
            </div>
        </div>

        <div class="student-content">
            <div class="tabs">
                <button class="tab active" onclick="switchTab('dados')">Dados Pessoais</button>
                <button class="tab" onclick="switchTab('experiencia')">Experiência</button>
                <button class="tab" onclick="switchTab('formacao')">Formação</button>
                <button class="tab" onclick="switchTab('habilidades')">Habilidades</button>
                <button class="tab" onclick="switchTab('documentos')">Documentos</button>
            </div>

            <!-- Tab: Dados Pessoais -->
            <div id="dados" class="tab-content" style="margin-top: var(--spacing-lg);">
                <form style="max-width: 700px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
                        <div class="form-group">
                            <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Nome Completo</label>
                            <input type="text" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" 
                                   style="width: 100%; padding: 10px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Email</label>
                            <input type="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" 
                                   style="width: 100%; padding: 10px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Telefone</label>
                            <input type="tel" placeholder="(11) 99999-9999" 
                                   style="width: 100%; padding: 10px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">LinkedIn</label>
                            <input type="url" placeholder="https://linkedin.com/in/seu-perfil" 
                                   style="width: 100%; padding: 10px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Sobre Mim</label>
                            <textarea rows="4" placeholder="Conte um pouco sobre você, suas metas e objetivos profissionais..." 
                                      style="width: 100%; padding: 10px; border: 2px solid var(--cinza-medio); border-radius: 6px;"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-apply" style="margin-top: var(--spacing-md);">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                </form>
            </div>

            <!-- Tab: Experiência -->
            <div id="experiencia" class="tab-content" style="display: none; margin-top: var(--spacing-lg);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md);">
                    <h3 style="color: var(--azul); margin: 0;">Experiências Profissionais</h3>
                    <button class="btn-apply" onclick="openModal('modalExperiencia')">
                        <i class="fas fa-plus"></i> Adicionar Experiência
                    </button>
                </div>

                <div style="border: 2px dashed var(--cinza-medio); padding: var(--spacing-lg); text-align: center; border-radius: 8px; color: var(--cinza-medio);">
                    <i class="fas fa-briefcase" style="font-size: 3rem; opacity: 0.3; margin-bottom: var(--spacing-sm);"></i>
                    <p>Nenhuma experiência adicionada ainda</p>
                    <p style="font-size: 0.9rem;">Adicione suas experiências profissionais para enriquecer seu currículo</p>
                </div>
            </div>

            <!-- Tab: Formação -->
            <div id="formacao" class="tab-content" style="display: none; margin-top: var(--spacing-lg);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md);">
                    <h3 style="color: var(--azul); margin: 0;">Formação Acadêmica</h3>
                    <button class="btn-apply" onclick="openModal('modalFormacao')">
                        <i class="fas fa-plus"></i> Adicionar Formação
                    </button>
                </div>

                <div style="background: var(--cinza-claro); padding: var(--spacing-md); border-radius: 8px; margin-bottom: var(--spacing-md);">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <h4 style="margin: 0 0 4px; color: var(--azul);"><?php echo htmlspecialchars($user['course'] ?? 'Curso não definido'); ?></h4>
                            <p style="margin: 0; color: var(--cinza-medio);">IFSP - Guarulhos</p>
                            <p style="margin: 4px 0 0; color: var(--cinza-medio); font-size: 0.9rem;">2023 - 2026 (Cursando)</p>
                        </div>
                        <button class="btn-apply" style="background: transparent; border: 2px solid var(--cinza-medio); color: var(--azul);">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tab: Habilidades -->
            <div id="habilidades" class="tab-content" style="display: none; margin-top: var(--spacing-lg);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-md);">
                    <h3 style="color: var(--azul); margin: 0;">Habilidades Técnicas</h3>
                    <button class="btn-apply" onclick="openModal('modalHabilidade')">
                        <i class="fas fa-plus"></i> Adicionar Habilidade
                    </button>
                </div>

                <div style="border: 2px dashed var(--cinza-medio); padding: var(--spacing-lg); text-align: center; border-radius: 8px; color: var(--cinza-medio);">
                    <i class="fas fa-code" style="font-size: 3rem; opacity: 0.3; margin-bottom: var(--spacing-sm);"></i>
                    <p>Nenhuma habilidade adicionada ainda</p>
                    <p style="font-size: 0.9rem;">Ex: Python, JavaScript, React, Git, SQL, etc.</p>
                </div>
            </div>

            <!-- Tab: Documentos -->
            <div id="documentos" class="tab-content" style="display: none; margin-top: var(--spacing-lg);">
                <h3 style="color: var(--azul); margin-bottom: var(--spacing-md);">Upload de Documentos</h3>

                <!-- Currículo PDF -->
                <div style="background: var(--cinza-claro); padding: var(--spacing-md); border-radius: 8px; margin-bottom: var(--spacing-md);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="margin: 0 0 4px; color: var(--azul);"><i class="fas fa-file-pdf"></i> Currículo em PDF</h4>
                            <p style="margin: 0; color: var(--cinza-medio); font-size: 0.9rem;">Faça upload do seu currículo em formato PDF</p>
                        </div>
                        <label class="btn-apply" style="cursor: pointer;">
                            <i class="fas fa-upload"></i> Enviar PDF
                            <input type="file" accept=".pdf" style="display: none;">
                        </label>
                    </div>
                </div>

                <!-- Carta de Apresentação -->
                <div style="background: var(--cinza-claro); padding: var(--spacing-md); border-radius: 8px; margin-bottom: var(--spacing-md);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="margin: 0 0 4px; color: var(--azul);"><i class="fas fa-file-alt"></i> Carta de Apresentação</h4>
                            <p style="margin: 0; color: var(--cinza-medio); font-size: 0.9rem;">Adicione uma carta de apresentação personalizada</p>
                        </div>
                        <label class="btn-apply" style="cursor: pointer;">
                            <i class="fas fa-upload"></i> Enviar Carta
                            <input type="file" accept=".pdf,.doc,.docx" style="display: none;">
                        </label>
                    </div>
                </div>

                <!-- Portfólio -->
                <div style="background: var(--cinza-claro); padding: var(--spacing-md); border-radius: 8px;">
                    <h4 style="margin: 0 0 var(--spacing-sm); color: var(--azul);"><i class="fas fa-globe"></i> Link do Portfólio</h4>
                    <input type="url" placeholder="https://seu-portfolio.com" 
                           style="width: 100%; padding: 10px; border: 2px solid var(--cinza-medio); border-radius: 6px; margin-bottom: var(--spacing-sm);">
                    <button class="btn-apply">
                        <i class="fas fa-save"></i> Salvar Link
                    </button>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    private function renderPerfil($user) {
        ob_start();
        ?>
        <div class="student-header">
            <div>
                <h1>Meu Perfil</h1>
                <p class="breadcrumb">Gerencie suas informações de conta</p>
            </div>
        </div>

        <div class="student-content">
            <div style="text-align: center; margin-bottom: var(--spacing-lg);">
                <img src="<?php echo $user['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($user['name'] ?? 'User') . '&size=150&background=F2C400&color=0B194F'; ?>" 
                     alt="Avatar" 
                     style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid var(--amarelo); object-fit: cover;">
                <br>
                <label class="btn-apply" style="display: inline-block; margin-top: var(--spacing-md); cursor: pointer;">
                    <i class="fas fa-camera"></i> Alterar Foto
                    <input type="file" accept="image/*" style="display: none;">
                </label>
            </div>

            <form style="max-width: 600px; margin: 0 auto;">
                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Nome Completo</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" 
                           style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" 
                           style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Matrícula</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['matricula'] ?? ''); ?>" disabled
                           style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px; background: var(--cinza-claro);">
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Curso</label>
                    <select style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                        <option><?php echo htmlspecialchars($user['course'] ?? 'Não definido'); ?></option>
                        <option>Análise e Desenvolvimento de Sistemas</option>
                        <option>Programação para Jogos Digitais</option>
                        <option>Sistemas para Internet</option>
                    </select>
                </div>

                <hr style="margin: var(--spacing-lg) 0; border: none; border-top: 2px solid var(--cinza-claro);">

                <h3 style="color: var(--azul); margin-bottom: var(--spacing-md);">Alterar Senha</h3>

                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Senha Atual</label>
                    <input type="password" placeholder="Digite sua senha atual" 
                           style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Nova Senha</label>
                    <input type="password" placeholder="Digite a nova senha" 
                           style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                </div>

                <div style="margin-bottom: var(--spacing-md);">
                    <label style="font-weight: 600; color: var(--azul); display: block; margin-bottom: 6px;">Confirmar Nova Senha</label>
                    <input type="password" placeholder="Confirme a nova senha" 
                           style="width: 100%; padding: 12px; border: 2px solid var(--cinza-medio); border-radius: 6px;">
                </div>

                <div style="display: flex; gap: var(--spacing-sm);">
                    <button type="submit" class="btn-apply" style="flex: 1;">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                    <button type="button" class="btn-apply" style="flex: 1; background: var(--cinza-medio); color: white;">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }

    private function renderFavoritos($favorites) {
        ob_start();
        ?>
        <div class="student-header">
            <div>
                <h1>Vagas Favoritas</h1>
                <p class="breadcrumb">Vagas que você salvou para depois</p>
            </div>
        </div>

        <div class="student-content">
            <p style="color: var(--cinza-medio); margin-bottom: var(--spacing-md);">
                <strong><span id="count-favoritos">0</span></strong> vagas salvas
            </p>

            <div id="favoritos-container" class="vagas-list">
                <!-- Favoritos serão carregados aqui -->
            </div>

            <div id="empty-favoritos" class="empty-state" style="display: none;">
                <i class="fas fa-star"></i>
                <h3>Nenhuma vaga favorita ainda</h3>
                <p>Ao explorar vagas, clique na estrela para salvá-las aqui!</p>
                <a href="<?php echo url('/aluno/vagas'); ?>" class="btn-apply" style="display: inline-block; margin-top: var(--spacing-md);">
                    Explorar Vagas
                </a>
            </div>
        </div>

        <script>
            // Definir todas as vagas (as mesmas do controller)
            const todasVagasDisponiveis = [
                { id: 1, title: 'Estágio em Desenvolvimento Web', company: 'Tech Solutions Brasil', type: 'Remoto', salary: 'R$ 1.500,00', location: 'São Paulo - SP', hours: '20h/semana', posted: '2 dias atrás', description: 'Buscamos estudante para auxiliar no desenvolvimento de aplicações web modernas.' },
                { id: 2, title: 'Estágio em UX/UI Design', company: 'Creative Digital', type: 'Híbrido', salary: 'R$ 1.200,00', location: 'Guarulhos - SP', hours: '30h/semana', posted: '3 dias atrás', description: 'Oportunidade para aprender design de interfaces e experiência do usuário.' },
                { id: 3, title: 'Estágio em Análise de Dados', company: 'Data Insights', type: 'Presencial', salary: 'R$ 1.800,00', location: 'São Paulo - SP', hours: '30h/semana', posted: '1 semana atrás', description: 'Vaga para quem deseja trabalhar com análise e visualização de dados.' },
                { id: 4, title: 'Desenvolvedor Mobile - Flutter', company: 'AppMakers', type: 'Remoto', salary: 'R$ 2.000,00', location: 'Remoto', hours: '30h/semana', posted: '1 semana atrás', description: 'Desenvolvimento de aplicativos mobile multiplataforma com Flutter.' },
                { id: 5, title: 'Estágio em DevOps', company: 'Cloud Services', type: 'Presencial', salary: 'R$ 1.700,00', location: 'São Paulo - SP', hours: '30h/semana', posted: '2 semanas atrás', description: 'Auxílio em infraestrutura, CI/CD e automação de processos.' },
                { id: 6, title: 'Estágio em Suporte Técnico', company: 'HelpDesk Pro', type: 'Híbrido', salary: 'R$ 1.100,00', location: 'Guarulhos - SP', hours: '20h/semana', posted: '3 semanas atrás', description: 'Atendimento e suporte a usuários, resolução de problemas técnicos.' }
            ];

            // Carregar favoritos do localStorage
            function carregarFavoritos() {
                const favoritos = StorageManager.get('favoritos') || [];
                const candidaturas = StorageManager.get('candidaturas') || [];
                const container = document.getElementById('favoritos-container');
                const emptyState = document.getElementById('empty-favoritos');
                const countElement = document.getElementById('count-favoritos');
                
                countElement.textContent = favoritos.length;

                if (favoritos.length === 0) {
                    container.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                }

                container.style.display = 'grid';
                emptyState.style.display = 'none';
                container.innerHTML = '';

                favoritos.forEach(vagaId => {
                    const vaga = todasVagasDisponiveis.find(v => v.id === vagaId);
                    if (!vaga) return;

                    const jaCandidatou = candidaturas.includes(vagaId);

                    const card = document.createElement('div');
                    card.className = 'vaga-card';
                    
                    card.innerHTML = `
                        <div class="vaga-header">
                            <div class="vaga-title">
                                <h3>${vaga.title}</h3>
                                <p class="vaga-company">
                                    <i class="fas fa-building"></i>
                                    ${vaga.company}
                                </p>
                            </div>
                            <span class="vaga-badge badge-${vaga.type.toLowerCase()}">
                                ${vaga.type}
                            </span>
                        </div>

                        <div class="vaga-details">
                            <div class="vaga-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                ${vaga.location}
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-clock"></i>
                                ${vaga.hours}
                            </div>
                            <div class="vaga-detail">
                                <i class="fas fa-calendar"></i>
                                ${vaga.posted}
                            </div>
                        </div>

                        <div class="vaga-footer">
                            <span class="vaga-salary">${vaga.salary}</span>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-apply" style="background: #F44336; border: none; color: white;" 
                                        onclick="removerFavorito(${vaga.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                ${jaCandidatou ? 
                                    '<button class="btn-applied" disabled style="cursor: not-allowed;"><i class="fas fa-check-circle"></i> Candidatado</button>' :
                                    `<button class="btn-apply" onclick="verDetalhesVaga(${vaga.id}, '${vaga.title}', '${vaga.company}', '${vaga.type}', '${vaga.salary}', '${vaga.location}', '${vaga.hours}', '${vaga.description}')"><i class="fas fa-paper-plane"></i> Candidatar</button>`
                                }
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(card);
                });
            }

            // Carregar ao abrir a página
            window.addEventListener('DOMContentLoaded', carregarFavoritos);
        </script>
        <?php
        return ob_get_clean();
    }
}
?>
