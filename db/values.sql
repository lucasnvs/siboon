USE siboon_db;

INSERT INTO institutional(`key`, value) VALUES
("company_name", "Siboon Comp. Ltda."),
("company_cnpj", "10.100.100/0001-10"),
("company_street", "Tony Hawk"),
("company_number", "191"),
("company_cep", "10100-100"),
("company_city", "Porto Alegre"),
("company_state", "Rio Grande do Sul");

INSERT INTO users(`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUE
(1, "John", "Doe", "johndoe@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "ADMIN");

INSERT INTO faq_types(`description`) VALUES
("Vendas"),
("Trocas e Devoluções");

INSERT INTO  product_size_type(`name`) VALUES
("Roupa"),
("Sapato"),
("Tamanho Único");

INSERT INTO faq_questions(type_id, question, answer) VALUES
(2, "Como funciona a troca/devolução de compras na Siboon?", 'A primeira troca é por nossa conta. A troca pode ser efetuada pelo mesmo produto ou um produto de mesmo valor. Todos os pedidos que tem como assunto Troca ou Devolução de compras deve ser comunicado a Siboon pelo e-mail siboon@siboon.com.br seguindo as instruções: Título do e-mail: Pedido "NÚMERO DO SEU PEDIDO" - TROCA/DEVOLUÇÃO/DESISTÊNCIA Exemplo: Pedido E009112OA02 - TROCA. Considerações finais: A Siboon não tem obrigação de consertar, trocar ou restituir produtos que apresentem sinais claros de mau uso. Confira sempre o produto ao recebê-lo. Qualquer problema, entre em contato imediatamente com nosso Serviço de Atendimento ao Consumidor.'),
(2, "Como cancelar uma compra efetuada?", 'Para compras por Boleto Bancário/Pix, basta não efetuar o pagamento do mesmo que o pedido é cancelado automaticamente. Caso tenha efetuado a compra com outro formato de compra ou ter efetuado o pagamento dos modos citados acima, entre em contato com nossa equipe pelo e-mail sac@siboon.com.br seguindo as instruções: Título do e-mail: Pedido "NÚMERO DO SEU PEDIDO" - Cancelamento de compra.'),
(2, "Quanto tempo eu tenho para desistência da compra?", 'Após o recebimento do pedido, você tem 7 dias para desistir da compra.'),
(2, "Quanto tempo eu tenho para trocar meu produto?", 'Após o recebimento do pedido, você tem até 30 dias para solicitar a troca do seu produto. Os produtos devolvidos devem acompanhar a etiqueta fixada no produto. No caso de tênis é obrigatório a devolução da caixa do produto em perfeitas condições levando em consideração que a caixa faz parte do produto.');