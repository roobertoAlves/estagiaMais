<?php
/**
 * Configuração do Banco de Dados
 */

define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'estagia_plus');
define('DB_PORT', $_ENV['DB_PORT'] ?? 3306);

// Classe para gerenciar conexão com banco de dados
class Database {
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                self::$connection = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function query($sql, $params = []) {
        $pdo = self::connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function select($sql, $params = []) {
        return self::query($sql, $params)->fetchAll();
    }

    public static function selectOne($sql, $params = []) {
        return self::query($sql, $params)->fetch();
    }

    public static function insert($sql, $params = []) {
        self::query($sql, $params);
        return self::connect()->lastInsertId();
    }

    public static function update($sql, $params = []) {
        return self::query($sql, $params)->rowCount();
    }

    public static function delete($sql, $params = []) {
        return self::query($sql, $params)->rowCount();
    }
}

// Criar banco de dados e tabelas se não existirem
function initializeDatabase() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8mb4", DB_USER, DB_PASS);
        
        // Criar banco de dados
        $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Conectar ao banco
        $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
        
        // Criar tabelas
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                matricula VARCHAR(50) UNIQUE NOT NULL,
                course VARCHAR(255),
                password VARCHAR(255) NOT NULL,
                avatar VARCHAR(255),
                role ENUM('student', 'teacher', 'admin', 'company') DEFAULT 'student',
                lgpd_accepted BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL
            )
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS admin_settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                setting_key VARCHAR(255) UNIQUE NOT NULL,
                setting_value LONGTEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS vagas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description LONGTEXT,
                company VARCHAR(255) NOT NULL,
                location VARCHAR(255),
                salary_min DECIMAL(10, 2),
                salary_max DECIMAL(10, 2),
                requirements TEXT,
                status ENUM('active', 'inactive', 'closed') DEFAULT 'active',
                created_by INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL
            )
        ");

        // Garantir colunas ausentes (ambientes que já tinham tabela)
        $pdo->exec("ALTER TABLE vagas ADD COLUMN IF NOT EXISTS deleted_at TIMESTAMP NULL");
        $pdo->exec("ALTER TABLE vagas ADD COLUMN IF NOT EXISTS salary_min DECIMAL(10,2)");
        $pdo->exec("ALTER TABLE vagas ADD COLUMN IF NOT EXISTS salary_max DECIMAL(10,2)");
        $pdo->exec("ALTER TABLE vagas ADD COLUMN IF NOT EXISTS requirements TEXT");
        $pdo->exec("ALTER TABLE vagas ADD COLUMN IF NOT EXISTS created_by INT");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS team_members (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                role VARCHAR(255),
                bio TEXT,
                avatar VARCHAR(255),
                hard_skills LONGTEXT,
                soft_skills LONGTEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        return true;
    } catch (Exception $e) {
        if (APP_DEBUG) {
            echo "Erro ao inicializar banco: " . $e->getMessage();
        }
        return false;
    }
}

// Inicializar banco se estiver em desenvolvimento
if (APP_ENV === 'development') {
    initializeDatabase();
}
?>
