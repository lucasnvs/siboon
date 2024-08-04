<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('home/scripts-home.js') ?>" type="module" async></script>
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

        </div>
    </section>
    <!-- banner -->

</section>