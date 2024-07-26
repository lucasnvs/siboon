<?php $this->layout("master"); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('product_register/product_register.css', 'admin') ?>">
    <link rel="stylesheet" href="<?= assets('components/InputQuantity/InputQuantity.css', 'shared') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
    <script type="module" src="<?= assets('product_register/product_register.js', 'admin') ?>" async></script>
<?php $this->end(); ?>

<header>
    <a href="<?= url("admin/produtos") ?>">
        <i class="material-symbols-outlined">arrow_back</i>
        Voltar
    </a>

    <div class="options">
        <button id="clear-form" class="btn red">Limpar</button>
        <button id="create-product" class="btn green">Salvar Produto</button>
    </div>
</header>

<section>
    <div class="row">
        <div class="input-container">
            <div class="container-img">
                <input type="file" id="product-image">
                <label for="product-image"><img id="image-view" src="<?= assets("assets/imgs/example.jpg", "admin")?>"></label>
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
                <label for="product-price">Preço BRL:</label>
                <input class="default-input" type="text" id="product-price">
            </div>
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
        </div>
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
    </div>
</section>