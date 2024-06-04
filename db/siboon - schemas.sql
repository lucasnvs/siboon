
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
    `name` VARCHAR(255),
    email VARCHAR(255),
    `password` VARCHAR(255),
    `role` ENUM("CLIENT", "ADMIN")
);

CREATE TABLE user_address(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cep VARCHAR(10),
    street_avenue VARCHAR(255),
    `number` INT,
    district VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255)
);

-- ---- --
-- Shop --
-- ---- --

CREATE TABLE products(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255),
    color VARCHAR(100),
    size VARCHAR(100),
    price_brl DOUBLE,
    res_path VARCHAR(255)	
);

CREATE TABLE stock(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_product INT NOT NULL,
	quantity INT
);

-- ------ - ----- --
-- ORDERS & SALES --
-- ------ - ----- --

-- important infos about order like, total price, send method, address, sale date,
CREATE TABLE orders(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_user INT NOT NULL,
    id_address INT NOT NULL,
    sale_date DATE NOT NULL,
    total_price DOUBLE NOT NULL,
    `status` ENUM("PENDENT", "SENDED", "FINISHED") NOT NULL
); 

CREATE TABLE orders_products(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_order INT NOT NULL,
    id_product INT NOT NULL,
    quantity INT NOT NULL
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
	answer TEXT
);