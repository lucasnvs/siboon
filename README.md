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

- [ ] Banco de dados
- [ ] API
- [ ] Web Application
- [ ] App Application
- [ ] Admin Application
- [ ] Carrinho com localstorage
- [ ] Integração com os correios via WS, nem que seja mockada
- [ ] Integração com Gerador de Pagamento, nem que seja mockada

## Documentações

1. Acesso a documentação da [API](api/README.md)
2. Acesso a documentação do [Banco de Dados](db/README.md)

## Rotas Amigáveis

### Grupos

- Web - " / "
- Admin - " /admin/ "

- ### Web - Guest

| Rota                | Tipo          | Descrição                                            |
|---------------------|---------------|------------------------------------------------------|
| **/**               | Funcional     | Página principal com o catálogo.                     |
| **/entrar**         | Funcional     | Responsável pelo login e cadastro.                   |
| **/{secao}**        | Funcional     | Mostruário de produtos por seção distinta.           |
| **/produto/{nome}** | Funcional     | Informações de um produto específico.                |
| **/contato**        | Institucional | Informações de contato da loja.                      |
| **/faq**            | Institucional | Perguntas frequentes relacionadas a loja.            |
| **/sobre**          | Institucional | Informações gerais sobre a loja.                     |

- ### Web - Logged

| Rota        | Tipo          | Descrição                 |
|-------------|---------------|---------------------------|
| **/perfil** | Funcional     | Perfil do cliente logado. |


- ### Admin

| Rota                    | Subgrupo | Descrição                  |
|-------------------------|----------|----------------------------|
| **/**                   | Geral    | Dashboard principal.       |
| **/produtos**           | Produto  | Gerenciamento de produtos. |
| **/produtos/registrar** | Produto  | Registrar um produto.      |
