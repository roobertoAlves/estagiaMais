# ESTAGIA+ - Instalação no cPanel

## 📋 Pré-requisitos
- Acesso ao cPanel
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Suporte a mod_rewrite

## 🚀 Instalação no cPanel

### 1. Upload dos Arquivos
1. Acesse o **File Manager** no cPanel
2. Navegue até `public_html/grupos/`
3. Faça upload de todos os arquivos do repositório para a pasta `estagiaMais`
4. Ou clone via Terminal: `git clone https://github.com/roobertoAlves/estagiaMais.git estagiaMais`

### 2. Diagnosticar BASE_URL (Importante!)
1. Acesse `https://estagiamais.simplifica.gru.br/test.php` no navegador
2. Verifique o valor detectado de **BASE_URL**
3. Teste as URLs de CSS e imagens fornecidas
4. Se alguma delas retornar 404, anote o BASE_URL correto

### 3. Corrigir BASE_URL (Se Necessário)
Se o `test.php` mostrar um BASE_URL incorreto:

**Opção A: Usar o .htaccess pré-configurado**
1. Renomeie `.htaccess` para `.htaccess.bak`
2. Renomeie `.htaccess.cpanel` para `.htaccess`
3. Edite o arquivo e ajuste a linha `RewriteBase` com o valor correto

**Opção B: Editar index.php manualmente**
1. Abra `index.php`
2. Localize a seção de detecção de BASE_URL
3. Adicione no final desta seção (antes de `define('BASE_URL'...)`):
```php
// Forçar BASE_URL se a detecção automática falhar
// Descomente e ajuste conforme necessário:
// $script = '/grupos/estagiaMais';
```

### 4. Configurar Banco de Dados
1. No cPanel, vá em **MySQL Databases**
2. Crie um novo banco de dados (ex: `simplifica_estagiaMais`)
3. Crie um usuário e adicione ao banco com todos os privilégios
4. Anote: nome do banco, usuário e senha

### 5. Importar Schema do Banco
1. No cPanel, vá em **phpMyAdmin**
2. Selecione o banco criado
3. Clique em **Import** (Importar)
4. Faça upload do arquivo `database/schema.sql`
5. Clique em **Go** (Executar)

### 6. Configurar Variáveis de Ambiente
1. Edite ou crie o arquivo `.env` na raiz do projeto
2. Preenchaa com as credenciais do seu banco:
```env
APP_ENV=production
APP_DEBUG=false

DB_HOST=localhost
DB_USER=seu_usuario_cpanel
DB_PASS=sua_senha_cpanel
DB_NAME=simplifica_estagiaMais
DB_PORT=3306
```

### 7. Configurar Permissões
No Terminal do cPanel ou File Manager:
```bash
chmod 755 public/images/avatars
chmod 644 .env
chmod 644 .htaccess
chmod 644 test.php
```

### 8. Limpar Arquivo de Debug
Depois de tudo funcionando:
1. Acesse o File Manager
2. Delete o arquivo `test.php`

### 9. Acessar o Site
Acesse: `https://estagiamais.simplifica.gru.br/`

## 🔧 Problemas Comuns

### CSS e imagens retornam 404
**Solução:**
1. Acesse `test.php` para diagnosticar BASE_URL
2. Verifique se o valor está correto
3. Ajuste conforme instruções na seção "Corrigir BASE_URL"

### Página em branco ou erro 500
**Solução:**
1. Ative debug temporariamente: `APP_DEBUG=true` no `.env`
2. Verifique os logs de erro do PHP no cPanel
3. Verifique permissões dos arquivos

### Erro de conexão com banco de dados
**Solução:**
1. Verifique as credenciais no arquivo `.env`
2. Confirme que o usuário tem privilégios no banco
3. Teste a conexão via phpMyAdmin

### Reescrita de URL não funciona
**Solução:**
1. Verifique se mod_rewrite está ativado no cPanel
2. Tente usar `.htaccess.cpanel` renomeando para `.htaccess`
3. Edite a linha `RewriteBase` com o caminho correto

## 📁 Estrutura de Diretórios (cPanel)
```
/home/usuario/public_html/
├── grupos/
│   └── estagiaMais/          ← Seu projeto aqui
│       ├── public/
│       │   ├── css/
│       │   ├── js/
│       │   └── images/
│       ├── app/
│       ├── resources/
│       ├── config/
│       ├── database/
│       ├── index.php
│       ├── .env
│       ├── .htaccess
│       └── test.php           ← Remova após diagnosticar
```

## 📱 Contato e Suporte
Para problemas, abra uma issue no GitHub:
https://github.com/roobertoAlves/estagiaMais/issues

---
**ESTAGIA+** - O primeiro + da sua carreira!
