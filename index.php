<?php

date_default_timezone_set('America/Sao_Paulo');

// Carregar variáveis de ambiente do .env
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Ignora comentários
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            $value = trim($value, " \t\n\r\0\x0B\"'"); // Remove aspas
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

// Definir ambiente e caminhos
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');
define('APP_DEBUG', APP_ENV === 'development');
define('BASE_PATH', __DIR__);
define('PUBLIC_PATH', BASE_PATH . '/public');
define('APP_PATH', BASE_PATH . '/app');
define('RESOURCES_PATH', BASE_PATH . '/resources');

// --- INÍCIO DO BLOCO CORRIGIDO: Detecção de BASE_URL simplificada via .env ---

// 1. Obter o valor de configuração do .env. 
// Deve ser vazio ('') para subdomínio (estagiamais.simplifica.gru.br/)
// Deve ser 'estagiaMais' para desenvolvimento (localhost/estagiaMais)
$script = $_ENV['APP_BASE_DIR'] ?? ''; 

// 2. Limpar e formatar o caminho para garantir que seja um prefixo válido
$script = trim($script, '/');
$script = empty($script) ? '' : '/' . $script;

// 3. Definir a BASE_URL
define('BASE_URL', $script);

// 4. Calcular o FULL_URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('FULL_URL', $protocol . '://' . $host . $script);

// --- FIM DO BLOCO CORRIGIDO ---


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
