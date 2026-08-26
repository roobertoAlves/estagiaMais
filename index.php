<?php
declare(strict_types=1);

/**
 * ESTAGIA+ — entrada mínima para a homepage pública.
 * Não utiliza banco de dados, sessão, autenticação ou arquivo .env.
 */
date_default_timezone_set('America/Sao_Paulo');

define('BASE_PATH', __DIR__);
define('PUBLIC_PATH', BASE_PATH . '/public');
define('APP_PATH', BASE_PATH . '/app');
define('RESOURCES_PATH', BASE_PATH . '/resources');

// Ex.: /estagiaMais/index.php resulta em BASE_URL=/estagiaMais.
// Em uma instalação na raiz do domínio, BASE_URL permanece vazio.
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
$baseUrl = rtrim(str_replace('/index.php', '', $scriptName), '/');
define('BASE_URL', $baseUrl === '/' ? '' : $baseUrl);

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = APP_PATH . '/' . str_replace('\\', '/', $relativeClass) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

require APP_PATH . '/helpers.php';
require BASE_PATH . '/routes.php';
