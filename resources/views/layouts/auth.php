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
            background: linear-gradient(135deg, var(--azul) 0%, #0D2158 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-md);
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
        }

        .auth-card {
            background: var(--branco);
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--azul), #0D2158);
            color: var(--branco);
            padding: var(--spacing-lg);
            text-align: center;
        }

        .auth-header h1 {
            color: var(--branco);
            font-size: 2rem;
            margin-bottom: 0;
        }

        .auth-header .subtitle {
            color: var(--cinza-claro);
            font-size: 0.95rem;
            margin-top: var(--spacing-sm);
        }

        .auth-body {
            padding: var(--spacing-lg);
        }

        .form-group {
            margin-bottom: var(--spacing-md);
        }

        .form-group label {
            font-weight: 600;
            color: var(--azul);
            display: block;
            margin-bottom: var(--spacing-xs);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid var(--cinza-medio);
            border-radius: 6px;
            font-size: 1rem;
            font-family: inherit;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--azul);
            box-shadow: 0 0 0 3px rgba(11, 25, 79, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-check {
            display: flex;
            align-items: flex-start;
            margin-bottom: var(--spacing-md);
        }

        .form-check input[type="checkbox"] {
            width: auto;
            margin-right: var(--spacing-sm);
            margin-top: 4px;
            cursor: pointer;
        }

        .form-check label {
            margin: 0;
            font-weight: 400;
            font-size: 0.9rem;
            color: var(--cinza-escuro);
            cursor: pointer;
        }

        .form-check a {
            color: var(--azul);
            text-decoration: underline;
        }

        .error-message {
            color: var(--erro);
            font-size: 0.85rem;
            margin-top: 4px;
            display: block;
        }

        .alert {
            padding: var(--spacing-md);
            border-radius: 6px;
            margin-bottom: var(--spacing-md);
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #F1F8E9;
            border-left-color: var(--sucesso);
            color: #558B2F;
        }

        .alert-error {
            background-color: #FFEBEE;
            border-left-color: var(--erro);
            color: #C62828;
        }

        .btn {
            width: 100%;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--amarelo);
            color: var(--azul);
        }

        .btn-primary:hover {
            background-color: #E0B200;
            box-shadow: 0 10px 20px rgba(242, 196, 0, 0.3);
        }

        .btn-primary:active {
            transform: translateY(2px);
        }

        .auth-footer {
            padding: var(--spacing-md) var(--spacing-lg);
            background: var(--cinza-claro);
            text-align: center;
            border-top: 1px solid var(--cinza-medio);
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: var(--azul);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: var(--spacing-lg) 0;
            position: relative;
            color: var(--cinza-medio);
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--cinza-medio);
        }

        .divider span {
            background: var(--branco);
            padding: 0 var(--spacing-sm);
            position: relative;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--cinza-medio);
        }

        .input-group input {
            padding-right: 40px;
        }

        .password-toggle {
            cursor: pointer;
            background: none;
            border: none;
            color: var(--azul);
            position: absolute;
            right: 12px;
            top: 38px;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 12px 14px;
            background-color: var(--cinza-claro);
            border: 2px dashed var(--cinza-medio);
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: var(--transition);
        }

        .file-input-label:hover {
            background-color: var(--azul-claro);
            border-color: var(--azul);
        }

        .strength-meter {
            height: 4px;
            background: var(--cinza-medio);
            border-radius: 2px;
            margin-top: 6px;
            overflow: hidden;
        }

        .strength-meter-fill {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .strength-weak { background-color: var(--erro); width: 33%; }
        .strength-medium { background-color: var(--aviso); width: 66%; }
        .strength-strong { background-color: var(--sucesso); width: 100%; }

        @media (max-width: 480px) {
            .auth-body {
                padding: var(--spacing-md);
            }

            .auth-header h1 {
                font-size: 1.5rem;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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
