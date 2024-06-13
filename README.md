# Siboon SkateShop

- In Development!

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

### Funcionalidades - All in development

- Api; 
- Integração com os correios via WS, nem que seja mockada;
- Integração com Gerador de Pagamento, nem que seja mockada; 
- Carrinho com localstorage;
- Web App;
- Admin App;
- Banco de dados;

## API

- Recurso **FAQ**

| Método | Rota             | Descrição                         |
|--------|------------------|-----------------------------------|
| `GET`  | **api/faq**      | Devolve todas as FAQS existentes. |
| `GET`  | **api/faq/{id}** | Devolve uma FAQ existente por id. | 

- Recurso **PRODUTO**

| Método   | Rota                  | Descrição                             |
|----------|-----------------------|---------------------------------------|
| `GET`    | **api/produtos**      | Devolve todos os produtos existentes. |
| `GET`    | **api/produtos/{id}** | Devolve um produto existente por id.  |    
| `POST`   | **api/produtos**      | Cria um produto.                      |    
| `PUT`    | **api/produtos/{id}** | Atualiza um produto por id.           |    
| `DELETE` | **api/produtos/{id}** | Deleta um produto por id.             |    

## Páginas

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


## Database
### MySQL Table Scheme