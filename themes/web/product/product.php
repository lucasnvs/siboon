<?php $this->layout("master", ['title' => $title, "product_id" => $product_id]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('product/product.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('product/product.js') ?>" type="module" async></script>
<?php $this->end(); ?>

<data id="product_id" value="<?= $product_id ?>"></data>
<div id="product-image-container">

</div>

<div id="product-description-container">

</div>