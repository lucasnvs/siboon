<?php $this->layout("master", ['title' => $title, 'product' => $product]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('product/product.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('product/product.js') ?>" type="module" async></script>
<?php $this->end(); ?>

<div id="product-image-container">
    <div class="side-images-container">
        <img src="<?= url($product["res_path"]) ?>" class="side-image">
        <img src="<?= url($product["res_path"]) ?>" class="side-image">
        <img src="<?= url($product["res_path"]) ?>" class="side-image">
        <img src="<?= url($product["res_path"]) ?>" class="side-image">
    </div>
    <img src="<?= url($product["res_path"]) ?>"  id="principal-image">
</div>

<div id="product-description-container">
    <h2><?= $product["name"] ?></h2>
    <p><?= $product["formated_price_brl"] ?></p>
    <p>ou até 3x de <?= "R$ ".number_format($product["price_brl"] / 3, 2, ",", ".") ?></p>

    <p><?= $product["description"] ?></p>

    <p>TAMANHO</p>
    <div class="sizes">
        <button class="size">P</button>
        <button class="size">M</button>
        <button class="size">G</button>
        <button class="size">GG</button>
    </div>

    <div id="quantity-container">
        <p>QUANTIDADE</p>
    </div>
    <button class="btn">COMPRAR</button>

</div>