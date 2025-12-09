<?php
namespace App\Controllers;

/**
 * PagesController - Gerencia páginas públicas
 */
class PagesController extends Controller {
    
    public function home() {
        $csrf_token = $this->generateCsrfToken();
        $title = "ESTAGIA+ — O primeiro + da sua carreira!";
        $description = "Plataforma de estágios do IFSP Guarulhos centralizando oportunidades e conectando alunos com empresas.";
        
        // Dados dos membros da equipe
        $team_members = [
            [
                'id' => 1,
                'name' => 'Arthur de Oliveira Mendes Sacramento',
                'role' => 'Desenvolvedor Full-Stack & IoT',
                'bio' => 'Especialista em desenvolvimento de automações, criação de aplicativos e soluções tecnológicas.',
                'image' => 'arthur.png',
                'hard_skills' => ['Python', 'PHP', 'JavaScript', 'C/C++', 'IoT (ESP32)', 'Firebase'],
                'soft_skills' => ['Raciocínio Lógico', 'Atenção a Detalhes', 'Aprendizado Rápido', 'Persistência']
            ],
            [
                'id' => 2,
                'name' => 'José Roberto Junior Alves Damasceno',
                'role' => 'Desenvolvedor Web & Games',
                'bio' => '5 anos de experiência em desenvolvimento de jogos e soluções web modernas.',
                'image' => 'roberto.png',
                'hard_skills' => ['React', 'Node.js', 'Unity', 'C#', 'TypeScript', 'Blender'],
                'soft_skills' => ['Comunicação Clara', 'Criatividade', 'Organização', 'Resiliência']
            ],
            [
                'id' => 3,
                'name' => 'Pedro Miguel Dias Oliveira',
                'role' => 'Especialista Cloud & Segurança',
                'bio' => 'Certificado em Oracle Cloud e Cisco, com foco em cibersegurança e arquitetura em nuvem.',
                'image' => 'pedroMiguel.png',
                'hard_skills' => ['Oracle Cloud', 'Cisco Networking', 'Cibersegurança', 'MySQL', 'JavaScript'],
                'soft_skills' => ['Pensamento Analítico', 'Foco', 'Dedicação', 'Organização']
            ],
            [
                'id' => 4,
                'name' => 'Pedro Henri Gois da Silva',
                'role' => 'Desenvolvedor Web & Análise',
                'bio' => 'Especialista em engenharia de requisitos e desenvolvimento de aplicações web estruturadas.',
                'image' => 'pedro.png',
                'hard_skills' => ['Python', 'JavaScript', 'TypeScript', 'HTML5/CSS3', 'MySQL'],
                'soft_skills' => ['Planejamento', 'Autonomia', 'Adaptabilidade', 'Empatia']
            ],
            [
                'id' => 5,
                'name' => 'Rodrigo Querino do Amaral',
                'role' => 'Developer & Growth Marketing',
                'bio' => 'Experiência em marketing digital, landing pages e interface com foco em usabilidade.',
                'image' => 'rodrigo.png',
                'hard_skills' => ['HTML/CSS', 'No-code Tools', 'Landing Pages', 'Marketing Digital'],
                'soft_skills' => ['Comunicação', 'Criatividade', 'Proatividade', 'Adaptabilidade']
            ],
            [
                'id' => 6,
                'name' => 'Robert Vieira Souza',
                'role' => 'Full-Stack Developer',
                'bio' => 'Experiência em React, React Native e desenvolvimento mobile com foco em qualidade.',
                'image' => 'robert.png',
                'hard_skills' => ['React', 'React Native', 'TypeScript', 'Node.js', 'Firebase'],
                'soft_skills' => ['Resiliência', 'Responsabilidade', 'Trabalho em Equipe', 'Atualização Contínua']
            ]
        ];
        
        echo $this->render('layouts/app', [
            'csrf_token' => $csrf_token,
            'title' => $title,
            'description' => $description,
            'page' => 'home',
            'team_members' => $team_members
        ]);
    }

    public function about() {
        $csrf_token = $this->generateCsrfToken();
        $title = "Sobre - ESTAGIA+";
        
        echo $this->render('layouts/app', [
            'csrf_token' => $csrf_token,
            'title' => $title,
            'page' => 'about'
        ]);
    }
}
?>
