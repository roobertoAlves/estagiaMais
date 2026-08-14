<?php
namespace App\Controllers;

/**
 * PagesController — única área pública do ESTAGIA+.
 */
class PagesController extends Controller
{
    public function home()
    {
        $title = 'ESTAGIA+ — O primeiro + da sua carreira!';
        $description = 'Uma experiência acadêmica que aproxima estudantes, professores e empresas por meio de oportunidades reais.';

        $team_members = [
            [
                'id' => 'arthur',
                'name' => 'Arthur de Oliveira Mendes Sacramento',
                'short_name' => 'Arthur Sacramento',
                'role' => 'Desenvolvedor Full-Stack & IoT',
                'eyebrow' => 'Produto & automação',
                'bio' => 'Especialista em automações, aplicativos e soluções conectadas que transformam problemas complexos em experiências simples.',
                'strengths' => ['Visão de produto', 'Automações inteligentes', 'Integração entre hardware e software'],
                'skills' => ['Python', 'PHP', 'JavaScript', 'IoT'],
                'image' => 'images/avatars/arthur.png',
                'email' => 'oarthursacra@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/sacrarthur?utm_source=share_via&utm_content=profile&utm_medium=member_ios',
                'github' => 'https://github.com/osacra',
                'portfolio' => null,
            ],
            [
                'id' => 'jose-roberto',
                'name' => 'José Roberto Junior Alves Damasceno',
                'short_name' => 'José Roberto',
                'role' => 'Desenvolvedor Web & Games',
                'eyebrow' => 'Experiências interativas',
                'bio' => 'Desenvolvedor com experiência em jogos e soluções web modernas, atento à performance, narrativa e usabilidade.',
                'strengths' => ['Pensamento sistêmico', 'Prototipação rápida', 'Experiências interativas'],
                'skills' => ['React', 'Node.js', 'Unity'],
                'image' => 'images/avatars/roberto.png',
                'email' => 'jbetodamasceno@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/beto-damasceno/',
                'github' => 'https://github.com/roobertoAlves?tab=repositories',
                'portfolio' => 'https://example.com/portfolio-em-construcao',
            ],
            [
                'id' => 'pedro-miguel',
                'name' => 'Pedro Miguel Dias Oliveira',
                'short_name' => 'Pedro Miguel',
                'role' => 'Especialista Cloud & Segurança',
                'eyebrow' => 'Infraestrutura & proteção',
                'bio' => 'Profissional certificado em Oracle Cloud e Cisco, com foco em cibersegurança, redes e arquitetura resiliente.',
                'strengths' => ['Arquitetura em nuvem', 'Cibersegurança', 'Confiabilidade operacional'],
                'skills' => ['Oracle Cloud', 'Cisco Networking', 'Cibersegurança'],
                'image' => 'images/avatars/pedroMiguel.png',
                'email' => 'pmd.oliveira.t@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/pedromdiaso?utm_source=share_via&utm_content=profile&utm_medium=member_android',
                'github' => 'https://github.com/PedrinhoMiguel',
                'portfolio' => null,
            ],
            [
                'id' => 'pedro-henri',
                'name' => 'Pedro Henri Gois da Silva',
                'short_name' => 'Pedro Henri',
                'role' => 'Desenvolvedor Web & Análise',
                'eyebrow' => 'Dados & estrutura',
                'bio' => 'Especialista em engenharia de requisitos e desenvolvimento de aplicações web estruturadas para resolver necessidades reais.',
                'strengths' => ['Engenharia de requisitos', 'Raciocínio analítico', 'Desenvolvimento estruturado'],
                'skills' => ['Python', 'JavaScript', 'TypeScript'],
                'image' => 'images/avatars/pedro.png',
                'email' => 'pedrohenre@hotmail.com',
                'linkedin' => 'https://www.linkedin.com/in/pedrohenrigois/',
                'github' => 'https://github.com/P-Hwe',
                'portfolio' => null,
            ],
            [
                'id' => 'rodrigo',
                'name' => 'Rodrigo Querino do Amaral',
                'short_name' => 'Rodrigo Querino',
                'role' => 'Developer & Growth Marketing',
                'eyebrow' => 'Crescimento & experiência',
                'bio' => 'Atua entre tecnologia, marketing digital e design de interfaces para criar páginas claras, acessíveis e orientadas a resultado.',
                'strengths' => ['Comunicação visual', 'Landing pages', 'Usabilidade e conversão'],
                'skills' => ['HTML/CSS', 'No-code tools', 'Landing pages'],
                'image' => 'images/avatars/rodrigo.png',
                'email' => 'rq.amaral06@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/rodrigo-querino-125771264',
                'github' => 'https://github.com/pgsharpro-bot',
                'portfolio' => null,
            ],
        ];

        echo $this->render('layouts/app', [
            'title' => $title,
            'description' => $description,
            'page' => 'home',
            'team_members' => $team_members,
        ]);
    }
}
