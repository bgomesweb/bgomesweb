<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Certification;
use App\Models\ComplementaryCertificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SkillGroup;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedProfile();
        $this->seedExperiences();
        $this->seedEducations();
        $this->seedCertifications();
        $this->seedComplementaryCertificates();
        $this->seedAwards();
        $this->seedSkillGroups();
        $this->seedProjects();
    }

    private function seedProfile(): void
    {
        Profile::query()->updateOrCreate(
            ['email' => 'bgomesweb@gmail.com'],
            [
                'name' => 'Bruno Gomes da Silva',
                'title' => 'Tech Lead & Desenvolvedor Backend PHP | Adobe Commerce (Magento 2) | Laravel | Adobe Certified Expert',
                'summary' => 'Desenvolvedor de Software e Tech Lead com mais de 10 anos de experiência em desenvolvimento web, especializado em PHP, Adobe Commerce (Magento 2) e Laravel. Adobe Certified Expert - Adobe Commerce Developer, com histórico consolidado na liderança de equipes técnicas, definição de arquitetura de software e entrega de soluções de e-commerce escaláveis, robustas e de alta performance. Experiência em desenvolvimento full stack (Vue.js, React, JavaScript, HTML5, CSS3), integrações via APIs REST e GraphQL, bancos de dados relacionais (MySQL, PostgreSQL, MariaDB) e boas práticas de engenharia de software (Clean Code, SOLID, TDD, Design Patterns, Clean Architecture). Atuação em metodologias ágeis (Scrum/Kanban), Git/Gitflow, CI/CD e DevOps, com foco em performance, escalabilidade e geração de valor para o negócio.',
                'location' => 'Barueri, SP, Brasil',
                'phone' => '(19) 99897-0090',
                'whatsapp' => '5519998970090',
                'linkedin_url' => 'https://www.linkedin.com/in/bgomesweb',
                'github_url' => 'https://github.com/bgomesweb',
                'resume_path' => 'documents/Bruno_Gomes_Curriculo.pdf',
            ],
        );
    }

    private function seedExperiences(): void
    {
        $experiences = [
            [
                'company' => 'Digital Hub',
                'role' => 'Desenvolvedor Backend / Tech Lead',
                'start_date' => '2024-09-01',
                'end_date' => null,
                'is_current' => true,
                'highlights' => [
                    'Atuo como Tech Lead e Desenvolvedor Backend em Adobe Commerce (Magento 2) com PHP, liderando equipe técnica, definindo arquitetura e garantindo entregas de soluções de e-commerce escaláveis, robustas e de alta performance.',
                    'Responsável pela gestão de projetos, planejamento de demandas e acompanhamento de prazos, alinhando times multidisciplinares com foco em eficiência operacional e resultado de negócio.',
                    'Desenvolvo soluções customizadas (plugins, observers, preferences) e integrações com APIs, aplicando Clean Code, SOLID e TDD para garantir qualidade e manutenibilidade.',
                    'Atuação complementar com Laravel no backend e Vue.js no frontend, contribuindo para aplicações modernas com foco em performance e experiência do usuário.',
                ],
            ],
            [
                'company' => 'Webjump',
                'role' => 'Engenheiro de Software / Desenvolvedor Backend / Tech Lead',
                'start_date' => '2023-06-01',
                'end_date' => '2024-09-01',
                'is_current' => false,
                'highlights' => [
                    'Liderei times técnicos em projetos de grande porte, conduzindo o desenvolvimento backend em Adobe Commerce (Magento 2) com PHP e definindo arquitetura e especificações técnicas.',
                    'Desenvolvi módulos, plugins, observers e preferences customizados em Magento 2, além de integrações com APIs REST e GraphQL.',
                    'Apliquei boas práticas de engenharia de software (Clean Code, SOLID, TDD) e conduzi projetos de migração para Magento 2, garantindo estabilidade e eficiência em produção.',
                    'Atuação complementar com Laravel e Vue.js no desenvolvimento de aplicações modernas alinhadas às necessidades do negócio.',
                ],
            ],
            [
                'company' => 'JN2 E-Commerce Expert',
                'role' => 'Desenvolvedor Backend',
                'start_date' => '2021-07-01',
                'end_date' => '2022-03-01',
                'is_current' => false,
                'highlights' => [
                    'Desenvolvi soluções de e-commerce em Adobe Commerce (Magento 2) com PHP, com foco em performance, qualidade e manutenção.',
                    'Criei plugins, observers, preferences e integrações com APIs, seguindo padrões PSR e boas práticas de Clean Code.',
                    'Realizei suporte e manutenção de Magento 1 e 2, correção de bugs, otimização de desempenho e processos de migração de plataforma.',
                ],
            ],
            [
                'company' => 'Claretiano Centro Universitário',
                'role' => 'Técnico em Sistemas / Desenvolvedor Web',
                'start_date' => '2010-05-01',
                'end_date' => '2021-06-01',
                'is_current' => false,
                'highlights' => [
                    'Atuação full stack com PHP, Laravel, MySQL, Vue.js, HTML5, CSS3, Bootstrap e JavaScript no desenvolvimento de soluções completas e de alta performance.',
                    'Desenvolvimento e manutenção de sistemas com foco em interfaces intuitivas, funcionalidades dinâmicas e otimização de desempenho.',
                    'Aplicação de Clean Code, padrões PSR e metodologias ágeis (Scrum/Kanban) para garantir entregas consistentes.',
                ],
            ],
        ];

        foreach ($experiences as $index => $experience) {
            Experience::query()->updateOrCreate(
                ['company' => $experience['company'], 'role' => $experience['role']],
                [...$experience, 'sort_order' => $index],
            );
        }
    }

    private function seedEducations(): void
    {
        $educations = [
            [
                'institution' => 'USP/Ezalq',
                'course' => 'MBA em Data Science, Inteligência Artificial e Analytics',
                'start_date' => '2026-05-01',
                'end_date' => '2027-11-01',
                'status' => 'Cursando',
                'description' => 'Foco em Big Data, Machine Learning, Business Intelligence e tomada de decisão orientada a dados.',
            ],
            [
                'institution' => 'USP/Ezalq',
                'course' => 'MBA em Engenharia de Software',
                'start_date' => '2023-10-01',
                'end_date' => '2025-07-01',
                'status' => 'Concluído',
                'description' => 'Backend, Frontend, Cloud Computing, DevOps, Design Patterns, Microsserviços, APIs, Segurança e Kubernetes. Média final: 9,44.',
            ],
            [
                'institution' => 'Centro Universitário Claretiano',
                'course' => 'Pós-graduação em Banco de Dados',
                'start_date' => '2018-02-01',
                'end_date' => '2018-12-01',
                'status' => 'Concluído',
                'description' => 'Modelagem, administração e otimização de sistemas relacionais e não relacionais, performance e segurança da informação.',
            ],
            [
                'institution' => 'UFSCar',
                'course' => 'Pós-graduação em Desenvolvimento Web',
                'start_date' => '2016-02-01',
                'end_date' => '2016-12-01',
                'status' => 'Concluído',
                'description' => 'Práticas ágeis, arquitetura, testes, DevOps e Machine Learning. Prêmio de Melhor Artigo no IX WAIHCWS / XVII Simpósio Brasileiro sobre Fatores Humanos em Sistemas Computacionais.',
            ],
            [
                'institution' => 'Centro Universitário Claretiano',
                'course' => 'Bacharel em Sistemas de Informação',
                'start_date' => '2013-07-01',
                'end_date' => '2015-12-01',
                'status' => 'Concluído',
                'description' => 'Desenvolvimento de software, análise de sistemas, lógica de programação, estruturas de dados e engenharia de software.',
            ],
            [
                'institution' => 'Centro Universitário Claretiano',
                'course' => 'Tecnólogo Superior em Redes de Computadores',
                'start_date' => '2011-02-01',
                'end_date' => '2013-06-01',
                'status' => 'Concluído',
                'description' => 'Infraestrutura, administração e segurança de redes, protocolos e virtualização.',
            ],
        ];

        foreach ($educations as $index => $education) {
            Education::query()->updateOrCreate(
                ['institution' => $education['institution'], 'course' => $education['course']],
                [...$education, 'sort_order' => $index],
            );
        }
    }

    private function seedCertifications(): void
    {
        Certification::query()->updateOrCreate(
            ['name' => 'Adobe Certified Expert - Adobe Commerce Developer'],
            [
                'issuer' => 'Adobe Digital Experience Certification Program',
                'issued_at' => '2026-06-11',
                'expires_at' => '2028-06-11',
                'credential_url' => null,
                'file_path' => 'documents/adobe-certified-expert-adobe-commerce-developer.pdf',
                'featured' => true,
                'description' => 'Certificação internacional que reconhece domínio técnico avançado em customização, arquitetura e desenvolvimento de soluções na plataforma Adobe Commerce (Magento 2) — incluindo módulos, APIs, performance e boas práticas de mercado.',
                'sort_order' => 0,
            ],
        );
    }

    private function seedComplementaryCertificates(): void
    {
        $certificates = [
            ['name' => 'Gen AI Technical Certification', 'issuer' => 'Compass Uol'],
            ['name' => 'PHP Composer: Dependências, Autoload e Publicação', 'issuer' => 'Alura'],
            ['name' => 'PHP e Domain-Driven Design: Apresentando Conceitos', 'issuer' => 'Alura'],
            ['name' => 'Microsserviços: Padrões de Projetos', 'issuer' => 'Alura'],
            ['name' => 'Governança de TI: Modelo de Gestão, Arquitetura e Inovação', 'issuer' => 'Alura'],
            ['name' => 'Comunicação Assertiva: Reduzindo Conflitos e Frustrações', 'issuer' => 'Alura'],
            ['name' => 'Negociação para Líderes', 'issuer' => 'Alura'],
            ['name' => 'Iniciando Desenvolvimento em Magento 2', 'issuer' => 'Magedin Technology'],
            ['name' => 'Magento Checkout Pro', 'issuer' => 'Mercado Livre'],
            ['name' => 'Full Stack PHP Developer', 'issuer' => 'Upinside Treinamentos'],
            ['name' => 'Laravel Developer', 'issuer' => 'Upinside Treinamentos'],
            ['name' => 'Elementor Builder (WordPress)', 'issuer' => 'Upinside Treinamentos'],
            ['name' => 'DevTools Essentials', 'issuer' => 'Upinside Treinamentos'],
            ['name' => 'HTML5 e CSS3', 'issuer' => 'Upinside Treinamentos'],
        ];

        foreach ($certificates as $index => $certificate) {
            ComplementaryCertificate::query()->updateOrCreate(
                ['name' => $certificate['name'], 'issuer' => $certificate['issuer']],
                [...$certificate, 'sort_order' => $index],
            );
        }
    }

    private function seedAwards(): void
    {
        Award::query()->updateOrCreate(
            ['title' => 'Melhor Artigo — IX WAIHCWS / XVII Simpósio Brasileiro sobre Fatores Humanos em Sistemas Computacionais'],
            [
                'description' => 'Prêmio de Melhor Artigo no IX Workshop sobre Aspectos da Interação Humano-Computador para Web Social (WAIHCWS), realizado durante o XVII Simpósio Brasileiro sobre Fatores Humanos em Sistemas Computacionais.',
                'sort_order' => 0,
            ],
        );
    }

    private function seedSkillGroups(): void
    {
        $skillGroups = [
            'Linguagens & Frameworks' => ['PHP', 'Laravel (Eloquent ORM, Migrations)', 'Adobe Commerce / Magento 2', 'WordPress'],
            'Frontend' => ['HTML5', 'CSS3', 'JavaScript (ES6+)', 'jQuery', 'Bootstrap', 'Tailwind CSS', 'Vue.js', 'React'],
            'APIs & Integrações' => ['RESTful APIs', 'GraphQL', 'Integração de sistemas e plugins customizados'],
            'Banco de Dados' => ['MySQL', 'MariaDB', 'PostgreSQL'],
            'Arquitetura & Boas Práticas' => ['Clean Code', 'SOLID', 'TDD', 'Design Patterns', 'Clean Architecture', 'Microsserviços', 'DDD'],
            'DevOps & Ferramentas' => ['Git', 'Gitflow', 'Bitbucket', 'CI/CD', 'Docker', 'Kubernetes', 'Infraestrutura como Código (IaC)'],
            'Metodologias & Gestão' => ['Scrum', 'Kanban', 'Code Review', 'Liderança Técnica (Tech Lead)', 'Gestão de Projetos'],
        ];

        $groupIndex = 0;

        foreach ($skillGroups as $category => $skills) {
            $skillGroup = SkillGroup::query()->updateOrCreate(
                ['category' => $category],
                ['sort_order' => $groupIndex],
            );

            foreach ($skills as $skillIndex => $skillName) {
                $skillGroup->skills()->updateOrCreate(
                    ['name' => $skillName],
                    ['sort_order' => $skillIndex],
                );
            }

            $groupIndex++;
        }
    }

    private function seedProjects(): void
    {
        $projects = [
            [
                'name' => 'Portfólio Pessoal — Full Stack',
                'description' => 'Site de apresentação profissional desenvolvido com Laravel 13 (API REST), Vue.js 3 + TypeScript (SPA) e MariaDB, totalmente containerizado com Docker Compose.',
                'technologies' => ['Laravel 13', 'Vue.js 3', 'TypeScript', 'MariaDB', 'Docker', 'Tailwind CSS'],
                'url' => null,
                'repository_url' => 'https://github.com/bgomesweb',
            ],
            [
                'name' => 'Soluções de E-commerce em Adobe Commerce (Magento 2)',
                'description' => 'Desenvolvimento de plugins, observers, preferences e integrações via API REST/GraphQL para plataformas de e-commerce de grande porte, aplicando Clean Code, SOLID e TDD.',
                'technologies' => ['PHP', 'Adobe Commerce', 'Magento 2', 'REST', 'GraphQL'],
                'url' => null,
                'repository_url' => 'https://github.com/bgomesweb/modules-magento2',
            ],
            [
                'name' => 'Aplicações Full Stack com Laravel + Vue.js',
                'description' => 'Backend em Laravel com Eloquent ORM e frontend reativo em Vue.js, com foco em performance, experiência do usuário e arquitetura escalável orientada a boas práticas.',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Clean Architecture'],
                'url' => null,
                'repository_url' => 'https://github.com/bgomesweb/cartoleirao',
            ],
            [
                'name' => 'JJSports',
                'description' => 'Plataforma web desenvolvida com PHP 7.5, HTML5, JavaScript e Tailwind CSS.',
                'technologies' => ['PHP 7.5', 'Tailwind CSS', 'HTML5', 'JavaScript'],
                'url' => null,
                'repository_url' => 'https://github.com/bgomesweb/jjsports',
            ],
            [
                'name' => 'Roncoli',
                'description' => 'Plataforma web desenvolvida com PHP 7.5, HTML5, JavaScript e Tailwind CSS, com integração com o Itaú para pagamentos via cartão e boleto.',
                'technologies' => ['PHP 7.5', 'Tailwind CSS', 'HTML5', 'JavaScript', 'Integração Itaú (cartão e boleto)'],
                'url' => null,
                'repository_url' => 'https://github.com/bgomesweb/roncoli',
            ],
            [
                'name' => 'Go-live e Sustentação Adobe Commerce — Chevrolet Seminovos, BF Casa e Adias',
                'description' => 'Participação em projetos de e-commerce Adobe Commerce (Magento 2) do zero ao go-live e sustentação contínua, incluindo desenvolvimento de módulos customizados, integrações complexas e resolução de bugs, para chevroletseminovos.com.br, bfcasa.com.br e adias.com.br.',
                'technologies' => ['Magento 2', 'Adobe Commerce', 'PHP', 'Módulos customizados'],
                'url' => 'https://chevroletseminovos.com.br/',
                'repository_url' => null,
            ],
            [
                'name' => 'Atualização de Versão Magento — ASUS (Brasil, Peru, Colômbia e Chile)',
                'description' => 'Atuação na ASUS Brasil, Peru, Colômbia e Chile na atualização de versão do Magento 2.4.4 para 2.4.8-p5, com foco em compatibilidade, segurança e performance da plataforma.',
                'technologies' => ['Magento 2', 'Adobe Commerce', 'PHP', 'Upgrade de versão'],
                'url' => 'https://www.asus.com/br',
                'repository_url' => null,
            ],
            [
                'name' => 'Sustentação Adobe Commerce — Correção de Bugs e Novas Features',
                'description' => 'Projetos de sustentação em Adobe Commerce (Magento 2) com correção de bugs e desenvolvimento de novas features para caldeiraomistico.com.br, cumbucaboa.com.br, eletrofrigor.com.br, madeiranit.com.br e nivea.com.br.',
                'technologies' => ['Magento 2', 'Adobe Commerce', 'PHP', 'Manutenção evolutiva'],
                'url' => 'https://www.nivea.com.br/',
                'repository_url' => null,
            ],
        ];

        foreach ($projects as $index => $project) {
            Project::query()->updateOrCreate(
                ['name' => $project['name']],
                [...$project, 'sort_order' => $index],
            );
        }
    }
}
