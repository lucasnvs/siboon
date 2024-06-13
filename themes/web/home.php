<?php $this->layout("master", ['title' => $title, 'products' => $products]); ?>
<?php $this->start("specific-script"); ?>
    <script src="<?= assets('web', 'js/scripts-home.js') ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('web', 'css/home.css') ?>">
    <link rel="stylesheet" href="<?= assets('web', 'css/components/product-item.css') ?>">
<?php $this->end(); ?>

<section class="main">
    <div class="banner">
        <img src="<?= assets('web', 'imgs/background.png') ?>">
    </div>
    <!-- banner -->
    <!-- seção rápida scroll horizontal -->
    <!-- seção rápida (talvez por marcas)-->
    <section class="section-products">
        <h2>EM ALTA</h2>
        <div class="container-grid-section">
            <?php foreach($products as $product): ?>
                <?php $this->insert('components/product-item', ['product' => $product]) ?>
            <?php endforeach ?>

        </div>
    </section>
    <!-- banner -->


</section>