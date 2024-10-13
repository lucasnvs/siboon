CREATE DATABASE IF NOT EXISTS siboon_db;
USE siboon_db;

-- ------ --
-- System --
-- ------ --

CREATE TABLE IF NOT EXISTS institutional
(
    id           INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    key_unique   VARCHAR(100) UNIQUE NOT NULL,
    `value`      VARCHAR(255) NOT NULL
    );

-- ---- --
-- User --
-- ---- --

CREATE TABLE IF NOT EXISTS users
(
    id           INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name`  VARCHAR(255) NOT NULL,
    email        VARCHAR(255) UNIQUE NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `role`       ENUM("CLIENT", "ADMIN") NOT NULL DEFAULT "CLIENT"
    );

CREATE TABLE IF NOT EXISTS user_address
(
    id            INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id       INT          NOT NULL,
    cep           VARCHAR(15)  NOT NULL,
    street_avenue VARCHAR(255) NOT NULL,
    `number`      VARCHAR(10)  NOT NULL,
    complement    VARCHAR(255),
    district      VARCHAR(255) NOT NULL,
    city          VARCHAR(255) NOT NULL,
    state         VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE CASCADE
    );

-- ---- --
-- Shop --
-- ---- --

CREATE TABLE IF NOT EXISTS product_size_type
(
    id   INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(30) NOT NULL
    );

CREATE TABLE IF NOT EXISTS products
(
    id                      INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name`                  VARCHAR(255) NOT NULL,
    `description`           TEXT,
    color                   VARCHAR(100) NOT NULL,
    size_type_id            INT          NOT NULL,
    price_brl               DOUBLE(10,2) NOT NULL DEFAULT 0.00,
    max_installments        TINYINT NOT NULL DEFAULT 1,
    discount_brl_percentage TINYINT DEFAULT 0,
    created_at              DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at              DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (size_type_id) REFERENCES product_size_type (id)
    );

CREATE TABLE IF NOT EXISTS product_images
(
    id              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image           VARCHAR(255) NOT NULL UNIQUE,
    product_id      INT          NOT NULL,
    type            ENUM("PRINCIPAL", "ADDITIONAL") NOT NULL,
    additional_order TINYINT,
    FOREIGN KEY (product_id) REFERENCES products(id)
    ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS stock
(
    id         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    product_id INT NOT NULL,
    amount     INT DEFAULT 0,
    size       VARCHAR(20) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE,
    UNIQUE (product_id, size)
);

-- ------ - ----- --
-- ORDERS & SALES --
-- ------ - ----- --

CREATE TABLE IF NOT EXISTS orders
(
    id             INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id        INT  NOT NULL,
    address_id     INT  NOT NULL,
    total_price    DOUBLE(10,2) NOT NULL,
    payment_status ENUM("PENDING", "PAID") NOT NULL DEFAULT "PENDING",
    shipment_status ENUM("PENDING", "SENT") NOT NULL DEFAULT "PENDING",
    created_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (address_id) REFERENCES user_address (id)
);

CREATE TABLE IF NOT EXISTS orders_products
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

CREATE TABLE IF NOT EXISTS faq_types
(
    id            INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `description` VARCHAR(255)
    );

CREATE TABLE IF NOT EXISTS faq_questions
(
    id       INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    type_id  INT NOT NULL,
    question VARCHAR(255) NOT NULL,
    answer   TEXT NOT NULL,
    FOREIGN KEY (type_id) REFERENCES faq_types (id)
    ON DELETE CASCADE
    );

-- ------- --
-- WEBSITE --
-- ------- --

CREATE TABLE IF NOT EXISTS sections
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS featured_items
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    section_id     INT NOT NULL,
    product_id     INT NOT NULL,
    display_order  INT DEFAULT 1,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE (section_id, product_id)
);