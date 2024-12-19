-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 04:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siboon_db`
--

CREATE DATABASE IF NOT EXISTS siboon_db;
USE siboon_db;
-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq_questions`
--

INSERT INTO `faq_questions` (`id`, `type_id`, `question`, `answer`) VALUES
(1, 1, 'Como realizar uma compra na Siboon?', 'Para realizar uma compra na Siboon, basta acessar nosso site, escolher o produto desejado e seguir as instruções de pagamento. Aceitamos diversas formas de pagamento como cartão de crédito, boleto bancário e Pix. Após a confirmação do pagamento, enviaremos seu pedido para o endereço cadastrado.'),
(2, 1, 'Quais são os métodos de pagamento aceitos?', 'Aceitamos os seguintes métodos de pagamento: cartão de crédito, boleto bancário e Pix. Para mais informações sobre cada método, consulte a página de pagamento no momento da finalização da compra.'),
(3, 1, 'Posso parcelar minhas compras?', 'Sim, oferecemos a opção de parcelamento em até 12 vezes no cartão de crédito. As condições de parcelamento podem variar de acordo com o valor da compra e a administradora do cartão.'),
(4, 1, 'Qual é o prazo de entrega?', 'O prazo de entrega depende da sua localização e da modalidade de envio escolhida. No momento da finalização da compra, o prazo estimado de entrega será informado com base no seu CEP.'),
(5, 1, 'Como acompanho meu pedido?', 'Após a confirmação do pagamento, você receberá um e-mail com as informações para rastreamento do pedido. Também é possível acompanhar o status do seu pedido acessando sua conta no site da Siboon.'),
(6, 2, 'Como funciona a troca/devolução de compras na Siboon?', 'A primeira troca é por nossa conta. A troca pode ser efetuada pelo mesmo produto ou um produto de mesmo valor. Todos os pedidos que tem como assunto Troca ou Devolução de compras deve ser comunicado a Siboon pelo e-mail siboon@siboon.com.br seguindo as instruções: Título do e-mail: Pedido \"NÚMERO DO SEU PEDIDO\" - TROCA/DEVOLUÇÃO/DESISTÊNCIA Exemplo: Pedido E009112OA02 - TROCA. Considerações finais: A Siboon não tem obrigação de consertar, trocar ou restituir produtos que apresentem sinais claros de mau uso. Confira sempre o produto ao recebê-lo. Qualquer problema, entre em contato imediatamente com nosso Serviço de Atendimento ao Consumidor.'),
(7, 2, 'Como cancelar uma compra efetuada?', 'Para compras por Boleto Bancário/Pix, basta não efetuar o pagamento do mesmo que o pedido é cancelado automaticamente. Caso tenha efetuado a compra com outro formato de compra ou ter efetuado o pagamento dos modos citados acima, entre em contato com nossa equipe pelo e-mail sac@siboon.com.br seguindo as instruções: Título do e-mail: Pedido \"NÚMERO DO SEU PEDIDO\" - Cancelamento de compra.'),
(8, 2, 'Quanto tempo eu tenho para desistência da compra?', 'Após o recebimento do pedido, você tem 7 dias para desistir da compra.'),
(9, 2, 'Quanto tempo eu tenho para trocar meu produto?', 'Após o recebimento do pedido, você tem até 30 dias para solicitar a troca do seu produto. Os produtos devolvidos devem acompanhar a etiqueta fixada no produto. No caso de tênis é obrigatório a devolução da caixa do produto em perfeitas condições levando em consideração que a caixa faz parte do produto.');

-- --------------------------------------------------------

--
-- Table structure for table `faq_types`
--

CREATE TABLE `faq_types` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq_types`
--

INSERT INTO `faq_types` (`id`, `description`) VALUES
(1, 'Vendas'),
(2, 'Trocas e Devoluções');

-- --------------------------------------------------------

--
-- Table structure for table `featured_items`
--

CREATE TABLE `featured_items` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `display_order` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured_items`
--

