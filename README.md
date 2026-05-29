# GeoApproval Laravel

API REST em Laravel/PHP que simula uma plataforma de aprovação digital de projetos imobiliários e urbanísticos. Empresas e profissionais consultam projetos, status de análise e documentos obrigatórios usando autenticação fake por header.

## Como Rodar Com Docker

Pré-requisito: Docker com Docker Compose.

```bash
docker compose up --build
```

A API ficará disponível em:

```text
http://localhost:8000/api
```

Comandos úteis dentro do container:

```bash
docker compose run --rm app composer install
docker compose run --rm app php artisan route:list
docker compose run --rm app php artisan serve --host=0.0.0.0 --port=8000
```

## Build E Check Básico

```bash
docker compose run --rm app composer install
docker compose run --rm app php artisan route:list
```

## Execução Local Alternativa

Caso PHP 8.3+ e Composer estejam instalados no host:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve --host=0.0.0.0 --port=8000
```

## Usuários Disponíveis

Use o header `x-user-id` nas rotas autenticadas.

| ID | Perfil | Empresa |
| --- | --- | --- |
| `user-north` | `USER` | Construtora Norte |
| `user-south` | `USER` | Urbaniza Sul |
| `user-admin` | `ADMIN_GLOBAL` | Todas |

## Endpoints

| Método | Rota | Autenticação |
| --- | --- | --- |
| `GET` | `/api/health` | Não |
| `GET` | `/api/projects` | Sim |
| `GET` | `/api/projects/{id}` | Sim |
| `GET` | `/api/projects/{id}/documents` | Sim |

## Exemplos Com Curl

Health check:

```bash
curl http://localhost:8000/api/health
```

Listar projetos como usuário da Construtora Norte:

```bash
curl -H "x-user-id: user-north" http://localhost:8000/api/projects
```

Listar projetos como usuário da Urbaniza Sul:

```bash
curl -H "x-user-id: user-south" http://localhost:8000/api/projects
```

Listar projetos como administrador global:

```bash
curl -H "x-user-id: user-admin" http://localhost:8000/api/projects
```

Buscar detalhe de projeto:

```bash
curl -H "x-user-id: user-north" http://localhost:8000/api/projects/project-palmeiras
```

Listar documentos de projeto:

```bash
curl -H "x-user-id: user-north" http://localhost:8000/api/projects/project-palmeiras/documents
```

Também existe o arquivo `requests.http` na raiz para executar as chamadas pela extensão REST Client do VS Code.

## Cenário Reportado

Foi reportada uma inconsistência no comportamento de visualização de projetos digitais. A listagem de projetos parece respeitar o contexto do usuário autenticado e apresenta uma visão consolidada do status, mas há suspeita de comportamento divergente ao acessar detalhes diretamente pela API. O objetivo é investigar o fluxo, identificar possíveis causas e propor uma correção.

## Fluxo Esperado Da Aplicação

A tela de listagem consumiria `GET /projects`. A tela de detalhe consumiria `GET /projects/{id}`. A aba de documentos consumiria `GET /projects/{id}/documents`. O usuário autenticado é identificado pelo header `x-user-id`.
