# ESTAGIA+ — versão mínima para XAMPP

Esta versão conserva somente o PHP necessário para renderizar a homepage pública. Ela **não usa banco de dados, `.env`, sessão, login, dashboard, perfil, modelos ou configurações de banco**.

## Arquivos PHP que permanecem

| Caminho | Motivo |
| --- | --- |
| `index.php` | Entrada da aplicação e detecção automática da subpasta. |
| `routes.php` | Rota única da homepage (`/`). |
| `app/Controllers/Controller.php` | Renderizador mínimo da view. |
| `app/Controllers/PagesController.php` | Mantém os dados públicos da equipe e chama a view. |
| `app/helpers.php` | Gera URLs corretas para CSS, JS e imagens. |
| `resources/views/layouts/app.php` | Template da homepage. |

## Como abrir no XAMPP

1. Extraia a pasta `estagiaMais-xampp` dentro de `C:\xampp\htdocs\`.
2. Inicie o Apache no painel do XAMPP.
3. Abra `http://localhost/estagiaMais-xampp/`.

A entrada detecta automaticamente o nome da pasta do projeto. Assim, os estilos, scripts e imagens usam caminhos como `/estagiaMais-xampp/public/...` e não quebram quando a aplicação não está na raiz do `localhost`.

## O que foi removido

O pacote não inclui banco de dados, modelos, `config/database.php`, schema SQL, autenticação, login, dashboard, perfil, área administrativa, `.env` ou arquivos Git.
