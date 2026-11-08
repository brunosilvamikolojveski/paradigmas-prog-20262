### Setup do projeto

## Clonar repositório

```bash
git clone https://github.com/rafaelrotto/paradigmas-prog-20262.git
```

## Entrar na pasta do projeto
```bash
cd /paradigmas-prog-20262
```

## Instalar dependências

```bash
composer install --ignore-platform-reqs
```

## Copiar dados da env

```bash
cp .env.example .env
```


## Modificar dados do banco de dados na env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paradigmas-prog
DB_USERNAME=root
DB_PASSWORD=
```

## Rodar migrations
```bash
php artisan migrate
```

## Rodar aplicação
```bash
php artisan serve --port=8010
```

## API de cursos, turmas e matrículas (Docker)

As rotas de escrita e leitura de usuários, cursos e turmas exigem um token Sanctum. Faça login em `POST /api/login` com `email` e `password`, e envie o token retornado no cabeçalho `Authorization: Bearer <token>`.

### Cursos

- `GET /api/courses` lista cursos e turmas associadas. Aceita filtro opcional `?name=...`.
- `POST /api/courses` cria curso com `name` (obrigatório) e `description` (opcional).
- `GET /api/courses/{id}` consulta curso e suas turmas.
- `PUT /api/courses/{id}` atualiza curso usando os mesmos campos.
- `DELETE /api/courses/{id}` remove curso sem turmas associadas.

### Turmas

Todas as operações de turma agora recebem `course_id` além de `name` e `vacancies`. As respostas de `GET /api/classrooms` e `GET /api/classrooms/{id}` incluem o curso associado.

### Matrículas de usuários em turmas

Envie `POST /api/classrooms/{classroom_id}/users` com `user_id` e `action`. Use `action: "add"` para matricular e `action: "remove"` para remover a matrícula. Exemplo:

```json
{"user_id": 1, "action": "add"}
```

Após baixar as alterações, aplique as novas tabelas/coluna ao banco com `docker compose exec app php artisan migrate`.
