<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= url('assets/icons/siboon-logo-icon.svg') ?>">
    <title> <?=$this->e($title)?> - Siboon Skate Shop </title>
    <link rel="stylesheet" href="<?= url('assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/layout_web.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/cart.css') ?>">
    <?php if ($this->section("specific-style")): ?>
        <?= $this->section("specific-style") ?>
    <?php endif; ?>
    <script src="<?= url('assets/js/Models/CartProduct.js')?>"></script>
    <script src="<?= url('assets/js/ModifiedLocalStorage.js') ?>"></script>
    <script src="<?= url('assets/js/Components/ItemCart.js') ?>"></script>
    <script src="<?= url('assets/js/scripts-master.js') ?>" async></script>
    <?php if ($this->section("specific-script")): ?>
        <?= $this->section("specific-script"); ?>
    <?php endif; ?>
</head>
<body>
    <?php $this->insert('partials/cart') ?>

    <div id="span-top">
        <p>Frete Grátis para compras acima de  R$499,90 via PAC para todo o Brasil.</p>
        <div class="close-x""></div>
    </div>

    <?php $this->insert('partials/header') ?>

    <section id="main">
        <?= $this->section("content") ?>
    </section>

    <?php $this->insert('partials/footer') ?>
</body>
</html>