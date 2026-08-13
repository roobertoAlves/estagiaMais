<?php
/**
 * ESTAGIA+ — roteamento público mínimo.
 * A experiência agora é uma única homepage; fluxos de autenticação,
 * dashboard e perfil não fazem mais parte da aplicação publicada.
 */

$request_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$base_url = rtrim(defined('BASE_URL') ? BASE_URL : '', '/');

$path = $request_uri;
if ($base_url !== '' && str_starts_with($path, $base_url)) {
    $path = substr($path, strlen($base_url)) ?: '/';
}
$path = '/' . trim($path, '/');
if ($path === '//') {
    $path = '/';
}

$routes = [
    'GET' => [
        '/' => 'PagesController@home',
    ],
];

$route_found = false;
if (isset($routes[$request_method], $routes[$request_method][$path])) {
    [$controller, $method] = explode('@', $routes[$request_method][$path]);
    $controller_class = 'App\\Controllers\\' . $controller;
    if (class_exists($controller_class)) {
        $controller_instance = new $controller_class();
        if (method_exists($controller_instance, $method)) {
            $route_found = true;
            $controller_instance->$method();
            exit;
        }
    }
}

if (!$route_found) {
    http_response_code(404);
    include RESOURCES_PATH . '/views/pages/404.php';
    exit;
}
