<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'ESTAGIA+ Admin'; ?></title>
    
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/admin.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-chart-line"></i>
                <span>Admin</span>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="<?php echo url('/admin/dashboard'); ?>" class="<?php echo ($page === 'dashboard' ? 'active' : ''); ?>">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/admin/users'); ?>" class="<?php echo ($page === 'users' ? 'active' : ''); ?>">
                        <i class="fas fa-users"></i>
                        <span>Usuários</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/admin/vagas'); ?>" class="<?php echo ($page === 'vagas' ? 'active' : ''); ?>">
                        <i class="fas fa-briefcase"></i>
                        <span>Vagas</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/admin/settings'); ?>" class="<?php echo ($page === 'settings' ? 'active' : ''); ?>">
                        <i class="fas fa-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
                <li style="margin-top: var(--spacing-lg);">
                    <a href="<?php echo url('/'); ?>">
                        <i class="fas fa-arrow-left"></i>
                        <span>Voltar</span>
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
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <h1><?php echo $title; ?></h1>
                <div class="admin-user-info">
                    <div class="admin-user-avatar">
                        <?php echo strtoupper(substr($user['name'] ?? 'A', 0, 1)); ?>
                    </div>
                    <div>
                        <strong><?php echo htmlspecialchars($user['name'] ?? 'Administrador'); ?></strong><br>
                        <small style="color: var(--cinza-medio);"><?php echo htmlspecialchars($user['email'] ?? 'admin@ifsp.edu.br'); ?></small>
                    </div>
                </div>
            </header>

            <!-- Conteúdo da página -->
            <?php if ($page === 'dashboard'): ?>
                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Total de Usuários</h3>
                            <p class="stat-value"><?php echo $stats['total_users']; ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon secondary">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Vagas Publicadas</h3>
                            <p class="stat-value"><?php echo $stats['total_vagas']; ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Estágios Ativos</h3>
                            <p class="stat-value"><?php echo $stats['active_internships']; ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Pendentes de Aprovação</h3>
                            <p class="stat-value"><?php echo $stats['pending_approvals']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Usuários Recentes -->
                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-user-plus"></i> Novos Usuários</h3>
                        <a href="<?php echo url('/admin/users'); ?>" class="btn btn-primary" style="padding: 8px 16px; font-size: 0.9rem;">
                            Ver Todos
                        </a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data de Cadastro</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_users as $user): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($user['name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.85rem;">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Vagas Recentes -->
                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-list"></i> Vagas Recentes</h3>
                        <a href="<?php echo url('/admin/vagas'); ?>" class="btn btn-primary" style="padding: 8px 16px; font-size: 0.9rem;">
                            Ver Todas
                        </a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Empresa</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_vagas as $vaga): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($vaga['title']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($vaga['company']); ?></td>
                                    <td>
                                        <span class="badge <?php echo $vaga['status'] === 'active' ? 'badge-success' : 'badge-pending'; ?>">
                                            <?php echo $vaga['status'] === 'active' ? 'Ativa' : 'Pendente'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.85rem;">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php elseif ($page === 'users'): ?>
                <div class="table-container">
                    <div class="table-header">
                        <h3>Gerenciar Usuários</h3>
                        <input type="text" id="userSearch" placeholder="Pesquisar usuário..." style="padding: 8px 12px; border: 1px solid var(--cinza-medio); border-radius: 6px; width: 250px;">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Data de Cadastro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($u['name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                                    <td>
                                        <span class="badge" style="background: var(--azul-claro); color: var(--azul);">
                                            <?php 
                                            $role_labels = [
                                                'student' => 'Aluno',
                                                'teacher' => 'Professor',
                                                'admin' => 'Admin',
                                                'company' => 'Empresa'
                                            ];
                                            echo $role_labels[$u['role']] ?? $u['role'];
                                            ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($u['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-outline" style="padding: 4px 8px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline" style="padding: 4px 8px; font-size: 0.8rem;">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php elseif ($page === 'vagas'): ?>
                <div class="table-container">
                    <div class="table-header">
                        <h3>Gerenciar Vagas</h3>
                        <button class="btn btn-primary" onclick="openNewVagaModal()" style="padding: 8px 16px; font-size: 0.9rem;">
                            <i class="fas fa-plus"></i> Nova Vaga
                        </button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Empresa</th>
                                <th>Status</th>
                                <th>Criada em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vagas as $vaga): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($vaga['title']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($vaga['company']); ?></td>
                                    <td>
                                        <span class="badge <?php echo $vaga['status'] === 'active' ? 'badge-success' : ($vaga['status'] === 'pending' ? 'badge-pending' : 'badge-inactive'); ?>">
                                            <?php 
                                            $status_labels = ['active' => 'Ativa', 'pending' => 'Pendente', 'closed' => 'Encerrada'];
                                            echo $status_labels[$vaga['status']] ?? $vaga['status'];
                                            ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($vaga['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-outline" style="padding: 4px 8px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline" style="padding: 4px 8px; font-size: 0.8rem;">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php elseif ($page === 'settings'): ?>
                <div style="background: var(--branco); padding: var(--spacing-lg); border-radius: 8px; box-shadow: var(--shadow-sm);">
                    <h2 style="color: var(--azul); margin-bottom: var(--spacing-lg);">Configurações do Sistema</h2>

                    <form class="settings-form" onsubmit="saveSettings(event)">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--spacing-lg);">
                            <!-- Informações básicas -->
                            <div>
                                <label for="site_name">Nome do Site</label>
                                <input type="text" id="site_name" value="<?php echo htmlspecialchars($settings['site_name']); ?>" required>
                            </div>

                            <div>
                                <label for="site_email">Email de Contato</label>
                                <input type="email" id="site_email" value="<?php echo htmlspecialchars($settings['site_email']); ?>" required>
                            </div>
                        </div>

                        <!-- Paleta de Cores -->
                        <div style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 2px solid var(--cinza-claro);">
                            <h3 style="color: var(--azul); margin-bottom: var(--spacing-lg);">
                                <i class="fas fa-palette"></i> Paleta de Cores
                            </h3>

                            <div class="color-picker">
                                <div class="color-input-group">
                                    <label for="primary_color">Cor Primária:</label>
                                    <input type="color" id="primary_color" value="<?php echo $settings['primary_color']; ?>" onchange="updateColorPreview()">
                                    <input type="text" id="primary_color_hex" value="<?php echo $settings['primary_color']; ?>" readonly style="width: 120px;">
                                    <div class="color-circle" id="primary_circle" style="background: <?php echo $settings['primary_color']; ?>;"></div>
                                </div>

                                <div class="color-input-group">
                                    <label for="secondary_color">Cor Secundária:</label>
                                    <input type="color" id="secondary_color" value="<?php echo $settings['secondary_color']; ?>" onchange="updateColorPreview()">
                                    <input type="text" id="secondary_color_hex" value="<?php echo $settings['secondary_color']; ?>" readonly style="width: 120px;">
                                    <div class="color-circle" id="secondary_circle" style="background: <?php echo $settings['secondary_color']; ?>;"></div>
                                </div>
                            </div>

                            <div style="margin-top: var(--spacing-lg); padding: var(--spacing-lg); background: var(--cinza-claro); border-radius: 8px;">
                                <h4>Prévia</h4>
                                <button type="button" class="btn btn-primary" id="preview_primary" style="margin-right: var(--spacing-md);">Botão Primário</button>
                                <button type="button" class="btn btn-secondary" id="preview_secondary">Botão Secundário</button>
                            </div>
                        </div>

                        <!-- Configurações de Acesso -->
                        <div style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 2px solid var(--cinza-claro);">
                            <h3 style="color: var(--azul); margin-bottom: var(--spacing-lg);">
                                <i class="fas fa-lock"></i> Configurações de Acesso
                            </h3>

                            <div class="form-check">
                                <input type="checkbox" id="allow_registrations" <?php echo $settings['allow_registrations'] ? 'checked' : ''; ?>>
                                <label for="allow_registrations">Permitir novos registros</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="require_email_verification" <?php echo $settings['require_email_verification'] ? 'checked' : ''; ?>>
                                <label for="require_email_verification">Exigir verificação de email</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="maintenance_mode" <?php echo $settings['maintenance_mode'] ? 'checked' : ''; ?>>
                                <label for="maintenance_mode">Modo de manutenção</label>
                            </div>
                        </div>

                        <div style="margin-top: var(--spacing-lg); display: flex; gap: var(--spacing-md);">
                            <button type="submit" class="btn btn-primary" style="width: auto; padding: 12px 24px;">
                                <i class="fas fa-save"></i> Salvar Configurações
                            </button>
                            <button type="reset" class="btn btn-outline" style="width: auto; padding: 12px 24px;">
                                <i class="fas fa-redo"></i> Descartar
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        function updateColorPreview() {
            const primary = document.getElementById('primary_color').value;
            const secondary = document.getElementById('secondary_color').value;

            document.getElementById('primary_color_hex').value = primary;
            document.getElementById('secondary_color_hex').value = secondary;
            document.getElementById('primary_circle').style.background = primary;
            document.getElementById('secondary_circle').style.background = secondary;

            document.getElementById('preview_primary').style.backgroundColor = primary;
            document.getElementById('preview_secondary').style.backgroundColor = secondary;
        }

        function saveSettings(event) {
            event.preventDefault();
            alert('Configurações salvas com sucesso! (Simulado)');
        }

        function openNewVagaModal() {
            alert('Modal de nova vaga em desenvolvimento!');
        }

        // Filtro de pesquisa
        document.getElementById('userSearch')?.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
