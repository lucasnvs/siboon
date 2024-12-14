<?php $this->layout("master", ['title' => $title, "product_id" => $product_id]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('product/product.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('product/product.js') ?>" type="module" async></script>
<?php $this->end(); ?>

<data id="product_id" value="<?= $product_id ?>"></data>

<main id="main">
    <section class="product-container">
        <div class="galery-container">
            <aside class="product-gallery" aria-label="Galeria de Imagens do Produto"></aside>
            <figure class="product-main-image">
                <img alt="Imagem Principal">
            </figure>
        </div>
        <article class="product-info">
            <header>
                <h1 class="product-title">Carregando...</h1>
                <p class="product-brand">Marca: <span>Carregando...</span></p>
            </header>
            <div class="product-price" aria-label="Product price">R$ ...</div>
            <p class="product-description">
                Carregando... Carregando... Carregando... Carregando... Carregando... Carregando...
            </p>
            <section class="product-sizes" aria-labelledby="available-sizes">
                <h2 id="available-sizes">Tamanhos Disponíveis</h2>
                <ul></ul>
            </section>
            <button class="btn" style="width: 300px" aria-label="Add to cart">
                Comprar
            </button>
        </article>
    </section>
</main>
