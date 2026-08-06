# IPI — Ambiente Docker para o time de desenvolvimento

Este projeto pode rodar em Docker, do jeito que está — qualquer pessoa do time
clona o repositório, roda dois comandos e tem o site (com o conteúdo real já
carregado: páginas, menu, textos) rodando na própria máquina, em qualquer
sistema operacional com Docker instalado.

## Pré-requisito

[Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado e aberto (Windows, Mac ou Linux).

## Subir o ambiente

```bash
cp .env.example .env
docker compose up -d
```

Pronto. Acesse:

| Serviço | URL | Login |
|---|---|---|
| Site (WordPress) | http://localhost:8080 | — |
| Painel administrativo | http://localhost:8080/wp-admin | *ver nota abaixo* |
| phpMyAdmin (ver/editar o banco direto) | http://localhost:8081 | usuário `root`, senha `root` |

Para parar: `docker compose down` (o conteúdo do banco fica salvo; só sobe de novo com `docker compose up -d`).
Para apagar tudo e recomeçar do zero (perde os dados do banco): `docker compose down -v`.

## O que já vem pronto

O primeiro `docker compose up` importa automaticamente um dump (`docker/mysql-init/ipi-content.sql`) com o estado atual do site: páginas (Sobre, Corpo Clínico, FAQ, Contato), menu principal, tema ativo e dados do Personalizador (telefone, WhatsApp, endereço, Instagram). Ninguém do time precisa recriar isso manualmente.

**Login do wp-admin:** o dump não inclui usuários novos além do que já existia no ambiente Local original. Se você não tiver a senha desse usuário, crie um novo administrador direto no banco pelo phpMyAdmin, ou peça a senha para quem gerou o dump.

## O que é editável e onde

- **Tema (`app/public/wp-content/themes/ipi-theme/`)** — é a única pasta montada dentro do container. Qualquer edição em PHP/CSS/JS aparece no navegador imediatamente (só dar refresh), sem rebuild de imagem.
- **Conteúdo (páginas, menu, Personalizador)** — vive no banco de dados, dentro do container `db`. Para editar, use o `/wp-admin` normalmente, ou o phpMyAdmin para alterações diretas na base.
- **Core do WordPress** (`wp-admin/`, `wp-includes/` etc.) — **não** vem do repositório aqui; vem embutido na imagem oficial `wordpress:php8.2-apache`. Isso é proposital: mantém o ambiente Docker leve e sempre num core "limpo" e atualizado pela própria imagem, sem depender dos arquivos do core que estão versionados na pasta `app/public/` deste repositório (esses continuam existindo ali só para quem usa o Local by Flywheel).

## Atualizar o conteúdo semente (dump)

Se alguém mexer bastante no conteúdo pelo wp-admin e quiser que isso vire o novo "ponto de partida" para o time, gere um novo dump e substitua o arquivo:

```bash
docker compose exec db sh -c 'exec mysqldump -uroot -p"$MYSQL_ROOT_PASSWORD" --no-tablespaces --single-transaction "$MYSQL_DATABASE"' > docker/mysql-init/ipi-content.sql
```

Atenção: esse arquivo só é lido automaticamente na **primeira vez** que o volume do banco é criado. Quem já tem o ambiente rodando precisa recriar o volume (`docker compose down -v && docker compose up -d`) para receber o dump atualizado.

## Portas ocupadas / rodando junto com o Local by Flywheel

Se a porta 8080 ou 8081 já estiver em uso na sua máquina, mude no `.env` (ex.: `WORDPRESS_PORT=8090`) antes de subir. O Docker roda em paralelo ao Local by Flywheel sem conflito, porque usa portas diferentes (Local usa 80/443 e um MySQL próprio; aqui é tudo isolado dentro do Docker).

## Estrutura criada para isso

```
docker-compose.yml       # definição dos 3 serviços (wordpress, db, phpmyadmin)
.env.example             # modelo de variáveis — copie para .env
.env                     # sua config local (fora do Git)
docker/mysql-init/
  └── ipi-content.sql    # dump inicial com o conteúdo real do site
```
