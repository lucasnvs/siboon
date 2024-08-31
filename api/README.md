# Documentação API

## Endpoint da API

> siboon/api

## Recursos

1. ### Usuário

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

```json
{
  "email": "johndoe@email.com",
  "password": "blablabla"
}
```
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

<details>
    <summary>CHANGE PASSWORD</summary>

Exemplo de Requisição:

> POST /usuarios/change-password

```json
{
  "id": 1,
  "password": "34tdagger",
  "newPassword": "dagger@@@4",
  "confirmNewPassword": "dagger@@@4"
}
```
Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Senha alterada com sucesso."
}
```
</details>

1. ### Usuário - Endereços

<details>
    <summary>CREATE</summary>

Exemplo de Requisição:

> POST /usuarios/1/enderecos/

```json
{
  "cep": "343434323",
  "street_avenue": "Rua 1",
  "number": 3406,
  "complement": "Casa",
  "district": "Centro",
  "city": "Porto Alegre",
  "state": "RS"
}
```

Exemplo de Resposta:
> Status Code: 204

```json
{
  "type": "success",
  "message": "Endereço cadastrado para o usuário."
}
```
</details>

<details>
    <summary>READ</summary>

1. Exemplo de Requisição:
> GET /usuarios/1/enderecos/

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Endereços encontrados!",
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "cep": "343434323",
      "street_avenue": "Rua 1",
      "number": 3406,
      "complement": "Casa",
      "district": "Centro",
      "city": "Porto Alegre",
      "state": "RS"
    }
  ]
}
```
</details>

<details>
    <summary>UPDATE</summary>

Exemplo de Requisição:

> POST /usuarios/1/enderecos/update/1

O valor do que deseja modificar;

```json
{
  "street_avenue": "Rua Oscar Freire",
  "number": 404
}
```

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Endereço atualizado com sucesso."
}
```
</details>

<details>
    <summary>DELETE</summary>


Exemplo de Requisição:

> DELETE /usuarios/1/enderecos/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Endereço deletado com sucesso."
}
```
</details>

2. ### Produto
<details>
    <summary>CREATE - ADMIN</summary>

Exemplo de Requisição:

> POST /produtos

```json or FormData
{
  "name": "Camisa High",
  "description": "Feita com 100% algodão...",
  "color": "PRETO",
  "size_type": 1,
  "price_brl": 109.90,
  "max_installments": 3,
  "discount_brl_percentage": 5
}
```

Exemplo de Resposta:
> Status Code: 201

```json
{
  "type": "success",
  "message": "Produto criado com sucesso."
}
```
</details>

<details>
    <summary>READ</summary>

1. Exemplo de Requisição:
> GET /produtos/4

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": {
    "id": 4,
    "name": "CAMISA VANS BAILEY LS WOVEN SHIRT BLACK BERRY",
    "description": "100% algodão.",
    "color": "Marrom",
    "price_brl": 350,
    "formated_price_brl": "R$ 350,00",
    "discount_brl_percentage": 5,
    "formated_price_brl_with_discount": "R$ 332,50",
    "max_installments": 6,
    "url": "camisa-vans-bailey-ls-woven-shirt-black-berry-4",
    "size_type_id": 1,
    "size_type": "Roupa",
    "principal_img": "storage/images/products/4/principal-image.png",
    "additional_imgs": [
      "storage/images/products/4/additional-image-1.png"
    ]
  }
}
```
2. Exemplo de Requisição:
> GET /produtos

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": [
    {
      "id": 4,
      "name": "CAMISA VANS BAILEY LS WOVEN SHIRT BLACK BERRY",
      "description": "100% algodão.",
      "color": "Marrom",
      "price_brl": 350,
      "formated_price_brl": "R$ 350,00",
      "discount_brl_percentage": 5,
      "formated_price_brl_with_discount": "R$ 332,50",
      "max_installments": 6,
      "url": "camisa-vans-bailey-ls-woven-shirt-black-berry-4",
      "size_type_id": 1,
      "size_type": "Roupa",
      "principal_img": "storage\/images\/products\/4\/principal-image.png",
      "additional_imgs": [
        "storage\/images\/products\/4\/additional-image-1.png"
      ]
    },
    {
      "id": 5,
      "name": "CALÇA VANS DRILL CHORE CARPENTER DENIM AVE 2.0 PIRATE BLACK",
      "description": "Melhor calça para skate",
      "color": "Preto",
      "price_brl": 480,
      "formated_price_brl": "R$ 480,00",
      "discount_brl_percentage": 8,
      "formated_price_brl_with_discount": "R$ 441,60",
      "max_installments": 6,
      "url": "cal-a-vans-drill-chore-carpenter-denim-ave-2-0-pirate-black-5",
      "size_type_id": 1,
      "size_type": "Roupa",
      "principal_img": "storage\/images\/products\/5\/principal-image.png",
      "additional_imgs": [
        "storage\/images\/products\/5\/additional-image-1.png"
      ]
    },
    {
      "id": 6,
      "name": "Camisa High Tee Black",
      "description": "Camisa da melhor qualidade feita pela High. ",
      "color": "Preto",
      "price_brl": 99.9,
      "formated_price_brl": "R$ 99,90",
      "discount_brl_percentage": 5,
      "formated_price_brl_with_discount": "R$ 94,91",
      "max_installments": 2,
      "url": "camisa-high-tee-black-6",
      "size_type_id": 1,
      "size_type": "Roupa",
      "principal_img": "storage\/images\/products\/6\/principal-image.jpg",
      "additional_imgs": [
        "storage\/images\/products\/6\/additional-image-1.jpg",
        "storage\/images\/products\/6\/additional-image-1-1723167838.jpg"
      ]
    }
  ]
}
```
</details>

