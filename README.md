# Siboon SkateShop

> Status do Projeto: Em desenvolvimento :warning:

## Descrição

Projeto com o objetivo de implementar um sistema Web de um e-commerce de uma loja de skates, 
utilizando um padrão de projeto MVC.

## Tecnologias

- HTML, CSS, JAVASCRIPT
- PHP
- Estrutura MVC;
- Composer;
- CoffeCode Router para rotas;
- Plates para lidar com layouts;
- Firebase JWT para autenticação;
- MySQL Database;

## Funcionalidades

- [x] Banco de dados
- [x] API
- [ ] Web Application
- [ ] App Application
- [ ] Admin Application
- [x] Carrinho com localstorage
- [x] Integração com os correios via WS (Mock)
- [x] Integração com Gerador de Pagamento (Mock)

## Documentações

1. Acesso a documentação da [API](api/README.md)
2. Acesso a documentação do [Banco de Dados](db/README.md)

## Rodar o projeto

Para rodar o projeto você vai precisar:
1. Rodar o composer.json install. 
2. Preparar um arquivo ".env" (exemplo em [.env.example](.env.example));
3. Rodar o arquivo de estrutura do Banco de Dados ([siboon_schemas.sql](db/siboon_schemas.sql)) ou acessar **"{root}/siboon/db/initialize_test_db.php"** em modo de desenvolvimento.

## Usuário Padrão;
### **Admin:**

```
Email >> johndoe@email.com
```

```
Senha >> l@123456
```

