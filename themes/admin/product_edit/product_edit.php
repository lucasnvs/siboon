<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('product_edit/product_edit.css', 'admin') ?>">
<link rel="stylesheet" href="<?= assets('components/InputQuantity/InputQuantity.css', 'shared') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('product_edit/product_edit.js', 'admin') ?>" async></script>
<?php $this->end(); ?>

<div class="col big">
    <div  class="input-container">
        <label>Quais tamanhos estão disponiveis?</label>
        <div id="available-sizes">
            <h4>Por favor selecione um tipo de tamanho.</h4>
        </div>
    </div>
    <div class="input-container">
        <label>Quantidades por tamanho:</label>
        <div id="product-quantity-by-size">
        </div>
    </div>
</div>