INSERT INTO `featured_items` (`id`, `section_id`, `product_id`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2024-12-19 07:22:17', '2024-12-19 03:22:17'),
(2, 1, 4, 0, '2024-12-19 07:22:28', '2024-12-19 03:22:28'),
(4, 1, 5, 0, '2024-12-19 07:22:48', '2024-12-19 03:22:48'),
(5, 2, 3, 0, '2024-12-19 07:22:55', '2024-12-19 03:22:55'),
(6, 2, 6, 0, '2024-12-19 07:26:17', '2024-12-19 03:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `institutional`
--

CREATE TABLE `institutional` (
  `id` int(11) NOT NULL,
  `key_unique` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutional`
--

INSERT INTO `institutional` (`id`, `key_unique`, `value`) VALUES
(1, 'company_name', 'Siboon Comp. Ltda.'),
(2, 'company_cnpj', '10.100.100/0001-10'),
(3, 'company_street', 'Tony Hawk'),
(4, 'company_number', '191'),
(5, 'company_cep', '10100-100'),
(6, 'company_city', 'Porto Alegre'),
(7, 'company_state', 'Rio Grande do Sul');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `payment_status` enum('PENDING','PAID') NOT NULL DEFAULT 'PENDING',
  `shipment_status` enum('PENDING','SENT') NOT NULL DEFAULT 'PENDING',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(100) NOT NULL,
  `size_type_id` int(11) NOT NULL,
  `price_brl` double(10,2) NOT NULL DEFAULT 0.00,
  `max_installments` tinyint(4) NOT NULL DEFAULT 1,
  `discount_brl_percentage` tinyint(4) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `color`, `size_type_id`, `price_brl`, `max_installments`, `discount_brl_percentage`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s T-Shirt Opus Dot Stripe (Sea Kelp)', 'Estilo urbano e confortável, perfeita para o dia a dia ou para sessões de skate. Feita em tecido leve e respirável, proporciona liberdade de movimento e durabilidade. Estampa moderna e autêntica, ideal para quem busca destacar seu estilo na pista ou na rua.', 'SEA KELP', 1, 120.00, 6, 8, '2024-12-19 03:57:08', '2024-12-19 04:02:42'),
(3, 'CAMISETA BARRA CREW AHLMA ESPECTRO PRETA', 'Estilo urbano e confortável, perfeita para o dia a dia ou para sessões de skate. Feita em tecido leve e respirável, proporciona liberdade de movimento e durabilidade. Estampa moderna e autêntica, ideal para quem busca destacar seu estilo na pista ou na rua.', 'Preto', 1, 220.00, 8, 8, '2024-12-19 04:04:05', '2024-12-19 00:04:05'),
(4, 'Boné High 6 Panel Battery Green', 'Complemente seu look com um boné estiloso e funcional. Ajustável para um encaixe perfeito, ele protege do sol enquanto adiciona atitude ao visual. Um acessório indispensável para skatistas que não abrem mão do estilo.', 'Verde', 3, 179.00, 8, 5, '2024-12-19 04:13:40', '2024-12-19 00:13:40'),
(5, 'CALCA TUPODE OG BAGGY STONE BLACK', 'Desenvolvida para acompanhar suas manobras, esta calça oferece resistência e flexibilidade. Com design ajustado, bolsos funcionais e tecido de alta qualidade, é ideal para enfrentar o dia com conforto e estilo, seja no rolê ou na pista.', 'Preto', 1, 439.00, 12, 10, '2024-12-19 04:21:53', '2024-12-19 00:21:53'),
(6, 'BONE HIGH 6 PANEL LOGO BLACK GREEN', 'Complemente seu look com um boné estiloso e funcional. Ajustável para um encaixe perfeito, ele protege do sol enquanto adiciona atitude ao visual. Um acessório indispensável para skatistas que não abrem mão do estilo.', 'Preto', 3, 199.00, 10, 5, '2024-12-19 04:25:52', '2024-12-19 00:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` enum('PRINCIPAL','ADDITIONAL') NOT NULL,
  `additional_order` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image`, `product_id`, `type`, `additional_order`) VALUES
(1, 'storage/images/products/1/principal-image.jpg', 1, 'PRINCIPAL', NULL),
(2, 'storage/images/products/1/additional-image-1.jpg', 1, 'ADDITIONAL', 1),
(3, 'storage/images/products/3/principal-image.jpg', 3, 'PRINCIPAL', NULL),
(4, 'storage/images/products/4/principal-image.jpg', 4, 'PRINCIPAL', NULL),
(5, 'storage/images/products/4/additional-image-1.jpg', 4, 'ADDITIONAL', 1),
(6, 'storage/images/products/4/additional-image-1-1734578022.jpg', 4, 'ADDITIONAL', 1),
(7, 'storage/images/products/5/principal-image.jpg', 5, 'PRINCIPAL', NULL),
(8, 'storage/images/products/5/additional-image-1.jpg', 5, 'ADDITIONAL', 1),
(9, 'storage/images/products/5/additional-image-1-1734578513.jpg', 5, 'ADDITIONAL', 1),
(10, 'storage/images/products/6/principal-image.jpg', 6, 'PRINCIPAL', NULL),
(11, 'storage/images/products/6/additional-image-1.jpg', 6, 'ADDITIONAL', 1),
(12, 'storage/images/products/6/additional-image-1-1734578753.jpg', 6, 'ADDITIONAL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_size_type`
--

CREATE TABLE `product_size_type` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_size_type`
--

INSERT INTO `product_size_type` (`id`, `name`) VALUES
(1, 'Roupa'),
(2, 'Sapato'),
(3, 'Tamanho Único');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Em Alta', '2024-12-19 07:22:05', '2024-12-19 03:22:05'),
(2, 'Destaques', '2024-12-19 07:22:09', '2024-12-19 03:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT 0,
  `size` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `role` enum('CLIENT','ADMIN') NOT NULL DEFAULT 'CLIENT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `img`, `role`) VALUES
(1, 'John', 'Doe', 'johndoe@email.com', '$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa', NULL, 'ADMIN'),
(2, 'Carlos', 'Silva', 'carlossilva@email.com', '$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa', NULL, ''),
(3, 'Ana', 'Souza', 'anasouza@email.com', '$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa', NULL, ''),
(4, 'Pedro', 'Oliveira', 'pedrooliveira@email.com', '$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa', NULL, ''),
(5, 'Mariana', 'Lima', 'marianalima@email.com', '$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa', NULL, ''),
(6, 'Lucas', 'Pereira', 'lucaspereira@email.com', '$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `street_avenue` varchar(255) NOT NULL,
  `number` varchar(10) NOT NULL,
  `complement` varchar(255) DEFAULT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `cep`, `street_avenue`, `number`, `complement`, `district`, `city`, `state`) VALUES
(1, 1, '12345-678', 'Rua Exemplo', '123', 'Apto 456', 'Bairro Exemplo', 'Cidade Exemplo', 'Estado Exemplo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `faq_types`
--
ALTER TABLE `faq_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_items`
--
ALTER TABLE `featured_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_id` (`section_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `institutional`
--
ALTER TABLE `institutional`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_unique` (`key_unique`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_type_id` (`size_type_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image` (`image`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_size_type`
--
ALTER TABLE `product_size_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`size`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faq_types`
--
ALTER TABLE `faq_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `featured_items`
--
ALTER TABLE `featured_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institutional`
--
ALTER TABLE `institutional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_size_type`
--
ALTER TABLE `product_size_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD CONSTRAINT `faq_questions_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `faq_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `featured_items`
--
ALTER TABLE `featured_items`
  ADD CONSTRAINT `featured_items_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `featured_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `user_address` (`id`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`size_type_id`) REFERENCES `product_size_type` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
