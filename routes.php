<?php
/**
 * ESTAGIA+ - Roteamento
 * Define rotas da aplicação
 */

$request_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// --- BLOCO CORRIGIDO: Limpeza Universal da URI ---

// Tenta obter a BASE_URL definida em index.php (que deve ser '' ou '/subdiretorio')
$base_url = defined('BASE_URL') ? BASE_URL : dirname($_SERVER['SCRIPT_NAME']);
$base_url = rtrim($base_url, '/'); // Garante que a base não termine em barra

// 1. Remove a BASE_URL do início da URI, se estiver presente (funciona para subdiretórios e root)
if (!empty($base_url) && $base_url !== '/' && strpos($request_uri, $base_url) === 0) {
    $request_uri = substr($request_uri, strlen($base_url));
}

// 2. Remove qualquer ocorrência de /index.php, /index.php/ ou barra final
$request_uri = str_replace('/index.php', '', $request_uri); 
$request_uri = rtrim($request_uri, '/') ?: '/';

// 3. Garante que a URI limpa comece com uma única barra (e.g., /login)
$request_uri = '/' . ltrim($request_uri, '/');

// --- FIM DO BLOCO CORRIGIDO ---


// Array de rotas (mantido inalterado, pois as rotas estavam corretas)
$routes = [
    // Métodos GET
    'GET' => [
        '/' => 'PagesController@home',
        // '/index.php' foi removido das rotas pois agora é tratado na limpeza da URI
        '/sobre' => 'PagesController@about',
        '/login' => 'AuthController@loginForm',
        '/registro' => 'AuthController@registerForm',
        '/perfil' => 'ProfileController@index',
        '/logout' => 'AuthController@logout',
        '/admin/dashboard' => 'AdminController@dashboard',
        '/admin/users' => 'AdminController@users',
        '/admin/vagas' => 'AdminController@vagas',
        '/admin/settings' => 'AdminController@settings',
        '/aluno/dashboard' => 'StudentController@dashboard',
        '/aluno/vagas' => 'StudentController@vagas',
        '/aluno/candidaturas' => 'StudentController@candidaturas',
        '/aluno/curriculo' => 'StudentController@curriculo',
        '/aluno/perfil' => 'StudentController@perfil',
        '/aluno/favoritos' => 'StudentController@favoritos',
    ],
    
    // Métodos POST
    'POST' => [
        '/login' => 'AuthController@login',
        '/registro' => 'AuthController@register',
        '/logout' => 'AuthController@logout',
    ],
];

// Encontrar a rota correspondente
$route_found = false;

if (isset($routes[$request_method])) {
    foreach ($routes[$request_method] as $route => $handler) {
        // A comparação agora deve ser exata graças à limpeza universal
        if ($route === $request_uri) {
            $route_found = true;
            list($controller, $method) = explode('@', $handler);
            
            // Carregar controller
            $controller_class = 'App\\Controllers\\' . $controller;
            if (class_exists($controller_class)) {
                $controller_instance = new $controller_class();
                if (method_exists($controller_instance, $method)) {
                    $controller_instance->$method();
                    exit;
                }
            }
        }
    }
}

// Se nenhuma rota foi encontrada
if (!$route_found) {
    http_response_code(404);
    // Presumindo que RESOURCES_PATH foi definido em index.php
    include RESOURCES_PATH . '/views/pages/404.php'; 
    exit;
}
?>