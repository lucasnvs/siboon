## Banco de Dados

### 📋 Introdução

O banco de dados do projeto **Siboon SkateShop** foi desenvolvido em **MySQL** e foi projetado para suportar as operações de um e-commerce completo. Ele utiliza um esquema relacional para gerenciar as informações sobre usuários, produtos, pedidos, pagamentos e mais.

### 📂 Arquivo SQL de Estrutura:
O esquema de banco de dados pode ser criado a partir do arquivo [`siboon_schemas.sql`](db/siboon_schemas.sql).

---

### 📑 Estrutura do Banco de Dados

#### 🗂 Principais Tabelas e Descrições

Abaixo encontra-se uma visão geral das principais tabelas que compõem o banco de dados:

#### **Tabela: `users`**
Gerencia os dados dos usuários cadastrados na plataforma.

| **Coluna**     | **Tipo**         | **Descrição**                               |
|-----------------|------------------|---------------------------------------------|
| `id`           | INT (PK)         | Identificador único do usuário.            |
| `name`         | VARCHAR(255)     | Nome completo do usuário.                  |
| `email`        | VARCHAR(255)     | Endereço de e-mail (único).                |
| `password`     | VARCHAR(255)     | Hash da senha do usuário.                  |
| `role`         | ENUM('admin','user') | Define o tipo de usuário (admin ou cliente).|
| `created_at`   | TIMESTAMP        | Data e hora de criação do cadastro.        |

---

#### **Tabela: `products`**
Armazena os produtos disponíveis para venda.

| **Coluna**     | **Tipo**         | **Descrição**                               |
|-----------------|------------------|---------------------------------------------|
| `id`           | INT (PK)         | Identificador único do produto.            |
| `name`         | VARCHAR(255)     | Nome do produto.                           |
| `description`  | TEXT             | Descrição detalhada do produto.            |
| `price`        | DECIMAL(10,2)    | Preço do produto.                          |
| `stock`        | INT              | Quantidade disponível em estoque.          |
| `created_at`   | TIMESTAMP        | Data e hora de adição do produto.          |

---

#### **Tabela: `orders`**
Gerencia os pedidos realizados pelos usuários.

| **Coluna**     | **Tipo**         | **Descrição**                               |
|-----------------|------------------|---------------------------------------------|
| `id`           | INT (PK)         | Identificador único do pedido.             |
| `user_id`      | INT (FK)         | Identifica o usuário que fez o pedido.     |
| `status`       | ENUM('pending','completed','canceled') | Status atual do pedido. |
| `total_price`  | DECIMAL(10, 2)   | Valor total do pedido.                     |
| `created_at`   | TIMESTAMP        | Data e hora do pedido.                     |

---

#### **Tabela: `order_items`**
Relaciona os produtos de um pedido com suas quantidades.

| **Coluna**     | **Tipo**         | **Descrição**                               |
|-----------------|------------------|---------------------------------------------|
| `id`           | INT (PK)         | Identificador único do item no pedido.     |
| `order_id`     | INT (FK)         | Identifica o pedido relacionado.           |
| `product_id`   | INT (FK)         | Identifica o produto relacionado.          |
| `quantity`     | INT              | Quantidade do produto no pedido.           |
| `sub_total`    | DECIMAL(10, 2)   | Subtotal para o item (preço x quantidade). |

---

#### **Tabela: `payments`**
Armazena informações relacionadas aos pagamentos realizados.

| **Coluna**     | **Tipo**         | **Descrição**                               |
|-----------------|------------------|---------------------------------------------|
| `id`           | INT (PK)         | Identificador único do pagamento.          |
| `order_id`     | INT (FK)         | Pedido associado ao pagamento.             |
| `payment_method` | ENUM('credit_card','paypal','billet') | Método de pagamento utilizado. |
| `status`       | ENUM('pending','completed','failed') | Status do pagamento.            |
| `created_at`   | TIMESTAMP        | Data e hora do pagamento.                  |

---

#### **Tabela: `cart`**
Gerencia o carrinho de compras para usuários conectados.

| **Coluna**     | **Tipo**         | **Descrição**                               |
|-----------------|------------------|---------------------------------------------|
| `id`           | INT (PK)         | Identificador único do carrinho.           |
| `user_id`      | INT (FK)         | Relacionado ao usuário que criou o carrinho.|
| `items`        | JSON             | Lista de produtos no carrinho.             |
| `total_price`  | DECIMAL(10, 2)   | Preço total do carrinho.                   |
| `updated_at`   | TIMESTAMP        | Última atualização do carrinho.            |

---

### 🔗 Relacionamentos Entre as Tabelas

1. **`users` ↔ `orders`**:
    - Um usuário pode possuir vários pedidos.
    - Relacionamento: **1:N**.

2. **`orders` ↔ `order_items` ↔ `products`**:
    - Um pedido pode conter vários produtos.
    - Um produto pode estar em vários pedidos.
    - Relacionamento: **N:N** com tabela intermediária `order_items`.

3. **`orders` ↔ `payments`**:
    - Cada pedido está vinculado a um único pagamento.
    - Relacionamento: **1:1**.

---

### 📌 Considerações Finais

- Para criar a estrutura do banco de dados, utilize o arquivo [`siboon_schemas.sql`](db/siboon_schemas.sql).
- Caso deseje popular o banco com dados fictícios, acesse o script de inicialização em `{root}/siboon/db/initialize_test_db.php`.

**Observação**: Certifique-se de configurar corretamente as permissões de acesso ao banco e as variáveis de ambiente antes de inicializar o sistema.