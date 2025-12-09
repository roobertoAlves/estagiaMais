<?php
namespace App\Controllers;

require_once BASE_PATH . '/app/Models/User.php';


class AuthController extends Controller {
    
    public function loginForm() {
        $csrf_token = $this->generateCsrfToken();
        
        echo $this->render('layouts/auth', [
            'csrf_token' => $csrf_token,
            'title' => 'Login - ESTAGIA+',
            'page' => 'login'
        ]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(url('/login'));
        }

        // Validar CSRF
        $csrf = $_POST['csrf_token'] ?? '';
        if (!$this->validateCsrfToken($csrf)) {
            $_SESSION['error'] = 'Sessão expirada. Tente novamente.';
            $this->redirect(url('/login'));
        }

        // Validar entrada
        $email = $this->sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = $this->validate(
            ['email' => $email, 'password' => $password],
            ['email' => 'required|email', 'password' => 'required']
        );

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->redirect(url('/login'));
        }

        // Login admin pré-definido (bypass de banco)
        if (strcasecmp($email, 'admin@admin.com') === 0 && $password === 'admin123') {
            $_SESSION['user_id'] = 0;
            $_SESSION['user'] = [
                'id' => 0,
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'role' => 'admin'
            ];

            $_SESSION['success'] = 'Bem-vindo, administrador!';
            $this->redirect(url('/admin/dashboard'));
        }

        // Buscar usuário no banco (senha sem hash conforme solicitação)
        $user_model = new \App\Models\User();
        $user = $user_model->findByEmail($email);

        if (!$user || $password !== $user['password']) {
            $_SESSION['error'] = 'Email ou senha incorretos.';
            $this->redirect(url('/login'));
        }

        // Criar sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        // Lembrar-me (cookie seguro)
        if (isset($_POST['remember'])) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (86400 * 30), '/', '', true, true);
            // Salvar token no banco
            $user_model->updateRememberToken($user['id'], $token);
        }

        $_SESSION['success'] = 'Bem-vindo de volta!';

        if (($user['role'] ?? '') === 'admin') {
            $this->redirect(url('/admin/dashboard'));
        }

        // Redirecionar estudantes para o painel do aluno
        $this->redirect(url('/aluno/dashboard'));
    }

    public function registerForm() {
        $csrf_token = $this->generateCsrfToken();
        
        echo $this->render('layouts/auth', [
            'csrf_token' => $csrf_token,
            'title' => 'Registro - ESTAGIA+',
            'page' => 'register'
        ]);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(url('/registro'));
        }

        // Validar CSRF
        $csrf = $_POST['csrf_token'] ?? '';
        if (!$this->validateCsrfToken($csrf)) {
            $_SESSION['error'] = 'Sessão expirada. Tente novamente.';
            $this->redirect(url('/registro'));
        }

        // Validar entrada
        $name = $this->sanitize($_POST['name'] ?? '');
        $email = $this->sanitize($_POST['email'] ?? '');
        $matricula = $this->sanitize($_POST['matricula'] ?? '');
        $course = $this->sanitize($_POST['course'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';
        $lgpd = isset($_POST['lgpd']) && $_POST['lgpd'] === 'on';

        $errors = $this->validate(
            [
                'name' => $name,
                'email' => $email,
                'matricula' => $matricula,
                'password' => $password,
                'password_confirm' => $password_confirm
            ],
            [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email',
                'matricula' => 'required|min:5|max:50',
                'password' => 'required|min:8|max:255',
                'password_confirm' => 'required'
            ]
        );

        if (!$lgpd) {
            $errors['lgpd'] = 'Você deve aceitar os termos LGPD.';
        }

        if ($password !== $password_confirm) {
            $errors['password'] = 'As senhas não correspondem.';
        }

        // Validar segurança da senha
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
            $errors['password'] = 'Senha deve ter 8+ caracteres, letra maiúscula e número.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->redirect(url('/registro'));
        }

        // Verificar se email já existe
        $user_model = new \App\Models\User();
        if ($user_model->findByEmail($email)) {
            $_SESSION['error'] = 'Este email já está registrado.';
            $this->redirect(url('/registro'));
        }

        // Processar avatar se enviado
        $avatar = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatar = $this->uploadAvatar($_FILES['avatar']);
        }

        // Criar novo usuário (armazenando senha em texto simples conforme solicitado)
        $new_user = [
            'name' => $name,
            'email' => $email,
            'matricula' => $matricula,
            'course' => $course,
            'password' => $password,
            'avatar' => $avatar,
            'lgpd_accepted' => true,
            'role' => 'student'
        ];

        if ($user_model->create($new_user)) {
            $_SESSION['success'] = 'Cadastro realizado com sucesso! Faça login.';
            $this->redirect(url('/login'));
        } else {
            $_SESSION['error'] = 'Erro ao criar conta. Tente novamente.';
            $this->redirect(url('/registro'));
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect(url('/'));
    }

    /**
     * Fazer upload de avatar
     */
    private function uploadAvatar($file) {
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowed)) {
            return null;
        }

        if ($file['size'] > $max_size) {
            return null;
        }

        $upload_dir = PUBLIC_PATH . '/avatars/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $filename = bin2hex(random_bytes(16)) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $filepath = $upload_dir . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return '/avatars/' . $filename;
        }

        return null;
    }
}
?>
