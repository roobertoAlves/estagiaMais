<?php
/**
 * Arquivo de Debug para cPanel - Testar detecção de BASE_URL e paths
 */

// Detectar base URL automaticamente (mesmo código do index.php)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$script = str_replace('/index.php', '', $scriptName);
$script = str_replace('/debug-cpanel.php', '', $script);

// Se o script terminar com /, remover a barra
$script = rtrim($script, '/');

// Se estiver vazio, tentar com REQUEST_URI
if (empty($script)) {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $script = preg_replace('#/(index|debug-cpanel)\.php.*#', '', $requestUri);
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

$baseUrl = $script ?: '';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug cPanel - ESTAGIA+</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', system-ui, sans-serif; 
            background: linear-gradient(135deg, #0B194F 0%, #0D2158 100%);
            color: #fff;
            padding: 20px;
            min-height: 100vh;
        }
        .container { 
            max-width: 900px; 
            margin: 0 auto; 
            background: rgba(255,255,255,0.95);
            border-radius: 12px;
            padding: 30px;
            color: #333;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 { 
            color: #0B194F; 
            margin-bottom: 10px;
            font-size: 2rem;
        }
        h1 span { color: #F2C400; }
        .subtitle { 
            color: #666; 
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #F2C400;
        }
        .section { 
            background: #f9f9f9; 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 8px;
            border-left: 4px solid #0B194F;
        }
        .section h2 { 
            color: #0B194F; 
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .info-row { 
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child { border-bottom: none; }
        .label { 
            font-weight: 600; 
            color: #0B194F;
        }
        .value { 
            font-family: 'Courier New', monospace; 
            background: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            word-break: break-all;
            color: #333;
            border: 1px solid #ddd;
        }
        .success { 
            background: #E8F5E9 !important; 
            color: #2E7D32 !important;
            border-color: #4CAF50 !important;
        }
        .error { 
            background: #FFEBEE !important; 
            color: #C62828 !important;
            border-color: #F44336 !important;
        }
        .warning {
            background: #FFF3E0 !important;
            color: #E65100 !important;
            border-color: #FF9800 !important;
        }
        .test-section {
            background: #E3F2FD;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid #2196F3;
        }
        .test-url {
            display: block;
            padding: 12px;
            background: #fff;
            border-radius: 4px;
            margin: 8px 0;
            text-decoration: none;
            color: #1976D2;
            border: 1px solid #BBDEFB;
            transition: all 0.3s;
        }
        .test-url:hover {
            background: #BBDEFB;
            transform: translateX(5px);
        }
        .instructions {
            background: #FFF9C4;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #FBC02D;
        }
        .instructions h3 {
            color: #F57F17;
            margin-bottom: 10px;
        }
        .instructions ol {
            margin-left: 20px;
        }
        .instructions li {
            margin: 8px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ESTAGIA<span>+</span> - Debug cPanel</h1>
        <p class="subtitle">Diagnóstico de detecção de BASE_URL e Paths</p>
        
        <div class="section">
            <h2>🔍 Variáveis do Servidor</h2>
            <div class="info-row">
                <div class="label">DOCUMENT_ROOT:</div>
                <div class="value"><?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="label">SCRIPT_NAME:</div>
                <div class="value"><?php echo $_SERVER['SCRIPT_NAME'] ?? 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="label">SCRIPT_FILENAME:</div>
                <div class="value"><?php echo $_SERVER['SCRIPT_FILENAME'] ?? 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="label">REQUEST_URI:</div>
                <div class="value"><?php echo $_SERVER['REQUEST_URI'] ?? 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="label">HTTP_HOST:</div>
                <div class="value"><?php echo $_SERVER['HTTP_HOST'] ?? 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="label">__DIR__:</div>
                <div class="value"><?php echo __DIR__; ?></div>
            </div>
            <div class="info-row">
                <div class="label">realpath(__DIR__):</div>
                <div class="value"><?php echo realpath(__DIR__); ?></div>
            </div>
        </div>

        <div class="section">
            <h2>✅ BASE_URL Detectado</h2>
            <div class="info-row">
                <div class="label">BASE_URL:</div>
                <div class="value <?php echo empty($baseUrl) ? 'error' : 'success'; ?>">
                    "<?php echo htmlspecialchars($baseUrl); ?>"
                </div>
            </div>
            <div class="info-row">
                <div class="label">URL Completa:</div>
                <div class="value success">
                    <?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>
                </div>
            </div>
        </div>

        <div class="test-section">
            <h2>🧪 Testar URLs de Assets</h2>
            <p style="margin-bottom: 15px; color: #555;"><strong>Clique nos links abaixo para testar se os arquivos carregam:</strong></p>
            
            <a href="<?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/css/style.css" 
               target="_blank" class="test-url">
                📄 CSS Principal: /public/css/style.css
            </a>
            
            <a href="<?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/css/student.css" 
               target="_blank" class="test-url">
                📄 CSS Student: /public/css/student.css
            </a>
            
            <a href="<?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/css/auth.css" 
               target="_blank" class="test-url">
                📄 CSS Auth: /public/css/auth.css
            </a>
            
            <a href="<?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/css/admin.css" 
               target="_blank" class="test-url">
                📄 CSS Admin: /public/css/admin.css
            </a>
            
            <a href="<?php echo $protocol; ?>://<?php echo $host; ?><?php echo $baseUrl; ?>/public/images/avatars/arthur.png" 
               target="_blank" class="test-url">
                🖼️ Imagem: /public/images/avatars/arthur.png
            </a>
        </div>

        <div class="instructions">
            <h3>📋 Próximos Passos:</h3>
            <ol>
                <li>Verifique se o <strong>BASE_URL</strong> acima está correto (deve ser <code>/grupos/estagiaMais</code> no cPanel)</li>
                <li>Clique nos links de teste acima - devem abrir os arquivos CSS e imagens</li>
                <li>Se os links funcionarem aqui mas não na aplicação, o problema é no código PHP</li>
                <li>Se os links NÃO funcionarem, verifique:
                    <ul style="margin-top: 8px; margin-left: 20px;">
                        <li>Se os arquivos existem no servidor em <code>/home1/simplifica/public_html/grupos/estagiaMais/public/</code></li>
                        <li>Se as permissões estão corretas (644 para arquivos, 755 para pastas)</li>
                        <li>Se o <code>.htaccess</code> está configurado corretamente</li>
                    </ul>
                </li>
                <li>Após correção, <strong>delete este arquivo</strong> por segurança</li>
            </ol>
        </div>

        <div class="section">
            <h2>📁 Verificar Arquivos Localmente</h2>
            <p style="margin-bottom: 15px; color: #555;">Verificando se os arquivos existem no servidor:</p>
            <?php
            $files_to_check = [
                'public/css/style.css',
                'public/css/student.css',
                'public/css/auth.css',
                'public/css/admin.css',
                'public/images/avatars/arthur.png',
                'public/images/avatars/roberto.png',
                'public/js/app.js'
            ];
            
            foreach ($files_to_check as $file) {
                $full_path = __DIR__ . '/' . $file;
                $exists = file_exists($full_path);
                $readable = $exists && is_readable($full_path);
                echo '<div class="info-row">';
                echo '<div class="label">' . htmlspecialchars($file) . ':</div>';
                echo '<div class="value ' . ($exists && $readable ? 'success' : 'error') . '">';
                if ($exists && $readable) {
                    echo '✅ Existe e é legível (' . number_format(filesize($full_path) / 1024, 2) . ' KB)';
                } elseif ($exists) {
                    echo '⚠️ Existe mas não é legível';
                } else {
                    echo '❌ Arquivo não encontrado';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
