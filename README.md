# ESTAGIA+ - Plataforma de Estágios para IFSP Guarulhos

Plataforma digital para centralizar oportunidades de estágio, facilitar comunicação entre alunos, professores e empresas, integrando-se com plataformas externas de emprego.

## 🎯 Requisitos do Sistema

- **PHP**: 8.0 ou superior
- **MySQL/MariaDB**: 5.7 ou superior
- **Servidor Web**: Apache com mod_rewrite habilitado
- **Navegador**: Chrome, Firefox, Safari, Edge (últimas versões)

## 📋 Requisitos Funcionais Implementados

### Home Page
- ✅ Header com menu navegável
- ✅ Hero section com CTA
- ✅ Seção Sobre (Missão, Visão, Valores)
- ✅ Análise SWOT interativa
- ✅ Grid de membros da equipe com modal
- ✅ Seção de Vagas (placeholder para integração)
- ✅ Footer com informações e links legais

### Sistema de Autenticação
- ✅ Tela de Login (email/matrícula + senha)
- ✅ Tela de Registro (dados completos + LGPD)
- ✅ Upload de avatar com validação
- ✅ Validação de força de senha
- ✅ CSRF token para segurança
- ✅ Cookies "Lembrar-me" seguros
- ✅ Hashing de senhas com bcrypt

### Dashboard Admin
- ✅ Dashboard com estatísticas (usuários, vagas, estágios)
- ✅ Gerenciamento de usuários
- ✅ Gerenciamento de vagas
- ✅ Configurações do sistema
- ✅ **Painel de cores** com roda de cor interativa
- ✅ Controle de permissões por role

## 🎨 Identidade Visual

### Paleta de Cores
- **Azul Primário**: `#0B194F` - Confiabilidade e profissionalismo
- **Amarelo Destaque**: `#F2C400` - Energia e destaque visual
- **Cinza Escuro**: `#1C1C1E` - Fundo neutro
- **Branco**: `#FFFFFF` - Textos e contraste

### Acessibilidade
- ✅ Contraste WCAG AA em todos os elementos
- ✅ Tipografia legível (16px base)
- ✅ Navegação por teclado completa
- ✅ Labels semânticas em formulários
- ✅ Textos alternativos e ARIA labels

## 🚀 Instalação Rápida

### 1. Clonar o repositório
```bash
cd c:\xampp\htdocs\estagiaMais
```

### 2. Configurar ambiente
```bash
# Copiar arquivo de configuração
copy .env.example .env

# Editar as configurações conforme necessário
```

### 3. Criar banco de dados
O banco é criado automaticamente na primeira requisição. Certifique-se de que:
- MySQL está rodando
- Credenciais em `.env` estão corretas

### 4. Acessar a aplicação
```
http://localhost/estagiaMais
```

## 📁 Estrutura do Projeto

```
estagiaMais/
├── app/
│   ├── Controllers/
│   │   ├── Controller.php          # Base controller
│   │   ├── PagesController.php     # Páginas públicas
│   │   ├── AuthController.php      # Autenticação
│   │   ├── AdminController.php     # Admin dashboard
│   │   └── ProfileController.php   # Perfil de usuário
│   └── Models/
│       └── User.php                # Modelo de usuários
├── public/
│   ├── css/
│   │   └── style.css               # Estilos globais
│   ├── js/
│   │   └── app.js                  # Scripts gerais
│   ├── images/                     # Imagens estáticas
│   └── avatars/                    # Avatares de usuários (upload)
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.php             # Layout principal
│       │   ├── auth.php            # Layout autenticação
│       │   └── admin.php           # Layout admin
│       └── pages/
├── database/                        # Migrações (futuro)
├── config/
│   └── database.php                # Configuração BD
├── .env                            # Variáveis de ambiente
├── .htaccess                       # Reescrita de URL
├── index.php                       # Entrada da aplicação
└── routes.php                      # Definição de rotas
```

## 🔐 Segurança Implementada

### Autenticação e Autorização
- ✅ Sessions PHP seguras
- ✅ CSRF tokens em formulários
- ✅ Password hashing com bcrypt
- ✅ Validação de entrada (sanitização)
- ✅ Proteção contra timing attacks
- ✅ Limite de tentativas de login (futuro)

### Proteção de Dados
- ✅ Validação de MIME types para uploads
- ✅ Limite de tamanho de arquivo (5MB)
- ✅ Diretório de uploads protegido
- ✅ Senhas com requisitos mínimos:
  - 8+ caracteres
  - Letra maiúscula
  - Número

### LGPD (Lei Geral de Proteção de Dados)
- ✅ Consentimento obrigatório no registro
- ✅ Política de privacidade disponível
- ✅ Campo `lgpd_accepted` no banco
- ✅ Dados de usuário deletados apenas com consentimento

## 🎬 Animações e Interatividade

