# bgomesweb — Portfólio profissional

Site de apresentação profissional de Bruno Gomes da Silva.

## Stack

- **Backend:** PHP 8.5 + Laravel 13 (API REST em `backend/`)
- **Frontend:** Vue.js 3 + TypeScript + Vite + Tailwind CSS (SPA em `frontend/`)
- **Banco de dados:** MariaDB 11
- **Infra:** Docker Compose (nginx como gateway, php-fpm, build do frontend, phpMyAdmin)

## Como rodar

```bash
docker compose up -d --build
```

Isso vai:
1. Subir o MariaDB e aguardar ficar saudável.
2. Buildar o frontend Vue (`npm ci && npm run build`) para arquivos estáticos.
3. Buildar e subir o backend Laravel, rodando automaticamente `migrate` + `db:seed` (dados do currículo) + `storage:link`.
4. Subir o nginx servindo o SPA na raiz, a API Laravel em `/api` e os PDFs (currículo/certificado) em `/storage`.

## Endereços

| Serviço          | URL                            |
|-------------------|---------------------------------|
| Site              | http://localhost:8090           |
| API               | http://localhost:8090/api/portfolio |
| phpMyAdmin        | http://localhost:8091           |
| MariaDB (host)    | localhost:3308                  |

As portas podem ser alteradas no arquivo `.env` da raiz (`HTTP_PORT`, `DB_PORT`, `PHPMYADMIN_PORT`) caso conflitem com outros serviços já rodando na sua máquina.

## Comandos úteis

```bash
docker compose logs -f backend      # logs do Laravel
docker compose exec backend php artisan tinker
docker compose down                 # parar tudo
docker compose down -v              # parar e apagar os dados do banco
```

## Atualizando o conteúdo do currículo

Os dados (perfil, experiências, formação, certificações, skills, projetos) ficam em
`backend/database/seeders/PortfolioSeeder.php`. Após editar, rode:

```bash
docker compose exec backend php artisan db:seed --force
```

## WhatsApp

O botão flutuante e os CTAs usam o número configurado em `frontend/.env`
(`VITE_WHATSAPP_NUMBER`) e o telefone salvo no perfil (tabela `profiles`).