<details>
    <summary>UPDATE - ADMIN</summary>

Exemplo de Requisição:

> POST /produtos/update/4

O valor ou valores do que deseja modificar;

```json
{
  "name": "Camisa High Black Purpose",
  "price_brl": 140.00
}
```

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Produto atualizado com sucesso."
}
```
</details>

<details>
    <summary>DELETE - ADMIN</summary>

Exemplo de Requisição:

> DELETE /produtos/2

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Produto deletado com sucesso."
}
```
</details>

3. ### Pedido
<details>
    <summary>CREATE</summary>

Exemplo de Requisição:

> POST /pedidos

```json
{
  "user_id": 76,
  "address_id": 975,
  "order_items": [
    {
      "id": 22,
      "amount": 1
    },
    {
      "id": 433,
      "amount": 1
    },
    {
      "id": 544,
      "amount": 2
    }
  ]
}
```

Exemplo de Resposta:
> Status Code: 201

```json
{
  "type": "success",
  "message": "Pedido efetuado com sucesso.",
  "data": {
    "order_id": 54
  }
}
```
</details>

<details>
    <summary>READ - ADMIN</summary>

1. Exemplo de Requisição:
> GET /pedidos/2

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": {
    "id": 456,
    "user_id": 9,
    "address_id": 1,
    "total_price": 420.00,
    "payment_status": "PAID",
    "shipment_status": "PENDENT"
  }
}
```
2. Exemplo de Requisição:
> GET /pedidos

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": [
    {
      "id": 456,
      "user_id": 9,
      "address_id": 1,
      "total_price": 420.00,
      "payment_status": "PAID",
      "shipment_status": "PENDENT"
    },
    {
      "id": 343,
      "user_id": 4,
      "address_id": 3,
      "total_price": 210.00,
      "payment_status": "PENDENT",
      "shipment_status": "PENDENT"
    }
  ]
}
```
</details>

<details>
    <summary>UPDATE - ADMIN</summary>

Exemplo de Requisição:

> POST /pedidos/update/1

O valor ou valores do que deseja modificar;

```json
{
  "payment_status": "PAID"
}
```

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Pedido atualizado com sucesso."
}
```
</details>

<details>
    <summary>DELETE - ADMIN</summary>

Exemplo de Requisição:

> DELETE /pedidos/2

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Pedido deletado com sucesso."
}
```
</details>

4. ### FAQ - Questões
<details>
    <summary>CREATE - ADMIN</summary>

Exemplo de Requisição:

> POST /faq

```json
{
  "type_id": 1,
  "question": "Como se compra?",
  "answer": "Você tem que clicar no botão \"comprar\"."
}
```

Exemplo de Resposta:
> Status Code: 201

```json
{
  "type": "success",
  "message": "Questão criada com sucesso."
}
```
</details>

<details>
    <summary>READ</summary>

