<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'ESTAGIA+'; ?></title>
    
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/auth.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>ESTAGIA<span style="color: var(--amarelo);">+</span></h1>
                <p class="subtitle">Plataforma de Estágios do IFSP Guarulhos</p>
            </div>

            <div class="auth-body">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error']); ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success']); ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if ($page === 'login'): ?>
                    <h2 style="color: var(--branco); margin-bottom: var(--spacing-lg);">Entrar</h2>

                    <form method="POST" action="<?php echo url('/login'); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                        <div class="form-group">
                            <label for="email">Email ou Matrícula</label>
                            <div class="input-group">
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="seu.email@ifsp.edu.br"
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                    required
                                >
                                <i class="fas fa-envelope input-icon"></i>
                            </div>
                            <?php if (isset($_SESSION['errors']['email'])): ?>
                                <span class="error-message"><?php echo $_SESSION['errors']['email']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <div class="input-group">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Sua senha"
                                    required
                                >
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <?php if (isset($_SESSION['errors']['password'])): ?>
                                <span class="error-message"><?php echo $_SESSION['errors']['password']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Lembrar-me neste computador</label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </button>
                    </form>

                <?php elseif ($page === 'register'): ?>
                    <h2 style="color: var(--azul); margin-bottom: var(--spacing-lg);">Criar Conta</h2>

                    <form method="POST" action="<?php echo url('/registro'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                        <div class="form-group">
                            <label for="name">Nome Completo</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                placeholder="Seu nome completo"
                                value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                required
                            >
                            <?php if (isset($_SESSION['errors']['name'])): ?>
                                <span class="error-message"><?php echo $_SESSION['errors']['name']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Institucional</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="seu.email@ifsp.edu.br"
                                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                required
                            >
                            <?php if (isset($_SESSION['errors']['email'])): ?>
                                <span class="error-message"><?php echo $_SESSION['errors']['email']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="matricula">Matrícula</label>
                            <input 
                                type="text" 
                                id="matricula" 
                                name="matricula" 
                                placeholder="Sua matrícula"
                                value="<?php echo htmlspecialchars($_POST['matricula'] ?? ''); ?>"
                                required
                            >
                            <?php if (isset($_SESSION['errors']['matricula'])): ?>
                                <span class="error-message"><?php echo $_SESSION['errors']['matricula']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="course">Curso</label>
                            <select id="course" name="course">
                                <option value="">Selecione seu curso</option>
                                <option value="Análise e Desenvolvimento de Sistemas" <?php echo ($_POST['course'] ?? '') === 'Análise e Desenvolvimento de Sistemas' ? 'selected' : ''; ?>>Análise e Desenvolvimento de Sistemas</option>
                                <option value="Programação para Jogos Digitais" <?php echo ($_POST['course'] ?? '') === 'Programação para Jogos Digitais' ? 'selected' : ''; ?>>Programação para Jogos Digitais</option>
                                <option value="Sistemas para Internet" <?php echo ($_POST['course'] ?? '') === 'Sistemas para Internet' ? 'selected' : ''; ?>>Sistemas para Internet</option>
                                <option value="Outro" <?php echo ($_POST['course'] ?? '') === 'Outro' ? 'selected' : ''; ?>>Outro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <div class="input-group">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Mínimo 8 caracteres"
                                    required
                                    oninput="checkPasswordStrength(this.value)"
                                >
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="strength-meter">
                                <div id="strengthFill" class="strength-meter-fill"></div>
                            </div>
                            <small style="color: var(--cinza-medio);">
                                Deve conter: 8+ caracteres, letra maiúscula e número
                            </small>
                            <?php if (isset($_SESSION['errors']['password'])): ?>
                                <span class="error-message"><?php echo $_SESSION['errors']['password']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Confirmar Senha</label>
                            <div class="input-group">
                                <input 
                                    type="password" 
                                    id="password_confirm" 
                                    name="password_confirm" 
                                    placeholder="Repita a senha"
                                    required
                                >
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirm')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Foto de Perfil (Opcional)</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="avatar" name="avatar" accept="image/*">
                                <label for="avatar" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i><br>
                                    Clique para selecionar ou arraste uma imagem
                                </label>
                            </div>
                            <small style="color: var(--cinza-medio); display: block; margin-top: 6px;">
                                Formatos: JPG, PNG, GIF (máx. 5MB)
                            </small>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="lgpd" name="lgpd" required>
                            <label for="lgpd">
                                Aceito os <a href="/termos" target="_blank">Termos de Serviço</a> e a <a href="/privacidade" target="_blank">Política de Privacidade (LGPD)</a>
                            </label>
                        </div>
                        <?php if (isset($_SESSION['errors']['lgpd'])): ?>
                            <span class="error-message" style="display: block; margin-top: -12px; margin-bottom: 12px;"><?php echo $_SESSION['errors']['lgpd']; ?></span>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Criar Conta
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="auth-footer">
                <?php if ($page === 'login'): ?>
                    Não tem conta? <a href="<?php echo url('/registro'); ?>">Registre-se aqui</a><br>
                    <small style="margin-top: 8px; display: block;"><a href="<?php echo url('/'); ?>">Voltar ao início</a></small>
                <?php else: ?>
                    Já tem conta? <a href="<?php echo url('/login'); ?>">Entre aqui</a><br>
                    <small style="margin-top: 8px; display: block;"><a href="<?php echo url('/'); ?>">Voltar ao início</a></small>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = event.target.closest('.password-toggle');
            if (field.type === 'password') {
                field.type = 'text';
                button.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                field.type = 'password';
                button.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }

        function checkPasswordStrength(password) {
            const fill = document.getElementById('strengthFill');
            let strength = 0;

            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            fill.className = 'strength-meter-fill';
            if (strength <= 1) {
                fill.classList.add('strength-weak');
            } else if (strength <= 2) {
                fill.classList.add('strength-medium');
            } else {
                fill.classList.add('strength-strong');
            }
        }

        // Limpar mensagens de sessão depois de exibir
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            });
        }, 100);
    </script>
</body>
</html>
