-- ESTAGIA+ Database Schema
-- Plataforma de Estágios para IFSP Guarulhos

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS estagia_plus CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE estagia_plus;

-- Tabela de Usuários
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
    remember_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_matricula (matricula),
    INDEX idx_role (role),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Configurações Admin
CREATE TABLE IF NOT EXISTS admin_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(255) UNIQUE NOT NULL,
    setting_value LONGTEXT,
    updated_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key),
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Vagas
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
    deleted_at TIMESTAMP NULL,
    INDEX idx_status (status),
    INDEX idx_company (company),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Membros da Equipe (para dados estáticos)
CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(255),
    bio TEXT,
    avatar VARCHAR(255),
    hard_skills JSON,
    soft_skills JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Candidaturas
CREATE TABLE IF NOT EXISTS candidaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vaga_id INT NOT NULL,
    status ENUM('pending', 'accepted', 'rejected', 'withdrawn') DEFAULT 'pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_vaga_id (vaga_id),
    INDEX idx_status (status),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vaga_id) REFERENCES vagas(id) ON DELETE CASCADE,
    UNIQUE KEY unique_candidatura (user_id, vaga_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Feedback (Professores para Alunos)
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_user_id INT NOT NULL,
    to_user_id INT NOT NULL,
    title VARCHAR(255),
    content LONGTEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    is_public BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_from_user (from_user_id),
    INDEX idx_to_user (to_user_id),
    FOREIGN KEY (from_user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (to_user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Mensagens (Chat)
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_user_id INT NOT NULL,
    to_user_id INT NOT NULL,
    subject VARCHAR(255),
    content LONGTEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_from_user (from_user_id),
    INDEX idx_to_user (to_user_id),
    INDEX idx_is_read (is_read),
    FOREIGN KEY (from_user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (to_user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Log de Atividades
CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    description LONGTEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir dados iniciais de membros
INSERT INTO team_members (name, role, bio, hard_skills, soft_skills) VALUES
('Arthur de Oliveira Mendes Sacramento', 'Desenvolvedor Full-Stack & IoT', 'Especialista em desenvolvimento de automações, criação de aplicativos e soluções tecnológicas.', '["Python", "PHP", "JavaScript", "C/C++", "IoT (ESP32)", "Firebase"]', '["Raciocínio Lógico", "Atenção a Detalhes", "Aprendizado Rápido", "Persistência"]'),
('José Roberto Junior Alves Damasceno', 'Desenvolvedor Web & Games', '5 anos de experiência em desenvolvimento de jogos e soluções web modernas.', '["React", "Node.js", "Unity", "C#", "TypeScript", "Blender"]', '["Comunicação Clara", "Criatividade", "Organização", "Resiliência"]'),
('Pedro Miguel Dias Oliveira', 'Especialista Cloud & Segurança', 'Certificado em Oracle Cloud e Cisco, com foco em cibersegurança e arquitetura em nuvem.', '["Oracle Cloud", "Cisco Networking", "Cibersegurança", "MySQL", "JavaScript"]', '["Pensamento Analítico", "Foco", "Dedicação", "Organização"]'),
('Pedro Henri Gois da Silva', 'Desenvolvedor Web & Análise', 'Especialista em engenharia de requisitos e desenvolvimento de aplicações web estruturadas.', '["Python", "JavaScript", "TypeScript", "HTML5/CSS3", "MySQL"]', '["Planejamento", "Autonomia", "Adaptabilidade", "Empatia"]'),
('Rodrigo Querino do Amaral', 'Developer & Growth Marketing', 'Experiência em marketing digital, landing pages e interface com foco em usabilidade.', '["HTML/CSS", "No-code Tools", "Landing Pages", "Marketing Digital"]', '["Comunicação", "Criatividade", "Proatividade", "Adaptabilidade"]'),
('Robert Vieira Souza', 'Full-Stack Developer', 'Experiência em React, React Native e desenvolvimento mobile com foco em qualidade.', '["React", "React Native", "TypeScript", "Node.js", "Firebase"]', '["Resiliência", "Responsabilidade", "Trabalho em Equipe", "Atualização Contínua"]');

-- Inserir configurações padrão
INSERT INTO admin_settings (setting_key, setting_value) VALUES
('site_name', 'ESTAGIA+'),
('site_email', 'contato@estagiamais.ifsp.edu.br'),
('primary_color', '#0B194F'),
('secondary_color', '#F2C400'),
('allow_registrations', '1'),
('require_email_verification', '1'),
('maintenance_mode', '0'),
('site_description', 'Plataforma de Estágios do IFSP Guarulhos'),
('site_url', 'http://localhost/estagiaMais');

-- Criar trigger para atualizar updated_at
DELIMITER //

CREATE TRIGGER users_before_update BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER vagas_before_update BEFORE UPDATE ON vagas
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER admin_settings_before_update BEFORE UPDATE ON admin_settings
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END//

DELIMITER ;

-- Criar view de estatísticas
CREATE OR REPLACE VIEW user_statistics AS
SELECT 
    COUNT(DISTINCT CASE WHEN role = 'student' THEN id END) as total_students,
    COUNT(DISTINCT CASE WHEN role = 'teacher' THEN id END) as total_teachers,
    COUNT(DISTINCT CASE WHEN role = 'company' THEN id END) as total_companies,
    COUNT(DISTINCT CASE WHEN role = 'admin' THEN id END) as total_admins,
    COUNT(DISTINCT id) as total_users,
    COUNT(DISTINCT CASE WHEN DATE(created_at) = CURDATE() THEN id END) as today_registrations
FROM users
WHERE deleted_at IS NULL;

-- Criar view de vagas
CREATE OR REPLACE VIEW vaga_statistics AS
SELECT 
    COUNT(*) as total_vagas,
    COUNT(CASE WHEN status = 'active' THEN 1 END) as active_vagas,
    COUNT(CASE WHEN status = 'inactive' THEN 1 END) as inactive_vagas,
    COUNT(CASE WHEN status = 'closed' THEN 1 END) as closed_vagas
FROM vagas
WHERE deleted_at IS NULL;
