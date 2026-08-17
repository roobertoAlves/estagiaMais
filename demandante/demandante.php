<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Demandante - ESTAGIA+ | IFSP Guarulhos</title>
  <meta name="description" content="Conheça o demandante do projeto ESTAGIA+: o Prof. Robson Ferreira Lopes e o IFSP - Campus Guarulhos." />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="icon" href="./img/logoIF.png" type="image/png">
</head>

<body>
  <nav class="navbar" id="navbar">
    <a href="#home" class="nav-logo">
      <img src="./img/logoIF.png" alt="Logo Vertical IFSP" />
      <span>ESTAGIA<b>+</b></span>
    </a>
    <button class="nav-toggle" id="navToggle" aria-label="Abrir menu">
      <i class="fas fa-bars"></i>
    </button>
    <ul class="nav-links" id="navLinks">
      <li><a href="#projeto">Projeto</a></li>
      <li><a href="#entrevista">Entrevista</a></li>
      <li><a href="#if">O IF</a></li>
      <li><a href="#demandante">Demandante</a></li>
      <li><a href="#contato">Contato</a></li>
    </ul>
  </nav>

  <header class="hero" id="home">
    <div class="hero-bg"></div>
    <div class="container hero-grid">
      <div class="hero-text animated-item">
        <span class="eyebrow">Demandante do projeto</span>
        <h1>
          A pessoa por trás do <span>ESTAGIA+</span>
        </h1>
        <p>
          Toda plataforma nasce de um problema real. O ESTAGIA+ nasceu da
          necessidade identificada pela Coordenadoria de Estágios do IFSP -
          Campus Guarulhos, e teve no Prof. Robson Ferreira Lopes o
          demandante e idealizador do projeto.
        </p>
        <div class="cta-buttons">
          <a href="#demandante" class="cta-button">Conhecer o Robson</a>
          <a href="#entrevista" class="cta-button cta-button-outline">Assistir à Entrevista</a>
        </div>
      </div>
      <div class="hero-photo animated-item">
        <img src="./img/frenteIF.webp" alt="Fachada do IFSP Campus Guarulhos" />
      </div>
    </div>
  </header>

  <main>
    <section id="projeto" class="container">
      <span class="section-eyebrow animated-item">O que é</span>
      <h2 class="section-title animated-item">O Projeto ESTAGIA+</h2>
      <div class="card feature-card animated-item">
        <p>
          O ESTAGIA+ é a plataforma de gestão de estágios do IFSP - Campus
          Guarulhos. O objetivo é centralizar, em um único lugar, as
          oportunidades de estágio disponíveis para os alunos, simplificar o
          processo de candidatura e facilitar a comunicação entre
          estudantes, professores e a coordenação responsável pelo
          acompanhamento dos estágios.
        </p>
        <p>
          Antes da plataforma, esse processo era feito de forma manual e
          descentralizada — vagas divulgadas em murais, grupos e e-mails
          avulsos, sem um canal único de acompanhamento. O ESTAGIA+ propõe
          resolver exatamente esse gargalo, dando mais visibilidade às
          oportunidades e mais agilidade para quem coordena os estágios do
          campus.
        </p>
      </div>
    </section>

    <section id="entrevista" class="container">
      <span class="section-eyebrow animated-item">Na prática</span>
      <h2 class="section-title animated-item">Entrevista com o Demandante</h2>
      <p class="section-description animated-item">
        Conversamos com o Prof. Robson Ferreira Lopes sobre o problema que
        motivou o projeto, as expectativas em relação à plataforma e como o
        ESTAGIA+ se conecta com a rotina da Coordenadoria de Estágios.
      </p>
      <div class="video-container animated-item">
        <!-- TODO: substituir pelo link real do vídeo (ex: Google Drive, YouTube) -->
        <iframe src="https://youtu.be/JLuq5yj1SWM" allow="autoplay" frameborder="0" title="Entrevista com o Demandante"></iframe>
      </div>
    </section>

    <section id="if" class="container">
      <span class="section-eyebrow animated-item">A instituição</span>
      <h2 class="section-title animated-item">O IFSP - Campus Guarulhos</h2>
      <div class="two-col">
        <div class="card animated-item">
          <h3><i class="fas fa-landmark"></i> Instituto Federal de São Paulo</h3>
          <p>
            O IFSP é uma instituição pública federal de educação, presente
            em dezenas de municípios do estado de São Paulo, que oferece
            ensino técnico, graduação e pós-graduação gratuitos e
            reconhecidos pela qualidade. É um dos principais caminhos de
            acesso ao ensino superior público na região.
          </p>
        </div>
        <div class="card animated-item">
          <h3><i class="fas fa-graduation-cap"></i> Campus Guarulhos</h3>
          <p>
            O Campus Guarulhos se destaca em cursos técnicos e superiores
            nas áreas de Tecnologia da Informação e Engenharia, formando
            profissionais para o mercado de trabalho da região metropolitana
            e servindo como polo de inovação e empreendedorismo estudantil.
          </p>
        </div>
      </div>
    </section>

    <section id="demandante" class="container">
      <span class="section-eyebrow animated-item">Quem pediu</span>
      <h2 class="section-title animated-item">Prof. Robson Ferreira Lopes</h2>

      <div class="profile-card animated-item">
        <div class="profile-header">
          <div class="profile-badge">
            <i class="fas fa-user-tie"></i>
          </div>
          <div>
            <h3>Robson Ferreira Lopes</h3>
            <p class="profile-role">
              Engenheiro • Sysadmin • Docente — Segurança, Redes, SDN, Cloud, Linux, InfraÁgil e DevOps
            </p>
            <a href="https://www.linkedin.com/in/flrobson77/" target="_blank" rel="noopener" class="profile-linkedin">
              <i class="fab fa-linkedin"></i> Ver perfil no LinkedIn
            </a>
          </div>
        </div>

        <p>
          Engenheiro, Sysadmin e docente nas áreas de eletrônica, mecânica e
          informática. Em eletrônica, seus interesses são projetos e
          microcontroladores; em mecânica, metrologia e fabricação mecânica;
          e em informática, infraestrutura de redes, administração de
          sistemas livres (Linux), segurança da informação, internet das
          coisas, desenvolvimento ágil e DevOps.
        </p>
        <p>
          Já atuou como mecânico e técnico de manutenção na indústria, teve
          duas empresas não oficiais na área de diversões eletrônicas e
          hardware, e trabalhou profissionalmente em TI por seis meses
          durante o estágio da engenharia, com suporte técnico. No IFSP -
          Campus Guarulhos, foi coordenador de TI da instituição.
        </p>
        <p>
          Para se manter atualizado, participa de eventos como Roadsec,
          Campus Party e TDC, além de acompanhar comunidades como o Papo de
          Sysadmin e o Dumont Hackerspace. Também está envolvido na
          organização de dois grandes eventos: a Feira de Ciências e
          Engenharia de Guarulhos e a Exatecca.
        </p>

        <div class="missions">
          <h4>Missões</h4>
          <ul class="missions-list">
            <li>
              <i class="fas fa-bridge"></i>
              Diminuir o abismo entre o mundo acadêmico e o mundo real de
              trabalho.
            </li>
            <li>
              <i class="fas fa-comments"></i>
              Ser um explicador ou decodificador de conhecimentos técnicos
              complicados em algo didático.
            </li>
            <li>
              <i class="fas fa-lightbulb"></i>
              Mostrar que a tecnologia existe para ajudar e mudar a vida das
              pessoas.
            </li>
          </ul>
        </div>
      </div>
    </section>
  </main>

  <footer id="contato">
    <img src="./img/logoIF.png" alt="Logo Vertical IFSP" class="footer-logo" />
  
  
  </footer>

  <script src="./js/script.js"></script>
</body>

</html>
