<?php
namespace App\Controllers;

require_once BASE_PATH . '/app/Models/User.php';

/**
 * AdminController - Gerencia dashboard admin
 */
class AdminController extends Controller {
    
    public function __construct() {
        // Verificar se é admin
        if (!$this->isAdmin()) {
            http_response_code(403);
            die('Acesso negado. Você deve ser administrador.');
        }
    }

    public function dashboard() {
        $csrf_token = $this->generateCsrfToken();
        
        // Dados de exemplo para o dashboard
        $stats = [
            'total_users' => 45,
            'total_vagas' => 23,
            'paid_internships' => 12,
            'active_internships' => 8,
            'pending_approvals' => 5,
            'this_month_registrations' => 7
        ];

        $recent_users = [
            ['id' => 1, 'name' => 'João Silva', 'email' => 'joao@ifsp.edu.br', 'created_at' => '2024-12-07'],
            ['id' => 2, 'name' => 'Maria Santos', 'email' => 'maria@ifsp.edu.br', 'created_at' => '2024-12-06'],
            ['id' => 3, 'name' => 'Pedro Costa', 'email' => 'pedro@ifsp.edu.br', 'created_at' => '2024-12-05']
        ];

        $recent_vagas = [
            ['id' => 1, 'title' => 'Estágio em Programação', 'company' => 'Tech Solutions', 'status' => 'active'],
            ['id' => 2, 'title' => 'Estágio em UX Design', 'company' => 'Creative Hub', 'status' => 'active'],
            ['id' => 3, 'title' => 'Estágio em DevOps', 'company' => 'Cloud Services', 'status' => 'pending']
        ];

        echo $this->render('layouts/admin', [
            'csrf_token' => $csrf_token,
            'title' => 'Dashboard Admin - ESTAGIA+',
            'page' => 'dashboard',
            'stats' => $stats,
            'recent_users' => $recent_users,
            'recent_vagas' => $recent_vagas
        ]);
    }

    public function users() {
        $csrf_token = $this->generateCsrfToken();

        // Simular lista de usuários
        $users = [
            ['id' => 1, 'name' => 'João Silva', 'email' => 'joao@ifsp.edu.br', 'role' => 'student', 'created_at' => '2024-12-07'],
            ['id' => 2, 'name' => 'Maria Santos', 'email' => 'maria@ifsp.edu.br', 'role' => 'student', 'created_at' => '2024-12-06'],
            ['id' => 3, 'name' => 'Prof. Carlos', 'email' => 'carlos@ifsp.edu.br', 'role' => 'teacher', 'created_at' => '2024-12-01'],
            ['id' => 4, 'name' => 'Empresa XYZ', 'email' => 'contato@empresa.com', 'role' => 'company', 'created_at' => '2024-11-15']
        ];

        echo $this->render('layouts/admin', [
            'csrf_token' => $csrf_token,
            'title' => 'Usuários - Dashboard Admin',
            'page' => 'users',
            'users' => $users
        ]);
    }

    public function vagas() {
        $csrf_token = $this->generateCsrfToken();

        // Simular lista de vagas
        $vagas = [
            ['id' => 1, 'title' => 'Estágio em Programação', 'company' => 'Tech Solutions', 'status' => 'active', 'created_at' => '2024-12-05'],
            ['id' => 2, 'title' => 'Estágio em UX Design', 'company' => 'Creative Hub', 'status' => 'active', 'created_at' => '2024-12-03'],
            ['id' => 3, 'title' => 'Estágio em DevOps', 'company' => 'Cloud Services', 'status' => 'pending', 'created_at' => '2024-12-01']
        ];

        echo $this->render('layouts/admin', [
            'csrf_token' => $csrf_token,
            'title' => 'Vagas - Dashboard Admin',
            'page' => 'vagas',
            'vagas' => $vagas
        ]);
    }

    public function settings() {
        $csrf_token = $this->generateCsrfToken();

        // Configurações padrão
        $settings = [
            'site_name' => 'ESTAGIA+',
            'site_email' => 'contato@estagiamais.ifsp.edu.br',
            'primary_color' => '#0B194F',
            'secondary_color' => '#F2C400',
            'allow_registrations' => true,
            'require_email_verification' => true,
            'maintenance_mode' => false
        ];

        echo $this->render('layouts/admin', [
            'csrf_token' => $csrf_token,
            'title' => 'Configurações - Dashboard Admin',
            'page' => 'settings',
            'settings' => $settings
        ]);
    }
}
?>
