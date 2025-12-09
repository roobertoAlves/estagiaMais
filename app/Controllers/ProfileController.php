<?php
namespace App\Controllers;

/**
 * ProfileController - Gerencia perfil do usuário
 */
class ProfileController extends Controller {
    
    public function index() {
        // Verificar autenticação
        if (!$this->isAuthenticated()) {
            $this->redirect('/estagiaMais/login');
        }

        $user = $this->getAuthUser();
        $csrf_token = $this->generateCsrfToken();

        echo $this->render('layouts/app', [
            'csrf_token' => $csrf_token,
            'title' => 'Meu Perfil - ESTAGIA+',
            'page' => 'profile',
            'user' => $user
        ]);
    }
}
?>
