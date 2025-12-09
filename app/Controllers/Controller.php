<?php
namespace App\Controllers;

/**
 * Controller Base
 * Classe parent para todos os controllers
 */
class Controller {
    protected $view_data = [];

    /**
     * Renderizar view
     */
    public function render($view_name, $data = []) {
        $this->view_data = array_merge($this->view_data, $data);
        $view_path = RESOURCES_PATH . '/views/' . $view_name . '.php';
        
        if (!file_exists($view_path)) {
            http_response_code(500);
            die("View não encontrada: {$view_path}");
        }

        extract($this->view_data);
        ob_start();
        include $view_path;
        return ob_get_clean();
    }


    public function redirect($url) {
        if (strpos($url, '/') === 0 && defined('BASE_URL')) {
            $url = BASE_URL . $url;
        }
        header("Location: {$url}");
        exit;
    }


    protected function url($path = '') {
        return BASE_URL . '/' . ltrim($path, '/');
    }

    protected function asset($path) {
        return BASE_URL . '/public/' . ltrim($path, '/');
    }

    public function json($data, $status_code = 200) {
        header('Content-Type: application/json');
        http_response_code($status_code);
        echo json_encode($data);
        exit;
    }

    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    protected function getAuthUser() {
        if ($this->isAuthenticated()) {
            return $_SESSION['user'] ?? null;
        }
        return null;
    }
    protected function isAdmin() {
        return $this->isAuthenticated() && ($_SESSION['user']['role'] ?? null) === 'admin';
    }

    protected function validateCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && 
               hash_equals($_SESSION['csrf_token'], $token);
    }

    protected function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function validate($data, $rules) {
        $errors = [];

        foreach ($rules as $field => $rule) {
            if (isset($data[$field])) {
                $value = $data[$field];
                
                if (strpos($rule, 'required') !== false && empty($value)) {
                    $errors[$field] = "Este campo é obrigatório.";
                }
                
                if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "Insira um email válido.";
                }
                
                if (strpos($rule, 'min:') !== false) {
                    preg_match('/min:(\d+)/', $rule, $matches);
                    $min = $matches[1];
                    if (strlen($value) < $min) {
                        $errors[$field] = "Este campo deve ter no mínimo {$min} caracteres.";
                    }
                }
                
                if (strpos($rule, 'max:') !== false) {
                    preg_match('/max:(\d+)/', $rule, $matches);
                    $max = $matches[1];
                    if (strlen($value) > $max) {
                        $errors[$field] = "Este campo deve ter no máximo {$max} caracteres.";
                    }
                }
            } elseif (strpos($rule, 'required') !== false) {
                $errors[$field] = "Este campo é obrigatório.";
            }
        }

        return $errors;
    }

    protected function sanitize($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
?>
