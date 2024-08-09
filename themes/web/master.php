<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= assets('assets/icons/siboon-logo-icon.svg') ?>">
    <title> <?=$this->e($title)?> - Siboon Skate Shop </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet" href="<?= assets('assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= assets('assets/css/layout_web.css') ?>">
    <link rel="stylesheet" href="<?= assets('assets/css/cart.css') ?>">
    <link rel="stylesheet" href="<?= assets('components/InputQuantity/InputQuantity.css','shared') ?>">
    <?php if ($this->section("specific-style")): ?>
        <?= $this->section("specific-style") ?>
    <?php endif; ?>
    <script src="<?= assets('assets/js/Models/CartProduct.js')?>"></script>
    <script src="<?= assets('assets/js/ModifiedLocalStorage.js') ?>"></script>
    <script type="module" src="<?= assets('assets/js/scripts-master.js') ?>" async></script>
    <?php if ($this->section("specific-script")): ?>
        <?= $this->section("specific-script"); ?>
    <?php endif; ?>
</head>
<body>
    <div id="background-cart" class="background-blur"> <!-- cart -->
        <div id="cart-body">
            <div id="cart-header">
                <p>Carrinho  <span id="span-cart-quantity">(0 itens)</span></p>
                <div id="close-cart" class="close-x" style="background-color: gray"></div>
            </div>
            <div id="cart-catalog">
                <div class="item-cart">
                    <img src="<?= assets("assets/imgs/black-tshirt.jpg") ?>" alt="Imagem de ...">
                    <div class="item-cart-desc">
                        <h2>Tênis Tesla Shine Black Reflect</h2>
                        <p>Cor: Black Reflect | Tamanho: 38</p>
                        <p>R$ 320,00</p>

                        <!-- input quantity number -->
                        <!-- button icon trash -->
                    </div>
                </div>
            </div>
            <div id="cart-info">
                <div class="info row">
                    <p>Subtotal</p>
                    <h5>R$ 699,82</h5>
                </div>
                <div class="info col">
                    <p>Frete - Digite seu CEP</p>
                    <div class="input-container">
                        <input class="default-input" type="text" id="cep" placeholder="Digite seu CEP">
                        <button>Calcular</button>
                    </div>
                </div>

                <button class="btn">FAZER PEDIDO R$ 699,82</button>
            </div>
        </div>
    </div>

    <div id="span-top">
        <p>Frete Grátis para compras acima de  R$499,90 via PAC para todo o Brasil.</p>
        <div class="close-x""></div>
    </div>

    <header>
        <div id="menu-button">
            <img src="<?= assets('assets/icons/menu.svg') ?>">
        </div>

        <div id="mid-menu">
            <ul>
                <li><a href=" <?= url("secao/tenis") ?>">TÊNIS</a></li>
                <li><a href="<?= url("secao/skate") ?>">SKATE</a></li>
                <li><a href="<?= url("secao/vestuario") ?>">VESTUÁRIO</a></li>
                <li><a href="<?= url() ?>"><img src="<?= assets('assets/icons/siboon-logo.png') ?>" style="width: 180px;height: 90px"></a></li>
                <li><a href="<?= url("secao/sale") ?>">SALE</a></li>
                <li><a href="<?= url("secao/novidades") ?>">NOVIDADES</a></li>
                <li><a href="<?= url() ?>">MARCAS</a></li>
            </ul>
        </div>

        <div id="option-menu">
            <i class="material-symbols-outlined">search</i>
<!--            <img src="--><?php //= assets('assets/icons/search.svg') ?><!--">-->
            <?php if (isset($loggedUser)): ?>
                <a href="<?= url("/app/perfil") ?>"><i class="material-symbols-outlined">account_circle</i></a>
                <?php else: ?>
                <a href="<?= url("entrar") ?>"><i class="material-symbols-outlined">account_circle</i></a>
            <?php endif; ?>
            <i id="cart-button" class="material-symbols-outlined">shopping_bag</i>
        </div>
    </header>

    <section id="main">
        <?= $this->section("content") ?>
    </section>

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
            <img src="<?= assets('assets/icons/siboon-logo.png') ?>">
            <p>Siboon Comp. Ltda. Cnpj: 10.100.100/0001-10</p>
            <p>Rua Tony Hawk, 191. Cep: 10100-100.</p>
            <p>Porto Alegre, Rio Grande do Sul.</p>
        </div>
        <div>
            <h3>Formas de Pagamento</h3>

            <h3>Formas de Entrega</h3>
            <img src="<?= assets('assets/imgs/logo-correio.jpg') ?>">
            <img src="<?= assets('assets/imgs/logo-pac.jpg') ?>">
            <img src="<?= assets('assets/imgs/logo-sedex.jpg') ?>">
        </div>
    </footer>

</body>
</html>