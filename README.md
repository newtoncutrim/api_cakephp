# Projeto Teste-Agenda
Este é um guia passo a passo para configurar e executar o projeto Teste-Agenda localmente usando Docker.

Pré-requisitos
Docker Desktop instalado e configurado na sua máquina.
Git instalado na sua máquina.
Instalação
Clone o repositório do projeto Teste-Agenda do GitHub:

```
git clone https://github.com/newtoncutrim/api_cakephp.git
```

Navegue até o diretório do projeto clonado:

```
cd api_cakephp
```

Execute o seguinte comando para iniciar os contêineres Docker e construir as imagens:

```
docker compose up -d --build
```

Instale as dependências do Composer executando o seguinte comando:

```
docker compose exec web composer install
```

Configure o banco de dados no arquivo app_local.php com as seguintes credenciais:

```
'host' => 'db',
'port' => '3306',
'username' => 'user',
'password' => '1234',
'database' => 'api_teste',
```

Execute as migrações do banco de dados com o seguinte comando:

```
docker compose exec web cake migrations migrate
```

Execute as seeders do banco de dados com o seguinte comando:

```
docker compose exec web cake migrations seed
```

Acesso Local
Depois de seguir as etapas acima, você pode acessar o projeto localmente no seguinte endereço:

http://localhost:85/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

# Documentação da API

## 1. Posts

### Listar Posts

- **Endpoint:** `GET /api/posts`
- **Descrição:** Recupera uma lista de posts.
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  [
    {
      "id": 1,
      "title": "First Post",
      "body": "This is the body of the first post.",
      "created_at": "2024-07-30T12:34:56",
      "updated_at": "2024-07-30T12:34:56"
    },
    {
      "id": 2,
      "title": "Second Post",
      "body": "This is the body of the second post.",
      "created_at": "2024-07-30T12:34:56",
      "updated_at": "2024-07-30T12:34:56"
    }
  ]

### Mostrar Post

- **Endpoint:** `GET /api/posts/{id}`
- **Descrição:** Recupera um post específico pelo ID.
- **Parâmetros:**
  - `id` (int): ID do post.
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "id": 1,
    "title": "First Post",
    "body": "This is the body of the first post.",
    "created_at": "2024-07-30T12:34:56",
    "updated_at": "2024-07-30T12:34:56"
  }

### Editar Post

- **Endpoint:** `PUT /api/posts/{id}/edit` ou `POST /api/posts/{id}/edit`
- **Descrição:** Atualiza as informações de um post específico.
- **Parâmetros:**
  - `id` (int): ID do post.
- **Formato da Requisição:** JSON
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "status": "success",
    "data": {
      "id": 1,
      "title": "Updated Title",
      "body": "Updated body of the post.",
      "created_at": "2024-07-30T12:34:56",
      "updated_at": "2024-07-30T13:00:00"
    },
    "image": {
      "path": "http://localhost:85/img/uploads/updated-image.jpg",
      "post_id": 1,
      "created_at": "2024-07-30T13:00:00",
      "updated_at": "2024-07-30T13:00:00",
      "id": 1
    }
  }

### Excluir Post

- **Endpoint:** `DELETE /api/posts/{id}/delete`
- **Descrição:** Exclui um post específico.
- **Parâmetros:**
  - `id` (int): ID do post.
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "status": "success",
    "message": "Post deleted"
  }

### Listar Usuários

- **Endpoint:** `GET /api/users`
- **Descrição:** Recupera uma lista de usuários.
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "created_at": "2024-07-30T12:34:56",
      "updated_at": "2024-07-30T12:34:56"
    },
    {
      "id": 2,
      "name": "Jane Doe",
      "email": "jane.doe@example.com",
      "created_at": "2024-07-30T12:34:56",
      "updated_at": "2024-07-30T12:34:56"
    }
  ]

### Mostrar Usuário

- **Endpoint:** `GET /api/users/{id}`
- **Descrição:** Recupera um usuário específico pelo ID.
- **Parâmetros:**
  - `id` (int): ID do usuário.
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "created_at": "2024-07-30T12:34:56",
    "updated_at": "2024-07-30T12:34:56"
  }

### Editar Usuário

- **Endpoint:** `PATCH /api/users/{id}/edit` ou `PUT /api/users/{id}/edit`
- **Descrição:** Atualiza as informações de um usuário específico.
- **Parâmetros:**
  - `id` (int): ID do usuário.
- **Formato da Requisição:** JSON
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "status": "success",
    "data": {
      "id": 1,
      "name": "Updated Name",
      "email": "updated.email@example.com",
      "created_at": "2024-07-30T12:34:56",
      "updated_at": "2024-07-30T13:00:00"
    }
  }

### Excluir Usuário

- **Endpoint:** `DELETE /api/users/{id}/delete`
- **Descrição:** Exclui um usuário específico.
- **Parâmetros:**
  - `id` (int): ID do usuário.
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "status": "success",
    "message": "User deleted"
  }

### Adicionar Usuário

- **Endpoint:** `POST /api/users/add`
- **Descrição:** Cria um novo usuário.
- **Formato da Requisição:** JSON
- **Formato da Resposta:** JSON
- **Resposta de Exemplo:**
  ```json
  {
    "status": "success",
    "data": {
      "id": 3,
      "name": "New User",
      "email": "new.user@example.com",
      "created_at": "2024-07-30T13:00:00",
      "updated_at": "2024-07-30T13:00:00"
    }
  }
