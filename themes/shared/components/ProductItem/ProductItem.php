
<div class="product-container">
    <a href="<?= url("produto/". $product["url"]) ?>">
        <div class="image-container">
            <img src="<?= url($product["res_path"]) ?>">
        </div>
        <div class="product-description">
            <p class="title"><?= $product["name"] ?></p>
            <p class="price"><?= $product["formated_price_brl"] ?></p>
            <p class="price">ou <?= $product["formated_price_brl_with_discount"]?> no PIX</p>
        </div>
    </a>
    <div class="sizes">
        <button class="size">P</button>
        <button class="size">M</button>
        <button class="size">G</button>
        <button class="size">GG</button>
    </div>
    <!-- seletor de tamanho -->
    <!-- se não tiver selecionado aparece --> <span>SELECIONE O TAMANHO</span>
    <!-- se estiver, aparece o botão -->
    <button class="btn">ADICIONAR NA SACOLA</button>
</div>