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
    <script src="<?= assets('assets/js/ModifiedLocalStorage.js') ?>"></script>
    <script src="<?= assets('checkout/checkout.js', 'app') ?>" type="module" async></script>
</head>
<body>
    <div id="content">
        <div class="card">
            <section>
                Email
            </section>
            <section>
                Dados Pessoais
                Nome CPF
            </section>
            <section>
                Entrega

                CEP com Escolha de tipo de entrega
            </section>
            <section>
                Pagamento
            </section>

            <button class="btn">Finalizar Compra</button>
        </div>
        <div class="card">
            <h2>Siboon Skate Shop</h2>

            <p>Resumo do Pedido</p>
            <ul>
                <li>2x Camisa R$180,00</li>
            </ul>

            <p>TOTAL  R$180,00</p>
        </div>
    </div>
</body>