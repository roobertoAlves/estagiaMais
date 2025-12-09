# 🚀 Deploy no cPanel - Passo a Passo

## 1️⃣ Preparação dos Arquivos para Upload

### Arquivos que VOCÊ DEVE RENOMEAR antes de enviar ao cPanel:

1. **`.env.cpanel`** → Renomear para **`.env`** no servidor
   - Este arquivo contém as credenciais do banco de dados do cPanel
   - **IMPORTANTE**: Edite este arquivo com suas credenciais reais antes de enviar

2. **`.htaccess.cpanel`** → Renomear para **`.htaccess`** no servidor
   - Este arquivo já está configurado com `RewriteBase /grupos/estagiaMais/`

### Arquivos que NÃO devem ser enviados ao cPanel:
- `.env` (este é só para desenvolvimento local)
- `.htaccess` (use o `.htaccess.cpanel` renomeado)
- `debug-cpanel.php` (apague após testar)

---

## 2️⃣ Configuração do Banco de Dados no cPanel

Antes de enviar os arquivos, configure o banco no cPanel:

1. No cPanel, acesse **MySQL® Databases** ou **Banco de Dados MySQL**
2. Crie um novo banco de dados:
   - Nome sugerido: `simplifica_estagiamais` ou similar
3. Crie um novo usuário MySQL:
   - Nome de usuário: escolha um nome
   - Senha: crie uma senha forte
4. Adicione o usuário ao banco de dados:
   - Selecione o banco criado
   - Selecione o usuário criado
   - Marque **TODOS OS PRIVILÉGIOS**
   - Clique em **Make Changes**
5. **ANOTE ESSAS INFORMAÇÕES**:
   - Nome do banco: `simplifica_estagiamais`
   - Nome do usuário: `simplifica_usuario`
   - Senha: `sua_senha_segura`

---

## 3️⃣ Editar o arquivo `.env.cpanel`

Abra o arquivo `.env.cpanel` e altere com suas credenciais reais:

```env
# Ambiente
APP_ENV=production
APP_DEBUG=false

# IMPORTANTE: Substitua pelos dados reais do seu banco no cPanel
DB_HOST=localhost
DB_USER=simplifica_usuario       # ← Seu usuário MySQL criado no cPanel
DB_PASS=sua_senha_segura         # ← Sua senha MySQL
DB_NAME=simplifica_estagiamais   # ← Seu banco de dados criado
DB_PORT=3306

# Email (configure depois se necessário)
MAIL_FROM=contato@estagiamais.simplifica.gru.br
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_app
```

---

## 4️⃣ Upload dos Arquivos via Git Version Control (Recomendado)

### Método 1: Git Version Control no cPanel

1. No cPanel, procure **Git™ Version Control**
2. Clique em **Create** ou **Criar**
3. Preencha:
   - **Clone URL**: `https://github.com/roobertoAlves/estagiaMais.git`
   - **Repository Path**: `/home1/simplifica/public_html/grupos/estagiaMais`
   - **Repository Name**: `estagiaMais`
4. Clique em **Create**

### Após clonar o repositório:

1. Ainda no Git Version Control, clique em **Manage** no repositório
2. **IMPORTANTE**: Verifique se está na branch **main**
3. Clique em **Pull or Deploy** → **Update from Remote** para pegar a última versão

---

## 5️⃣ Configurar Arquivos Específicos do Servidor

Via **Gerenciador de Arquivos** no cPanel:

1. Navegue até: `public_html/grupos/estagiaMais/`

2. **Criar o arquivo `.env`**:
   - Localize o arquivo `.env.cpanel`
   - **Copie** o arquivo (não mova)
   - Renomeie a cópia para `.env`
   - Edite o `.env` e coloque suas credenciais reais do banco

3. **Substituir o arquivo `.htaccess`**:
   - **Delete** o arquivo `.htaccess` existente
   - Localize o arquivo `.htaccess.cpanel`
   - **Copie** o arquivo
   - Renomeie a cópia para `.htaccess`

4. **Importar o Banco de Dados**:
   - Vá em **phpMyAdmin** no cPanel
   - Selecione seu banco de dados criado
   - Clique em **Importar**
   - Selecione o arquivo `database/schema.sql` do seu projeto
   - Clique em **Executar**

---

## 6️⃣ Configurar o Subdomínio

