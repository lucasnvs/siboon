# Documentação API

## Endpoint da API

> siboon/api

## Recursos

<details>
    <summary>USUÁRIO</summary>

<details>
    <summary>CREATE</summary>

Exemplo de Requisição:

> POST /usuarios

```json
{
  "first_name": "John",
  "last_name": "Doe",
  "email": "johndoe@email.com",
  "password": "blablabla"
}
```

Exemplo de Resposta:
> Status Code: 204

```json
{
  "type": "success",
  "message": "Usuário cadastrado com sucesso.",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@email.com"
  }
}
```
</details>

<details>
    <summary>READ</summary>

1. Exemplo de Requisição:
> GET /usuarios/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@email.com",
    "role": "ADMIN"
  }
}
```
2. Exemplo de Requisição:
> GET /usuarios

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "johndoe@email.com",
      "role": "ADMIN"
    },
    {
      "id": 2,
      "name": "Michael Jordan",
      "email": "michaeljordan@email.com",
      "role": "CLIENT"
    }
  ]
}
```
</details>

<details>
    <summary>UPDATE</summary>

Exemplo de Requisição:

> POST /usuarios/update/1

O valor do que deseja modificar;

```json
{
  "first_name": "Jonas"
}
```

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Usuário atualizado com sucesso."
}
```
</details>

<details>
    <summary>DELETE</summary>


Exemplo de Requisição:

> DELETE /usuarios/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Usuário deletado com sucesso."
}
```
</details>

<details>
    <summary>LOGIN</summary>

Exemplo de Requisição:

> POST /usuarios/login

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Usuário logado com sucesso.",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@email.com",
    "token": "eyk2343uf39r934r97832RTGUYHFYBVuhegu..."
  }
}
```
</details>

</details>