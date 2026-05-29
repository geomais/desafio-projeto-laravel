# GeoProjetoDigital

API REST em Laravel/PHP que simula uma plataforma de aprovação digital de projetos imobiliários e urbanísticos. Possibilitando consultar projetos, status de análise e documentos obrigatórios usando autenticação fake por header.

## Contexto funcional

Empresas e profissionais cadastram projetos digitais para análise, e cada projeto pertence obrigatoriamente a uma empresa.

A visualização dos projetos deve respeitar o perfil do usuário autenticado:

- Usuários comuns visualizam apenas os projetos vinculados à própria empresa.
- Usuários com perfil admin podem visualizar projetos de todas as empresas.

Cada projeto possui documentos obrigatórios que precisam ser enviados para que a análise possa avançar. Por isso, o status exibido na interface do projeto pode ser diferente do status real armazenado no projeto.

A regra de exibição do status é:

- Se o projeto estiver com status real "em análise", mas ainda possuir algum documento obrigatório pendente, exibir com o status "documentos pendentes".
- Se todos os documentos obrigatórios estiverem enviados, a listagem deve exibir o status real do projeto.
- Para projetos que não estejam "em análise", deve então exibir o status real do projeto.

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

Foram reportadas duas inconsistências no comportamento de visualização de projetos digitais.

A primeira está relacionada ao contexto do usuário. Em alguns fluxos, os projetos parecem respeitar corretamente o usuário autenticado, mas há suspeita de que esse comportamento não esteja consistente em todas as formas de consulta.

A segunda está relacionada ao status exibido. Em alguns fluxos, o status parece seguir corretamente as regras de exibição, considerando também a situação dos documentos obrigatórios, mas há suspeita de divergência em outras consultas do projeto.

O objetivo é investigar os fluxos, identificar possíveis causas e propor uma correção.

## Fluxo Esperado Da Aplicação

A tela de listagem consumiria `GET /projects`. A tela de detalhe consumiria `GET /projects/{id}`. A aba de documentos consumiria `GET /projects/{id}/documents`. O usuário autenticado é identificado pelo header `x-user-id`.