### Bibliotecas Utilizadas
- **AOS** (Animate On Scroll) - Animações ao scroll
- **GSAP** - Animações complexas (carregadas via CDN)
- **Animate.css** - Micro-interações
- **CSS3** - Transições e transformações nativas

### Efeitos Implementados
- Fade-in e slide-in na home
- Hover effects em cards e botões
- Modal com animação em membros
- Transições suaves em links

## 📱 Responsividade

- ✅ Mobile-first design
- ✅ Breakpoints: 768px, 480px
- ✅ Sidebar responsiva em admin
- ✅ Grid layouts adaptáveis
- ✅ Imagens fluidas

## 🔄 Rotas da Aplicação

### Públicas
- `GET /` - Home page
- `GET /sobre` - Sobre ESTAGIA+
- `GET /login` - Formulário de login
- `GET /registro` - Formulário de registro

### Autenticadas
- `GET /perfil` - Perfil do usuário
- `POST /logout` - Fazer logout

### Admin (requer role 'admin')
- `GET /admin/dashboard` - Dashboard principal
- `GET /admin/users` - Gerenciar usuários
- `GET /admin/vagas` - Gerenciar vagas
- `GET /admin/settings` - Configurações do sistema

## 💻 Stack Técnico

### Backend
- **PHP 8.0+** - Linguagem servidor
- **MySQL/MariaDB** - Banco de dados
- **PDO** - Acesso ao banco (seguro contra SQL injection)

### Frontend
- **HTML5** - Estrutura semântica
- **CSS3** - Estilos e variáveis
- **JavaScript ES6+** - Interatividade

### Ferramentas e Bibliotecas
- **AOS 2.3.1** - Animações ao scroll
- **GSAP 3.12** - Animações avançadas
- **Animate.css 4.1** - Animações predefinidas
- **FontAwesome 6.4** - Ícones
- **PDO** - Database abstraction

## 📊 Integração Futura (APIs)

Preparado para integrar com:
- **Nube** - Plataforma de vagas
- **CIEE** - Centro de Integração Empresa-Escola
- **Gupy** - Plataforma de recrutamento
- **LinkedIn** - Rede profissional

Variáveis de configuração no `.env`:
```
NUBE_API_KEY=
CIEE_API_KEY=
GUPY_API_KEY=
LINKEDIN_API_KEY=
```

## 📧 Configuração de Email

Para habilitar envio de emails (verificação, notificações):

1. Configurar serviço SMTP (ex: Mailtrap.io)
2. Atualizar `.env`:
```env
MAIL_FROM=contato@estagiamais.ifsp.edu.br
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha
```

## 🧪 Testando a Aplicação

### Criar Conta de Admin
```php
// No database.php, execute:
$user_data = [
    'name' => 'Administrador',
    'email' => 'admin@ifsp.edu.br',
    'matricula' => 'ADM001',
    'password' => password_hash('senha_segura_123', PASSWORD_BCRYPT),
    'role' => 'admin',
    'lgpd_accepted' => true
];
```

### Contas de Teste
- **Email**: aluno@ifsp.edu.br
- **Matrícula**: MAT001
- **Senha**: Senha123

## 🐛 Troubleshooting

### Erro "Banco de dados não encontrado"
- Verificar credenciais em `.env`
- Garantir que MySQL está rodando
- Permissions do diretório `/database`

### Erro "Módulo rewrite desabilitado"
- Habilitar `mod_rewrite` no Apache
- `a2enmod rewrite` (Linux)
- Restart Apache

### Avatar não fazendo upload
- Verificar permissões em `/public/avatars`
- Limite de upload no php.ini (`upload_max_filesize`)

## 📚 Documentação Adicional

- [LGPD - Lei Geral de Proteção de Dados](https://www.gov.br/cidadania/pt-br/acesso-a-informacao/lgpd)
- [WCAG 2.1 - Diretrizes de Acessibilidade](https://www.w3.org/WAI/WCAG21/quickref/)
- [OWASP - Top 10 Vulnerabilidades Web](https://owasp.org/www-project-top-ten/)

## 👥 Equipe de Desenvolvimento

Desenvolvido pelos alunos do IFSP Guarulhos:

- Arthur de Oliveira Mendes Sacramento
- José Roberto Junior Alves Damasceno
- Pedro Miguel Dias Oliveira
- Pedro Henri Gois da Silva
- Rodrigo Querino do Amaral
- Robert Vieira Souza

## 📄 Licença

Projeto desenvolvido para fins educacionais no IFSP Guarulhos.

## 📞 Contato

- Email: contato@estagiamais.ifsp.edu.br
- IFSP Guarulhos: (11) 1024-5580
- Endereço: Av. Sete de Setembro, 1271 - Guarulhos, SP

---

**Desenvolvido com ❤️ para a comunidade acadêmica do IFSP Guarulhos**
