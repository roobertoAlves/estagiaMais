<?php

date_default_timezone_set('America/Sao_Paulo');

// Carregar variáveis de ambiente do arquivo .env
if (file_exists(__DIR__ . '/.env')) {
    $env = @parse_ini_file(__DIR__ . '/.env');
    if ($env === false) {
        die('Erro ao ler arquivo .env. Verifique a sintaxe do arquivo (linha 7). Remova parênteses, aspas especiais ou caracteres inválidos.');
    }
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

// Definir ambiente
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');
define('APP_DEBUG', APP_ENV === 'development');
define('BASE_PATH', __DIR__);
define('PUBLIC_PATH', BASE_PATH . '/public');
define('APP_PATH', BASE_PATH . '/app');
define('RESOURCES_PATH', BASE_PATH . '/resources');

// Detectar base URL automaticamente
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$script = str_replace('/index.php', '', $scriptName);

// Se o script terminar com /, remover a barra
$script = rtrim($script, '/');

// Se estiver vazio, tentar com REQUEST_URI
if (empty($script)) {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $script = preg_replace('#/index\.php.*#', '', $requestUri);
    $script = rtrim($script, '/');
}

// Se ainda estiver vazio, tentar documentroot
if (empty($script) || $script === '') {
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $realPath = realpath(__DIR__);
    if (!empty($docRoot) && !empty($realPath)) {
        $script = str_replace($docRoot, '', $realPath);
        $script = str_replace('\\', '/', $script);
    }
}

// Fallback para localhost
if (empty($script) && (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false)) {
    $script = '/estagiaMais';
}

define('BASE_URL', $script ?: '');
define('FULL_URL', $protocol . '://' . $host . ($script ?: ''));

session_start();

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = APP_PATH . '/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

$config_path = BASE_PATH . '/config/database.php';
if (file_exists($config_path)) {
    require_once $config_path;
}

$helpers_path = APP_PATH . '/helpers.php';
if (file_exists($helpers_path)) {
    require_once $helpers_path;
}

require_once BASE_PATH . '/routes.php';
?>
