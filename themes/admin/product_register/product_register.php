<?php $this->layout("master"); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('css/product_register.css', 'admin') ?>">
    <link rel="stylesheet" href="<?= assets('components/InputQuantity/InputQuantity.css', 'shared') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
    <script type="module" src="<?= assets('product_register/product_register.js', 'admin') ?>" async></script>
<?php $this->end(); ?>

<a href="<?= url("admin/produtos") ?>"> <- Voltar</a>

<br><br><br>

<div id="form">
    <div class="row"> <!-- Row 1 -->
        <div class="col"> <!-- Col 1-->
            <div class="input-container">
                <label for="product-name">Nome do Produto:</label>
                <input class="default-input" type="text" id="product-name">
            </div>
            <div class="input-container">
                <label for="product-description">Descrição:</label>
                <textarea id="product-description" rows="8" cols="10"></textarea>
            </div>
        </div>
        <div class="col">  <!-- Col 2 -->
            <div class="input-container">
                <label for="product-color">Cor:</label>
                <input class="default-input" type="text" id="product-color">
            </div>
            <div class="input-container">
                <label for="product-size-type">Tipo de Tamanho:</label>
                <select id="product-size-type">
                    <option disabled selected>Selecione o tipo</option>
                    <option value="cloth">Roupa Ex.: PP, P, M, G, GG, X, XX, XXL</option>
                    <option value="shoes">Sapato Ex.: 34, 35, 36...42, 43, 44</option>
                    <option value="unique">Tamanho Único</option>
                </select>
            </div>
            <div  class="input-container">
                <label>Quais tamanhos estão disponiveis?</label>
                <div id="available-sizes">
                    <h4>Por favor selecione um tipo de tamanho.</h4>
                </div>
            </div>
            <div class="input-container">
                <label>Quantidades por tamanho:</label>
                <div id="product-quantity-by-size">
                    <div class="row">
                        <label>P</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>