<?php $this->layout("master", ['title' => $title, "product_id" => $product_id]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('product/product.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('product/product.js') ?>" type="module" async></script>
<?php $this->end(); ?>

<data id="product_id" value="<?= $product_id ?>"></data>

<main id="main">
    <div id="product-image-container">

    </div>

    <div id="product-description-container">
        <h1>Carregando...</h1>
        <p>Carregando...</p>
        <p class="price">R$ ...</p>
        <button class="add-to-cart-btn">Adicionar ao Carrinho</button>
    </div>
</main>