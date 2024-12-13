<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= assets('assets/icons/siboon-logo-icon.svg') ?>">
    <title> <?=$this->e($title)?> - Siboon Skate Shop </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet" href="<?= assets('assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= assets('checkout/checkout.css', 'app') ?>">
    <script src="<?= assets('checkout/checkout.js', 'app') ?>" type="module" async></script>
</head>
<body>
<div class="container">

    <!-- Conteúdo Principal -->
    <div class="content">

        <!-- Formulário de Checkout (Lado Esquerdo) -->
        <div class="checkout-section">
            <div class="checkout-header">
                <h1>Finalizar Compra</h1>
                <p>Complete suas informações de entrega e pagamento</p>
            </div>

            <div class="checkout-section">
                <!-- Cadastro de Usuário -->
                <div class="section-header">
                    <div class="icon">👤</div>
                    <h2>Meu Cadastro</h2>
                </div>
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" class="form-input" placeholder="Digite seu nome completo">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" class="form-input" placeholder="Digite seu e-mail">
                </div>

                <!-- Informações de Entrega -->
                <div class="section-header">
                    <div class="icon">🚚</div>
                    <h2>Informações de Entrega</h2>
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <div style="display: flex; gap: 8px">
                        <select id="address-select" class="form-input"></select>
                        <button id="add-address-button" class="btn">Adicionar novo endereço</button>
                    </div>
<!--                    <input type="text" id="address" class="form-input" placeholder="Digite seu endereço completo">-->
                </div>
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" class="form-input" placeholder="Digite seu CEP">
                </div>

                <!-- Métodos de Pagamento -->
                <div class="section-header">
                    <div class="icon">💳</div>
                    <h2>Forma de Pagamento</h2>
                </div>
                <div class="payment-methods">
                    <label class="payment-method">
                        <input type="radio" name="payment" value="credit">
                        <img src="https://cdn-icons-png.flaticon.com/512/216/216477.png" alt="Cartão de Crédito">
                        Cartão de Crédito
                    </label>
                    <label class="payment-method">
                        <input type="radio" name="payment" value="pix">
                        <img src="https://cdn-icons-png.flaticon.com/512/5968/5968631.png" alt="Pix">
                        Pix
                    </label>
                    <label class="payment-method">
                        <input type="radio" name="payment" value="boleto">
                        <img src="https://cdn-icons-png.flaticon.com/512/6124/6124357.png" alt="Boleto">
                        Boleto
                    </label>
                </div>

                <div class="payment-box">
                    <div id="credit-card-info">
                        <div class="form-group">
                            <label for="card">Número do Cartão</label>
                            <input class="default-input" type="text" id="card" name="card" placeholder="Digite o número do seu cartão">
                        </div>
                        <div class="form-group">
                            <label for="expiry">Data de Expiração</label>
                            <input class="default-input" type="text" id="expiry" name="expiry" placeholder="MM/AA">
                        </div>
                        <div class="form-group">
                            <label for="cvv">Código de Segurança (CVV)</label>
                            <input class="default-input" type="text" id="cvv" name="cvv" placeholder="Digite o CVV">
                        </div>
                    </div>

                    <!-- PIX -->
                    <div id="pix-info" style="display:none;">
                        <p>Após finalizar, você receberá um QR Code para realizar o pagamento via Pix.</p>
                    </div>

                    <!-- Boleto -->
                    <div id="boleto-info" style="display:none;">
                        <p>O boleto será gerado e você poderá pagá-lo em qualquer banco ou app.</p>
                    </div>
                </div>
        </div>
    </div>
        <div class="summary-section">
            <div class="section-title">Resumo do Pedido</div>
            <div id="summary" class="summary">
                <!-- Resumo do pedido aqui -->
            </div>

            <!-- Botão de Finalização -->
            <button id="checkout-button" class="btn" style="width: 100%; margin-top: 10px">Finalizar Pedido</button>
        </div>
    </div>
</div>
</body>
</html>