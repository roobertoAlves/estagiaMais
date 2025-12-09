<?php

if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$script = str_replace('/index.php', '', $scriptName);

$script = rtrim($script, '/');

if (empty($script)) {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $script = preg_replace('#/index\.php.*#', '', $requestUri);
    $script = rtrim($script, '/');
}

if (empty($script) || $script === '') {
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $realPath = realpath(__DIR__);
    if (!empty($docRoot) && !empty($realPath)) {
        $script = str_replace($docRoot, '', $realPath);
        $script = str_replace('\\', '/', $script);
    }
}

if (empty($script) && (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false)) {
    $script = '/estagiaMais';
}

$baseUrl = $script ?: '';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug - ESTAGIA+</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .debug-box { background: white; padding: 20px; border-radius: 5px; max-width: 800px; }
        .debug-item { margin: 10px 0; padding: 10px; background: #f0f0f0; border-left: 3px solid #007bff; }
        .label { font-weight: bold; color: #333; }
        .value { color: #666; font-family: monospace; word-break: break-all; }
        .error { color: #d32f2f; }
        .success { color: #388e3c; }
    </style>
</head>
<body>
    <div class="debug-box">
        <h1>Debug - Detecção de BASE_URL</h1>
        
        <div class="debug-item">
            <div class="label">DOCUMENT_ROOT:</div>
            <div class="value"><?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?></div>
        </div>
        
        <div class="debug-item">
            <div class="label">SCRIPT_NAME:</div>
            <div class="value"><?php echo $_SERVER['SCRIPT_NAME'] ?? 'N/A'; ?></div>
        </div>
        
        <div class="debug-item">
            <div class="label">REQUEST_URI:</div>
            <div class="value"><?php echo $_SERVER['REQUEST_URI'] ?? 'N/A'; ?></div>
        </div>
        
        <div class="debug-item">
            <div class="label">__DIR__ (arquivo atual):</div>
            <div class="value"><?php echo __DIR__; ?></div>
        </div>
        
        <div class="debug-item">
            <div class="label">HTTP_HOST:</div>
            <div class="value"><?php echo $_SERVER['HTTP_HOST'] ?? 'N/A'; ?></div>
        </div>
        
        <div class="debug-item">
            <div class="label">HTTPS:</div>
            <div class="value"><?php echo isset($_SERVER['HTTPS']) ? 'yes' : 'no'; ?></div>
        </div>
        
        <hr>
        
        <div class="debug-item">
            <div class="label">BASE_URL (detectado):</div>
            <div class="value <?php echo empty($baseUrl) ? 'error' : 'success'; ?>">
                "<?php echo htmlspecialchars($baseUrl); ?>"
            </div>
        </div>
        
        <div class="debug-item">
            <div class="label">URL de teste do CSS:</div>
            <div class="value"><?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/css/style.css</div>
        </div>
        
        <div class="debug-item">
            <div class="label">URL de teste de imagem:</div>
            <div class="value"><?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/images/avatars/arthur.png</div>
        </div>
        
        <hr>
        
        <p style="margin-top: 20px; color: #666;">
            <strong>Instruções:</strong><br>
            1. Copie o valor de BASE_URL acima<br>
            2. Remova este arquivo (test.php)<br>
            3. Se necessário, você pode editar manualmente BASE_URL no index.php<br>
            4. Teste as URLs acima em uma nova aba para confirmar que funcionam
        </p>
    </div>
</body>
</html>
