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
            <div class="checkout-title">Finalizar Compra - Siboon SkateShop</div>

            <!-- Informações de Entrega -->
            <div class="section-title">Informações de Entrega</div>

            <div class="form-group">
                <label for="name">Nome Completo</label>
                <div class="input-container">
                    <input type="text" id="name" name="name" placeholder="Digite seu nome completo" disabled>
                    <button class="unlock-button">🔒</button>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Endereço</label>
                <div class="input-container">
                    <input type="text" id="address" name="address" placeholder="Digite seu endereço" disabled>
                    <button class="unlock-button">🔒</button>
                </div>
            </div>

            <div class="form-group">
                <label for="city">Cidade</label>
                <div class="input-container">
                    <input type="text" id="city" name="city" placeholder="Digite sua cidade" disabled>
                    <button class="unlock-button">🔒</button>
                </div>
            </div>

            <!-- Frete -->
            <div class="form-group">
                <label for="cep-frete">CEP</label>
                <div class="input-container">
                    <input type="text" id="cep-frete" name="zip" placeholder="Digite seu CEP" disabled>
                    <button class="unlock-button">🔒</button>
                </div>
            </div>
            <button id="btn-cep-frete" class="frete-button">Calcular Frete</button>

            <!-- Informações de Pagamento -->
            <div class="section-title">Informações de Pagamento</div>
            <div class="form-group">
                <label for="payment-method">Forma de Pagamento</label>
                <select id="payment-method" name="payment-method">
                    <option value="credit-card">Cartão de Crédito</option>
                    <option value="pix">Pix</option>
                    <option value="boleto">Boleto</option>
                </select>
            </div>

            <!-- Cartão de Crédito -->
            <div id="credit-card-info">
                <div class="form-group">
                    <label for="card">Número do Cartão</label>
                    <input type="text" id="card" name="card" placeholder="Digite o número do seu cartão">
                </div>
                <div class="form-group">
                    <label for="expiry">Data de Expiração</label>
                    <input type="text" id="expiry" name="expiry" placeholder="MM/AA">
                </div>
                <div class="form-group">
                    <label for="cvv">Código de Segurança (CVV)</label>
                    <input type="text" id="cvv" name="cvv" placeholder="Digite o CVV">
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

        <!-- Resumo do Pedido (Lado Direito) -->
        <div class="summary-section">
            <div class="section-title">Resumo do Pedido</div>
            <div id="summary" class="summary">

            </div>

            <!-- Botão de Finalização -->
            <button class="checkout-button">Finalizar Pedido</button>
        </div>

    </div>

</div>
</body>