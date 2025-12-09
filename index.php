<?php

date_default_timezone_set('America/Sao_Paulo');

if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
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

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME'] ?? '');
define('BASE_URL', $script);
define('FULL_URL', $protocol . '://' . $host . $script);

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
