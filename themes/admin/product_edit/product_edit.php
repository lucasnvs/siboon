<?php $this->layout("master", ['title' => $title, "productId" => $productId]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('product_register/product_register.css', 'admin') ?>">
<link rel="stylesheet" href="<?= assets('product_edit/product_edit.css', 'admin') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('product_edit/product_edit.js', 'admin') ?>" async></script>
<?php $this->end(); ?>

<header id="header" data-id="<?= $productId ?>">
    <a href="<?= url("admin/produtos") ?>">
        <i class="material-symbols-outlined">arrow_back</i>
        Voltar
    </a>

    <h2>Editando Produto</h2>

    <div class="options">
        <button id="delete-product" class="btn red">Deletar Produto</button>
        <button id="edit-product" class="btn green">Editar</button>
    </div>
</header>

<section>
    <div class="images">
        <div class="input-container">
            <div class="container-img">
                <input type="file" id="product-image">
                <label class="product-image-label" for="product-image"><img class="image-view" src="<?= assets("assets/imgs/example.jpg", "admin")?>"></label>
            </div>
        </div>

        <div class="additional-images">
            <div class="input-container">
                <div class="container-img">
                    <input type="file" id="product-image-additional-1">
                    <label class="product-image-label" for="product-image-additional-1"><img class="image-view" src="<?= assets("assets/imgs/example.jpg", "admin")?>"></label>
                </div>
            </div>
            <div class="input-container">
                <div class="container-img">
                    <input type="file" id="product-image-additional-2">
                    <label class="product-image-label" for="product-image-additional-2"><img class="image-view" src="<?= assets("assets/imgs/example.jpg", "admin")?>"></label>
                </div>
            </div>
            <div class="input-container">
                <div class="container-img">
                    <input type="file" id="product-image-additional-3">
                    <label class="product-image-label" for="product-image-additional-3"><img class="image-view" src="<?= assets("assets/imgs/example.jpg", "admin")?>"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="input-container">
            <label for="product-name">Nome do Produto:</label>
            <input class="default-input" type="text" id="product-name">
        </div>
        <div class="input-container">
            <label for="product-description">Descrição:</label>
            <textarea id="product-description" rows="12" cols="10"></textarea>
        </div>
    </div>
    <div class="col">
        <div class="input-container">
            <label for="product-price-brl">Preço BRL:</label>
            <input class="default-input" type="text" id="product-price-brl">
        </div>
        <div class="input-container">
            <label for="product-color">Cor:</label>
            <input class="default-input" type="text" id="product-color">
        </div>
        <div class="input-container">
            <label for="product-size-type-id">Tipo de Tamanho:</label>
            <select id="product-size-type-id">
                <option disabled selected>Selecione o tipo</option>
                <option value="1">Roupa Ex.: PP, P, M, G, GG, X, XX, XXL</option>
                <option value="2">Sapato Ex.: 34, 35, 36...42, 43, 44</option>
                <option value="3">Tamanho Único</option>
            </select>
        </div>
    </div>
    <div class="col">
        <div class="input-container">
            <label for="product-max-installments">Limite de parcelas:</label>
            <select id="product-max-installments">
                <option selected value="1">1x</option>
                <option value="2">2x</option>
                <option value="3">3x</option>
                <option value="4">4x</option>
                <option value="5">5x</option>
                <option value="6">6x</option>
                <option value="7">7x</option>
                <option value="8">8x</option>
                <option value="9">9x</option>
                <option value="10">10x</option>
                <option value="11">11x</option>
                <option value="12">12x</option>
            </select>
        </div>
        <div class="input-container">
            <label for="product-discount-brl-percentage">Desconto % no PIX:</label>
            <input class="default-input" type="text" id="product-discount-brl-percentage">
        </div>
    </div>
</section>