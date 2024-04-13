<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icons/siboon-logo-icon.svg">
    <title> Siboon Skate Shop </title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="assets/js/scripts-master.js" async></script>
</head>
<body>
    <div id="background-cart" class="background-blur">
        <div id="cart-body">
            <div id="cart-header">
                <p>Carrinho  <span>(0 itens)</span></p>
                <div id="close-cart" class="close-x" style="background-color: gray"></div>
            </div>
        </div>
    </div>

    <div id="span-top">
        <p>Frete Grátis para compras acima de  R$499,90 via PAC para todo o Brasil.</p>
        <div class="close-x""></div>
    </div>
    <header>
        <div id="menu-button">
            <img src="assets/icons/menu.svg">
        </div>

        <div id="mid-menu">
            <ul>
                <li><a href=" <?= url() ?>">tênis</a></li>
                <li><a href="<?= url() ?>">skate</a></li>
                <li><a href="<?= url() ?>">vestuário</a></li>
                <li><a href="<?= url() ?>"><img src="assets/icons/siboon-logo-name.svg" style="width: 180px;height: 90px"></a></li>
                <li><a href="<?= url() ?>">sale</a></li>
                <li><a href="<?= url() ?>">novidades</a></li>
                <li><a href="<?= url() ?>">marcas</a></li>
            </ul>
        </div>

        <div id="option-menu">
            <img src="assets/icons/search.svg">
            <a href="<?= url("entrar") ?>"><img src="assets/icons/user.svg"></a>
            <img id="cart-button" src="assets/icons/shopping-bag.svg">
        </div>
    </header>

    <?= $this->section("content") ?>

    <footer>
        <div>
            <h3>Ajuda</h3>
            <br>
            <p><a href="<?= url("contato") ?>">Contato</a></p>
            <br>
            <p><a href="<?= url("sobre") ?>">Sobre</a></p>
            <br>
            <p><a href="<?= url("faq") ?>">FAQ</a></p>
        </div>
        <div id="footer-logo-info">
            <img src="assets/icons/siboon-logo-name.svg">
            <p>Siboon Comp. Ltda. Cnpj: 10.100.100/0001-10</p>
            <p>Rua Tony Hawk, 191. Cep: 10100-100.</p>
            <p>Porto Alegre, Rio Grande do Sul.</p>
        </div>
        <div>
            <h3>Formas de Pagamento</h3>

            <h3>Formas de Entrega</h3>
            <img src="assets/imgs/logo-correio.jpg">
            <img src="assets/imgs/logo-pac.jpg">
            <img src="assets/imgs/logo-sedex.jpg">
        </div>
    </footer>
</body>
</html>