<?php
/**
 * ESTAGIA+ - Roteamento
 * Define rotas da aplicação
 */

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove /estagiaMais do início da URI se existir
$script_name = dirname($_SERVER['SCRIPT_NAME']);
if (strpos($request_uri, $script_name) === 0) {
    $request_uri = substr($request_uri, strlen($script_name));
}

// Remove barra final
$request_uri = rtrim($request_uri, '/') ?: '/';

// Array de rotas
$routes = [
    // Métodos GET
    'GET' => [
        '/' => 'PagesController@home',
        '/index.php' => 'PagesController@home',
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
    include RESOURCES_PATH . '/views/pages/404.php';
    exit;
}
?>
