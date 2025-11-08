# PADRÃO DE API (Lumen)

Este repositório é um esqueleto de API em Lumen com autenticação JWT pronta e endpoints básicos para autenticação/usuário conforme o OpenAPI fornecido. O objetivo é fornecer um ponto de partida leve com migrações e seed para a tabela `usuario`.

Resumo rápido dos endpoints
- POST /api/login — Autenticar usuário (sem token)
- GET /api/usuario — Retorna lista de usuários (protegido por JWT)
- GET /api/usuario/{id} — Retorna usuário por ID (protegido por JWT)

OpenAPI (resumo)
- Autenticação via Bearer JWT (securitySchemes: bearerAuth)
- /api/login não exige token
- Respostas exemplificadas conforme especificação (token em `token`, dados do usuário em `dados`)

Pré-requisitos
- PHP >= 8.0 (ajuste conforme versão alvo do projeto)
- Composer
- Extensões PHP comuns: pdo, pdo_mysql, openssl, mbstring, json
- Banco de dados: MySQL/MariaDB (ou outro suportado pelo Eloquent)
- (Opcional) Docker / docker-compose


## Rodar projeto

O projeto já esta pronto para usar localmente, pode subir apenas com 
```
    docker compose up
```

O seed e as migrations estão preparados para subir localmente de acordo com o seu env.

```
    php artisan migrate
    php artisan db:seed
```

## Rotas e exemplos de uso

1) Login
- URL: POST /api/login
- Body (JSON):
  ```json
  {
    "email": "douglas.junior@tintasbrazilian.com.br",
    "password": "senha123"
  }
  ```
- Resposta (200 - exemplo):
  ```json
  {
    "status": true,
    "message": "Validação bem sucedida.",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "dados": {
      "id": 1,
      "nome": "PADRAO",
      "email": "douglas.junior@tintasbrazilian.com.br"
    }
  }
  ```

- Exemplo curl:
  ```bash
  curl -X POST http://localhost:8000/api/login \
    -H "Content-Type: application/json" \
    -d '{"email":"douglas.junior@tintasbrazilian.com.br","password":"senha123"}'
  ```

2) Listar usuários
- URL: GET /api/usuario
- Headers:
  - Authorization: Bearer <token>
- Resposta (200 - exemplo):
  ```json
  [
    {
      "id": 1,
      "nome": "PADRAO",
      "email": "douglas.junior@tintasbrazilian.com.br",
      "created_at": "2025-04-04T14:26:48.240000Z",
      "updated_at": "2025-04-04T14:26:48.240000Z"
    }
  ]
  ```

3) Recuperar usuário por ID
- URL: GET /api/usuario/{id}
- Headers:
  - Authorization: Bearer <token>
- Resposta (200 - exemplo):
  ```json
  {
    "status": true,
    "message": "Dados recuperados com sucesso.",
    "dados": {
      "id": "1",
      "nome": "PADRAO",
      "created_at": "2025-04-04 14:26:48.240",
      "updated_at": "2025-04-04 14:26:48.240"
    }
  }
  ```
- Resposta (404 - exemplo):
  ```json
  {
    "status": false,
    "message": "Não foi encontrado usuario para este ID",
    "dados": null
  }
  ```


O que há no esqueleto (expectativas)
- Implementação básica de autenticação com JWT.
- Controllers e rotas para login e usuários.
- Migrations e seeders (caso já incluídos — se não, os snippets acima servem de referência).
- Arquivos de configuração do Lumen (bootstrap/app.php, routes/web.php ou routes/api.php conforme convenção do projeto).

Contato
- Autor / Maintainer: djsilvajr
---

Este README fornece instruções para começar rapidamente com o esqueleto em Lumen e os endpoints descritos pelo OpenAPI. Siga os exemplos de migrations/seeders acima para popular a tabela `usuarios` e testar os endpoints.