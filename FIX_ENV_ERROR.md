# 🔧 Como Corrigir o Erro do .env no cPanel

## ❌ Erro que você está vendo:

```
Warning: syntax error, unexpected '(' in C:\xampp\htdocs\estagiaMais/.env on line 7
```

---

## ✅ Solução Rápida

O arquivo `.env` no servidor cPanel está com erro de sintaxe. Siga estes passos:

### 1️⃣ No Gerenciador de Arquivos do cPanel:

1. Vá até: `public_html/grupos/estagiaMais/`
2. Localize o arquivo `.env`
3. Clique com botão direito → **Delete** (apague o arquivo problemático)

### 2️⃣ Criar novo arquivo .env corretamente:

1. Clique em **+ File** ou **Novo Arquivo**
2. Nome do arquivo: `.env`
3. Clique com botão direito no arquivo criado → **Edit**
4. **Cole EXATAMENTE este conteúdo** (substitua com suas credenciais reais):

```env
APP_ENV=production
APP_DEBUG=false

DB_HOST=localhost
DB_USER=simplifica_usuario
DB_PASS=MinhaSenh@123
DB_NAME=simplifica_estagiamais
DB_PORT=3306

MAIL_FROM=contato@estagiamais.simplifica.gru.br
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=seuemail@gmail.com
MAIL_PASSWORD=suasenhaapp
```

### ⚠️ IMPORTANTE - Regras para o arquivo .env:

✅ **PODE usar:**
- Letras: `a-z A-Z`
- Números: `0-9`
- Símbolos: `@ # $ % * - _ . +`

❌ **NÃO use:**
- Parênteses: `( )`
- Chaves: `{ }`
- Colchetes: `[ ]`
- Ponto e vírgula: `;`
- Aspas duplas: `"`
- Apóstrofo: `'`
- Espaços no final das linhas
- Linhas vazias no início do arquivo
- Comentários com `#` (podem causar problemas)

---

## 🗄️ Credenciais do Banco de Dados

Para obter suas credenciais reais:

1. No cPanel, vá em **MySQL® Databases**
2. Veja os bancos criados em **Current Databases**:
   - Nome do banco: ex: `simplifica_estagiamais`
3. Veja os usuários em **Current Users**:
   - Nome de usuário: ex: `simplifica_usuario`
4. Se ainda não criou, crie agora:
   - **Create New Database**: `estagiamais`
   - **Add New User**: crie usuário e senha
   - **Add User To Database**: vincule o usuário ao banco com TODOS os privilégios

### Exemplo de credenciais reais:

```env
DB_HOST=localhost
DB_USER=simplifica_estagia
DB_PASS=Abc123!@#
DB_NAME=simplifica_estagiamais
DB_PORT=3306
```

**⚠️ Substitua `simplifica_estagia`, `Abc123!@#` e `simplifica_estagiamais` pelos valores REAIS do seu cPanel!**

---

## 🧪 Testar se o .env está correto

Após criar o arquivo `.env` no servidor, acesse:

```
https://estagiamais.simplifica.gru.br/debug-cpanel.php
```

Na seção **"Variáveis do Arquivo .env"**, você deve ver:
- ✅ `DB_USER: simplifica_estagia` (seu usuário real)
- ✅ `DB_NAME: simplifica_estagiamais` (seu banco real)
- ✅ `DB_PASS: ***` (senha oculta por segurança)

Se aparecer erro, o arquivo `.env` ainda tem problema.

---

## 🔍 Verificar sintaxe do .env

Se ainda tiver problemas, baixe o arquivo `.env` do servidor e teste localmente:

No PowerShell local:
```powershell
php -r "var_dump(parse_ini_file('.env'));"
```

Se retornar `bool(false)`, há erro de sintaxe no arquivo.

---

## 💾 Importar o Banco de Dados

Após corrigir o `.env`, importe o schema:

1. No cPanel, vá em **phpMyAdmin**
2. Clique no seu banco de dados (ex: `simplifica_estagiamais`)
3. Clique na aba **Import** ou **Importar**
4. Clique em **Choose File** ou **Escolher arquivo**
5. Selecione o arquivo: `database/schema.sql` do seu projeto
6. Clique em **Go** ou **Executar**

Você deve ver: **"Import has been successfully finished"**

---

## 📋 Checklist de Verificação

Após seguir os passos acima, teste:

- [ ] Arquivo `.env` criado sem linhas vazias no início
- [ ] Todas as credenciais substituídas pelos valores reais
- [ ] Sem parênteses, aspas ou caracteres especiais nos valores
- [ ] Banco de dados criado no cPanel
- [ ] Usuário MySQL vinculado ao banco com privilégios
- [ ] Schema importado via phpMyAdmin
- [ ] `debug-cpanel.php` mostra as variáveis corretas
- [ ] Site carrega sem erro de banco: `https://estagiamais.simplifica.gru.br/`

---

## 🆘 Se ainda não funcionar:

Execute o debug completo:
```
https://estagiamais.simplifica.gru.br/debug-cpanel.php
```

Copie TODO o conteúdo da página e me envie para análise detalhada.
