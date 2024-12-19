# Siboon SkateShop

> **Status do Projeto**: Em desenvolvimento :warning:

## 📋 Descrição

O **Siboon SkateShop** é um projeto de e-commerce desenvolvido para uma loja de skates, utilizando um design baseado no padrão **MVC** (Model-View-Controller). Este sistema web inclui funcionalidades modernas, como autenticação, carrinho de compras e integração com serviços externos.

---

## 🚀 Tecnologias Utilizadas

- **Linguagens e Ferramentas**
    - HTML, CSS, JavaScript
    - PHP
- **Bibliotecas e Frameworks**
    - **Composer** para gerenciamento de dependências;
    - **CoffeCode Router** para manipulação de rotas;
    - **Plates Template Engine** para gestão de layouts;
    - **Firebase JWT** para autenticação;
- **Banco de Dados**
    - MySQL.

---

## ✅ Funcionalidades Implementadas

- 🔄 Banco de dados totalmente estruturado.
- 🌐 API para integração com serviços externos.
- 💻 Web Application.
- 📱 App Application.
- 🔒 Admin Application com tela dedicada.
- 🛒 Carrinho de compras funcional com armazenamento via LocalStorage.
- 📦 Integração com Correios via WebService (simulado - Mock).
- 💳 Integração com geradores de pagamento (simulado - Mock).

---

## 📑 Documentação Disponível

1. [Documentação da API](api/README.md)
2. [Documentação do Banco de Dados](db/README.md)

---

## 🚀 Como Rodar o Projeto

Siga os passos abaixo para rodar o projeto em sua máquina local:

1. **Instale as dependências do Composer**:
   ```bash
   composer install
   ```

2. **Configure o arquivo `.env`**: Use o arquivo de exemplo disponível em [`.env.example`](.env.example) para criar as variáveis de ambiente necessárias.

3. **Prepare o Banco de Dados**:
    - Execute o script de criação do banco de dados disponível em [`siboon_schemas.sql`](db/siboon_schemas.sql).
    - Para inicialização rápida e testes, rode o script de inicialização com dados fictícios em:
   ```
   {root}/siboon/db/initialize_test_db.php
   ```
   (Recomenda-se utilizar este recurso apenas em modo de desenvolvimento).

---

## 👤 Credenciais de Usuário Padrão

Utilize as credenciais abaixo para acessar o sistema no ambiente de desenvolvimento:

### **Admin**
- **Email**: `johndoe@email.com`
- **Senha**: `l@123456`

---

## 📌 Observações

Este projeto ainda está em desenvolvimento, e algumas funcionalidades podem ser atualizadas ou sofrer alterações.

---