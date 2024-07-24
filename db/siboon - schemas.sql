
CREATE DATABASE siboon_db;
USE siboon_db;

-- PRECISA CRIAR AS REFERENCIAS DE TABELA

-- ------ --
-- System --
-- ------ --

-- CREATE TABLE institutional();
-- usada para armazenar dados institucionais por chave e valor, 

-- ---- --
-- User --
-- ---- --

-- posso salvar dados de cartão??? acho q não.

CREATE TABLE users(
                      id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                      `first_name` VARCHAR(100) NOT NULL,
                      `last_name` VARCHAR(255) NOT NULL,
                      email VARCHAR(255) NOT NULL,
                      `password` VARCHAR(255) NOT NULL,
                      `role` ENUM("CLIENT", "ADMIN") NOT NULL DEFAULT "CLIENT"
);

CREATE TABLE user_address(
                             id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                             user_id INT NOT NULL,
                             cep VARCHAR(10),
                             street_avenue VARCHAR(255),
                             `number` INT,
                             district VARCHAR(255),
                             city VARCHAR(255),
                             state VARCHAR(255),
                             FOREIGN KEY (user_id) REFERENCES users(id)
                                 ON DELETE CASCADE
);

-- ---- --
-- Shop --
-- ---- --

CREATE TABLE products(
                         id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                         `name` VARCHAR(255),
                         `description` TEXT,
                         color VARCHAR(100),
                         size VARCHAR(100),
                         price_brl DOUBLE,
                         res_path VARCHAR(255)
);

CREATE TABLE stock(
                      id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                      product_id INT NOT NULL,
                      quantity INT,
                      FOREIGN KEY (product_id) REFERENCES products(id)
                          ON DELETE CASCADE
);

-- ------ - ----- --
-- ORDERS & SALES --
-- ------ - ----- --

-- important infos about order like, total price, send method, address, sale date,
CREATE TABLE orders(
                       id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                       user_id INT NOT NULL,
                       address_id INT NOT NULL,
                       sale_date DATE NOT NULL,
                       total_price DOUBLE NOT NULL,
                       `status` ENUM("PENDENT", "SENDED", "FINISHED") NOT NULL,
                       FOREIGN KEY (user_id) REFERENCES users(id),
                       FOREIGN KEY (address_id) REFERENCES user_address(id)
);

CREATE TABLE orders_products(
                                id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                order_id INT NOT NULL,
                                product_id INT NOT NULL,
                                quantity INT NOT NULL,
                                FOREIGN KEY (order_id) REFERENCES orders(id),
                                FOREIGN KEY (product_id) REFERENCES products(id)
);

-- ---- --
-- FAQs --
-- ---- --

CREATE TABLE faq_types(
                          id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                          `description` VARCHAR(255)
);

CREATE TABLE faq_questions(
                              id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                              type_id INT,
                              question VARCHAR(255),
                              answer TEXT,
                              FOREIGN KEY (type_id) REFERENCES faq_types(id)
                                  ON DELETE CASCADE
);


INSERT INTO faq_types(`description`) VALUES
                                         ("Vendas"),
                                         ("Trocas e Devoluções");

-- INSERT DE TROCAS E DEVOLUÇÕES
INSERT INTO faq_questions(type_id, question, answer) VALUES
                                                         (2, "Como funciona a troca/devolução de compras na Siboon?", '
A primeira troca é por nossa conta.
A troca pode ser efetuada pelo mesmo produto ou um produto de mesmo valor.
Todos os pedidos que tem como assunto Troca ou Devolução de compras deve ser comunicado a Siboon pelo e-mail siboon@siboon.com.br seguindo as instruções:
Título do e-mail: Pedido "NÚMERO DO SEU PEDIDO" - TROCA/DEVOLUÇÃO/DESISTÊNCIA
Exemplo: Pedido E009112OA02 - TROCA.
Considerações finais:
A Siboon não tem obrigação de consertar, trocar ou restituir produtos que apresentem sinais claros de mau uso. Confira sempre o produto ao recebê-lo. Qualquer problema, entre em contato imediatamente com nosso Serviço de Atendimento ao Consumidor.
'),
                                                         (2, "Como cancelar uma compra efetuada?", 'Para compras por Boleto Bancário/Pix, basta não efetuar o pagamento do mesmo que o pedido é cancelado automaticamente.
Caso tenha efetuado a compra com outro formato de compra ou ter efetuado o pagamento dos modos citados acima, entre em contato com nossa equipe pelo e-mail sac@yerbah.com.br seguindo as instruções: 
Título do e-mail: Pedido "NÚMERO DO SEU PEDIDO" - Cancelamento de compra.'),
                                                         (2, "Quanto tempo eu tenho para desistência da compra?", 'Após o recebimento do pedido, você tem 7 dias para desistir da compra.'),
                                                         (2, "Quanto tempo eu tenho para trocar meu produto?", 'Após o recebimento do pedido, você tem até 30 dias para solicitar a troca do seu produto.
Os produtos devolvidos devem acompanhar a etiqueta fixada no produto. No caso de tênis é obrigatório a devolução da caixa do produto em perfeitas condições levando em consideração que a caixa faz parte do produto.');