1. Exemplo de Requisição:
> GET /faq/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": {
    "id": 1,
    "type_id": 2,
    "question": "Como funciona a troca/devolução de compras na Siboon?",
    "answer": "\r\nA primeira troca é por nossa conta.\r\nA troca pode ser efetuada pelo mesmo produto ou um produto de mesmo valor.\r\nTodos os pedidos que tem como assunto Troca ou Devolução de compras deve ser comunicado a Siboon pelo e-mail siboon@siboon.com.br seguindo as instruções:\r\nTítulo do e-mail: Pedido \"NÚMERO DO SEU PEDIDO\" - TROCA/DEVOLUÇÃO/DESISTÊNCIA\r\nExemplo: Pedido E009112OA02 - TROCA.\r\nConsiderações finais:\r\nA Siboon não tem obrigação de consertar, trocar ou restituir produtos que apresentem sinais claros de mau uso. Confira sempre o produto ao recebê-lo. Qualquer problema, entre em contato imediatamente com nosso Serviço de Atendimento ao Consumidor.\r\n",
    "type": "Trocas e Devoluções"
  }
}
```
2. Exemplo de Requisição:
> GET /faq

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": [
    {
      "id": 1,
      "type_id": 2,
      "question": "Como funciona a troca/devolução de compras na Siboon?",
      "answer": "\r\nA primeira troca é por nossa conta.\r\nA troca pode ser efetuada pelo mesmo produto ou um produto de mesmo valor.\r\nTodos os pedidos que tem como assunto Troca ou Devolução de compras deve ser comunicado a Siboon pelo e-mail siboon@siboon.com.br seguindo as instruções:\r\nTítulo do e-mail: Pedido \"NÚMERO DO SEU PEDIDO\" - TROCA/DEVOLUÇÃO/DESISTÊNCIA\r\nExemplo: Pedido E009112OA02 - TROCA.\r\nConsiderações finais:\r\nA Siboon não tem obrigação de consertar, trocar ou restituir produtos que apresentem sinais claros de mau uso. Confira sempre o produto ao recebê-lo. Qualquer problema, entre em contato imediatamente com nosso Serviço de Atendimento ao Consumidor.\r\n",
      "type": "Trocas e Devoluções"
    },
    {
      "id": 2,
      "type_id": 2,
      "question": "Como cancelar uma compra efetuada?",
      "answer": "Para compras por Boleto Bancário/Pix, basta não efetuar o pagamento do mesmo que o pedido é cancelado automaticamente.\r\nCaso tenha efetuado a compra com outro formato de compra ou ter efetuado o pagamento dos modos citados acima, entre em contato com nossa equipe pelo e-mail sac@yerbah.com.br seguindo as instruções:\r\nTítulo do e-mail: Pedido \"NÚMERO DO SEU PEDIDO\" - Cancelamento de compra.",
      "type": "Trocas e Devoluções"
    },
    {
      "id": 3,
      "type_id": 2,
      "question": "Quanto tempo eu tenho para desistência da compra?",
      "answer": "Após o recebimento do pedido, você tem 7 dias para desistir da compra.",
      "type": "Trocas e Devoluções"
    },
    {
      "id": 4,
      "type_id": 2,
      "question": "Quanto tempo eu tenho para trocar meu produto?",
      "answer": "Após o recebimento do pedido, você tem até 30 dias para solicitar a troca do seu produto.\r\nOs produtos devolvidos devem acompanhar a etiqueta fixada no produto. No caso de tênis é obrigatório a devolução da caixa do produto em perfeitas condições levando em consideração que a caixa faz parte do produto.",
      "type": "Trocas e Devoluções"
    }
  ]
}
```
</details>

<details>
    <summary>UPDATE - ADMIN</summary>

Exemplo de Requisição:

> POST /faq/update/1

O valor ou valores do que deseja modificar;

```json
{
  "question": "Mas como eu posso fazer isto?"
}
```

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Questão atualizada com sucesso."
}
```
</details>

<details>
    <summary>DELETE - ADMIN</summary>

Exemplo de Requisição:

> DELETE /faq/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Questão deletada com sucesso."
}
```
</details>

4. ### FAQ - Tópicos
<details>
    <summary>CREATE - ADMIN</summary>

Exemplo de Requisição:

> POST /faq/topicos

Só precisa de um parâmetro: description.
```json
{
  "description": "Tópico X"
}
```

Exemplo de Resposta:
> Status Code: 201

```json
{
  "type": "success",
  "message": "Tópico criado com sucesso."
}
```
</details>

<details>
    <summary>READ</summary>

1. Exemplo de Requisição:
> GET /faq/topicos/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": {
    "id": 1,
    "description": "Vendas"
  }
}
```
2. Exemplo de Requisição:
> GET /faq/topicos

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "data": [
    {
      "id": 1,
      "description": "Vendas"
    },
    {
      "id": 2,
      "description": "Trocas e Devoluções"
    }
  ]
}
```
</details>

<details>
    <summary>UPDATE - ADMIN</summary>

Exemplo de Requisição:

> POST /faq/topicos/update/1

Recebe apenas a chave "description", que pode ser alterada.

```json
{
  "description": "Este é o Tópico Atualizado"
}
```

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Tópico atualizado com sucesso."
}
```
</details>

<details>
    <summary>DELETE - ADMIN</summary>

Exemplo de Requisição:

> DELETE /faq/topicos/1

Exemplo de Resposta:
> Status Code: 200

```json
{
  "type": "success",
  "message": "Tópico deletado com sucesso."
}
```
</details>