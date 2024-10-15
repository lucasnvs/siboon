USE siboon_db;

INSERT INTO institutional(`key_unique`, value) VALUES
("company_name", "Siboon Comp. Ltda."),
("company_cnpj", "10.100.100/0001-10"),
("company_street", "Tony Hawk"),
("company_number", "191"),
("company_cep", "10100-100"),
("company_city", "Porto Alegre"),
("company_state", "Rio Grande do Sul");

INSERT INTO users(`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUE
(1, "John", "Doe", "johndoe@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "ADMIN"),
(2, "Carlos", "Silva", "carlossilva@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "USER"),
(3, "Ana", "Souza", "anasouza@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "USER"),
(4, "Pedro", "Oliveira", "pedrooliveira@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "USER"),
(5, "Mariana", "Lima", "marianalima@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "USER"),
(6, "Lucas", "Pereira", "lucaspereira@email.com", "$2y$10$OEKI/tApOKUnD/gt347yEuGiGoQQhtFw1XaRtz2F477MxByJqR9sa", "USER");

INSERT INTO user_address (user_id, cep, street_avenue, number, complement, district, city, state)
VALUES
(1, '12345-678', 'Rua Exemplo', '123', 'Apto 456', 'Bairro Exemplo', 'Cidade Exemplo', 'Estado Exemplo');


INSERT INTO  product_size_type(`name`) VALUES
("Roupa"),
("Sapato"),
("Tamanho Único");

INSERT INTO faq_types(`description`) VALUES
("Vendas"),
("Trocas e Devoluções");

INSERT INTO faq_questions(type_id, question, answer) VALUES
(1, "Como realizar uma compra na Siboon?", 'Para realizar uma compra na Siboon, basta acessar nosso site, escolher o produto desejado e seguir as instruções de pagamento. Aceitamos diversas formas de pagamento como cartão de crédito, boleto bancário e Pix. Após a confirmação do pagamento, enviaremos seu pedido para o endereço cadastrado.'),
(1, "Quais são os métodos de pagamento aceitos?", 'Aceitamos os seguintes métodos de pagamento: cartão de crédito, boleto bancário e Pix. Para mais informações sobre cada método, consulte a página de pagamento no momento da finalização da compra.'),
(1, "Posso parcelar minhas compras?", 'Sim, oferecemos a opção de parcelamento em até 12 vezes no cartão de crédito. As condições de parcelamento podem variar de acordo com o valor da compra e a administradora do cartão.'),
(1, "Qual é o prazo de entrega?", 'O prazo de entrega depende da sua localização e da modalidade de envio escolhida. No momento da finalização da compra, o prazo estimado de entrega será informado com base no seu CEP.'),
(1, "Como acompanho meu pedido?", 'Após a confirmação do pagamento, você receberá um e-mail com as informações para rastreamento do pedido. Também é possível acompanhar o status do seu pedido acessando sua conta no site da Siboon.'),
(2, "Como funciona a troca/devolução de compras na Siboon?", 'A primeira troca é por nossa conta. A troca pode ser efetuada pelo mesmo produto ou um produto de mesmo valor. Todos os pedidos que tem como assunto Troca ou Devolução de compras deve ser comunicado a Siboon pelo e-mail siboon@siboon.com.br seguindo as instruções: Título do e-mail: Pedido "NÚMERO DO SEU PEDIDO" - TROCA/DEVOLUÇÃO/DESISTÊNCIA Exemplo: Pedido E009112OA02 - TROCA. Considerações finais: A Siboon não tem obrigação de consertar, trocar ou restituir produtos que apresentem sinais claros de mau uso. Confira sempre o produto ao recebê-lo. Qualquer problema, entre em contato imediatamente com nosso Serviço de Atendimento ao Consumidor.'),
(2, "Como cancelar uma compra efetuada?", 'Para compras por Boleto Bancário/Pix, basta não efetuar o pagamento do mesmo que o pedido é cancelado automaticamente. Caso tenha efetuado a compra com outro formato de compra ou ter efetuado o pagamento dos modos citados acima, entre em contato com nossa equipe pelo e-mail sac@siboon.com.br seguindo as instruções: Título do e-mail: Pedido "NÚMERO DO SEU PEDIDO" - Cancelamento de compra.'),
(2, "Quanto tempo eu tenho para desistência da compra?", 'Após o recebimento do pedido, você tem 7 dias para desistir da compra.'),
(2, "Quanto tempo eu tenho para trocar meu produto?", 'Após o recebimento do pedido, você tem até 30 dias para solicitar a troca do seu produto. Os produtos devolvidos devem acompanhar a etiqueta fixada no produto. No caso de tênis é obrigatório a devolução da caixa do produto em perfeitas condições levando em consideração que a caixa faz parte do produto.');