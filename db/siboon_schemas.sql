CREATE
DATABASE siboon_db;
USE
siboon_db;

-- PRECISA CRIAR AS REFERENCIAS DE TABELA

-- ------ --
-- System --
-- ------ --

-- CREATE TABLE institutional();
-- usada para armazenar dados institucionais por chave e valor,

-- ---- --
-- User --
-- ---- --

CREATE TABLE users
(
    id           INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name`  VARCHAR(255) NOT NULL,
    email        VARCHAR(255) UNIQUE NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `role`       ENUM("CLIENT", "ADMIN") NOT NULL DEFAULT "CLIENT"
);

CREATE TABLE user_address
(
    id            INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id       INT          NOT NULL,
    cep           VARCHAR(10)  NOT NULL,
    street_avenue VARCHAR(255) NOT NULL,
    `number`      INT          NOT NULL,
    complement    VARCHAR(255) NOT NULL,
    district      VARCHAR(255) NOT NULL,
    city          VARCHAR(255) NOT NULL,
    state         VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
);

-- ---- --
-- Shop --
-- ---- --
CREATE TABLE product_size_type
(
    id   INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(30) NOT NULL
);

CREATE TABLE products
(
    id                      INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name`                  VARCHAR(255) NOT NULL,
    `description`           TEXT,
    color                   VARCHAR(100) NOT NULL,
    size_type_id            INT          NOT NULL,
    price_brl DOUBLE NOT NULL DEFAULT 0.0,
    max_installments        TINYINT NOT NULL DEFAULT 1,
    discount_brl_percentage TINYINT DEFAULT 0,
    created_at DATE NOT NULL,
    updated_at DATE NOT NULL,
    FOREIGN KEY (size_type_id) REFERENCES product_size_type (id)
);

CREATE TABLE product_images
(
    id         INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image      varchar(255) NOT NULL UNIQUE,
    product_id INT          NOT NULL,
    type       ENUM("PRINCIPAL", "ADDITIONAL") NOT NULL,
    additional_order TINYINT,
    FOREIGN KEY (product_id) REFERENCES products(id)
		ON DELETE CASCADE
);

CREATE TABLE stock
(
    id         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    product_id INT NOT NULL,
    quantity   INT,
    size       VARCHAR(20),
    FOREIGN KEY (product_id) REFERENCES products (id)
        ON DELETE CASCADE
);

-- ------ - ----- --
-- ORDERS & SALES --
-- ------ - ----- --

-- important infos about order like total price, send method, address, sale date,
CREATE TABLE orders
(
    id         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id    INT  NOT NULL,
    address_id INT  NOT NULL,
    total_price DOUBLE NOT NULL,
    payment_status ENUM("PENDING", "PAID") NOT NULL DEFAULT "PENDING",
    shipment_status ENUM("PENDING", "SENDED") NOT NULL DEFAULT "PENDING",
    created_at DATE NOT NULL,
    updated_at DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (address_id) REFERENCES user_address (id)
);

CREATE TABLE orders_products
(
    id         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    order_id   INT NOT NULL,
    product_id INT NOT NULL,
    quantity   INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders (id),
    FOREIGN KEY (product_id) REFERENCES products (id)
);

-- ---- --
-- FAQs --
-- ---- --

CREATE TABLE faq_types
(
    id            INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `description` VARCHAR(255)
);

CREATE TABLE faq_questions
(
    id       INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    type_id  INT NOT NULL,
    question VARCHAR(255) NOT NULL,
    answer   TEXT NOT NULL,
    FOREIGN KEY (type_id) REFERENCES faq_types (id)
        ON DELETE CASCADE
);


INSERT INTO faq_types(`description`)
VALUES ("Vendas"),
       ("Trocas e Devoluções");


-- ------- --
-- INSERTS --
-- ------- --

INSERT INTO  product_size_type(`name`) VALUES
("Roupa"),
("Sapato"),
("Tamanho Único");

-- INSERT DE TROCAS E DEVOLUÇÕES
INSERT INTO faq_questions(type_id, question, answer)
VALUES (2, "Como funciona a troca/devolução de compras na Siboon?", '
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
       (2, "Quanto tempo eu tenho para desistência da compra?",
        'Após o recebimento do pedido, você tem 7 dias para desistir da compra.'),
       (2, "Quanto tempo eu tenho para trocar meu produto?", 'Após o recebimento do pedido, você tem até 30 dias para solicitar a troca do seu produto.
Os produtos devolvidos devem acompanhar a etiqueta fixada no produto. No caso de tênis é obrigatório a devolução da caixa do produto em perfeitas condições levando em consideração que a caixa faz parte do produto.');
