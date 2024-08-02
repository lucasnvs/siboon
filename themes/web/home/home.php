<?php $this->layout("master", ['title' => $title, 'products' => $products]); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('home/scripts-home.js') ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('home/home.css') ?>">
<link rel="stylesheet" href="<?= assets('components/ProductItem/ProductItem.css', 'shared') ?>">
<?php $this->end(); ?>

<section class="main">
    <div class="banner">
        <img src="<?= assets('assets/imgs/background.png') ?>">
    </div>
    <!-- banner -->
    <!-- seção rápida scroll horizontal -->
    <!-- seção rápida (talvez por marcas)-->
    <section class="section-products">
        <h2>EM ALTA</h2>
        <div class="container-grid-section">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <?php $this->insert('shared::components/ProductItem/ProductItem', ['product' => $product]) ?>
                <?php endforeach ?>
            <?php endif; ?>
        </div>
    </section>
    <!-- banner -->

</section>