1. No painel principal do cPanel, clique em **Domínios**
2. Clique em **Criar um Novo Domínio**
3. Preencha:
   - **Domínio**: `estagiamais.simplifica.gru.br`
   - **Raiz do Documento**: `/home1/simplifica/public_html/grupos/estagiaMais`
4. Clique em **Enviar** ou **Submit**

---

## 7️⃣ Testar a Aplicação

1. Acesse: `https://estagiamais.simplifica.gru.br/`

### Se aparecer erro 404 nos arquivos CSS/imagens:

Execute o debug:
```
https://estagiamais.simplifica.gru.br/debug-cpanel.php
```

Verifique:
- ✅ BASE_URL deve mostrar: `/grupos/estagiaMais`
- ✅ Todos os links de teste devem funcionar
- ✅ Todos os arquivos devem estar marcados como ✅ encontrados

### Se o banco de dados não conectar:

Verifique:
- As credenciais no arquivo `.env` estão corretas?
- O usuário tem permissões no banco?
- O banco de dados foi importado corretamente?

---

## 8️⃣ Permissões de Arquivos (se necessário)

Se tiver problemas de acesso, ajuste as permissões:

```bash
# Via Terminal SSH no cPanel (se disponível)
chmod 755 /home1/simplifica/public_html/grupos/estagiaMais
chmod 755 /home1/simplifica/public_html/grupos/estagiaMais/public
chmod 644 /home1/simplifica/public_html/grupos/estagiaMais/.htaccess
chmod 644 /home1/simplifica/public_html/grupos/estagiaMais/.env
chmod 644 /home1/simplifica/public_html/grupos/estagiaMais/public/css/*
chmod 644 /home1/simplifica/public_html/grupos/estagiaMais/public/images/**/*
```

Ou via Gerenciador de Arquivos:
- Clique com botão direito no arquivo/pasta
- **Permissões** ou **Change Permissions**
- Pastas: `755` (rwxr-xr-x)
- Arquivos: `644` (rw-r--r--)

---

## 9️⃣ Atualizar o Site (Integração Contínua)

Quando fizer um `git push` para a branch **main** no GitHub:

1. Acesse o cPanel
2. Vá em **Git™ Version Control**
3. Clique em **Manage** no repositório `estagiaMais`
4. Clique em **Pull or Deploy** → **Update from Remote**
5. Pronto! O site está atualizado 🎉

---

## 🔒 Segurança

Após confirmar que tudo funciona:

1. **Delete o arquivo `debug-cpanel.php`** do servidor
2. Verifique se o `.env` não está acessível via navegador:
   - Teste: `https://estagiamais.simplifica.gru.br/.env`
   - Deve retornar **403 Forbidden** ✅

---

## 📝 Checklist Final

- [ ] Banco de dados criado no cPanel
- [ ] Usuário MySQL criado e vinculado ao banco
- [ ] Arquivo `.env.cpanel` editado com credenciais reais
- [ ] Repositório clonado via Git Version Control
- [ ] Arquivo `.env` criado no servidor (cópia do `.env.cpanel`)
- [ ] Arquivo `.htaccess` substituído pela versão `.htaccess.cpanel`
- [ ] Banco de dados importado via phpMyAdmin
- [ ] Subdomínio configurado apontando para a pasta correta
- [ ] Site acessível em `https://estagiamais.simplifica.gru.br/`
- [ ] CSS e imagens carregando corretamente
- [ ] Login funcionando
- [ ] `debug-cpanel.php` deletado do servidor

---

## 🆘 Problemas Comuns

### Erro: "Access denied for user 'root'@'localhost'"
**Solução**: O arquivo `.env` não foi criado ou está com credenciais erradas. Verifique o passo 5.

### Erro 404 nos arquivos CSS e imagens
**Solução**: O `.htaccess` não foi substituído corretamente. Use o `.htaccess.cpanel`.

### Erro 500 Internal Server Error
**Solução**: Problema no `.htaccess` ou permissões. Verifique o passo 8.

### Página em branco
**Solução**: Erro no PHP. Ative temporariamente `APP_DEBUG=true` no `.env` para ver o erro.

---

## 📞 Suporte

Se precisar de ajuda, verifique os logs de erro:
- No cPanel: **Errors** ou **Erros** (ícone com símbolo de alerta)
- Logs ficam em: `/home1/simplifica/public_html/grupos/estagiaMais/error_log`
