<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('section/section.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('section/section.js') ?>" async></script>
<?php $this->end(); ?>

<div id="top">
    <h2><?= isset($title) ? $title : "SALE" ?></h2>
</div>
<div id="principal">
    <aside id="filters">
        <aside class="product-filters">
            <h2 class="filters-title">Filtros</h2>

            <div class="filter-section">
                <label for="order-by" class="filter-label">Ordenar por:</label>
                <div class="filter-control">
                    <select id="order-by" class="filter-select">
                        <option value="mais-procurados">Mais Procurados</option>
                        <option value="menos-procurados">Menos Procurados</option>
                        <option value="maior-preco">Maior Preço</option>
                        <option value="menor-preco">Menor Preço</option>
                    </select>
                    <div class="select-arrow">&#9660;</div>
                </div>
            </div>

            <div class="filter-section">
                <label class="filter-label">Tamanho:</label>
                <div class="size-options">
                    <div class="size-option">
                        <input type="checkbox" id="size-p" value="p" class="filter-checkbox">
                        <label for="size-p" class="filter-label">P</label>
                    </div>
                    <div class="size-option">
                        <input type="checkbox" id="size-m" value="m" class="filter-checkbox">
                        <label for="size-m" class="filter-label">M</label>
                    </div>
                    <div class="size-option">
                        <input type="checkbox" id="size-g" value="g" class="filter-checkbox">
                        <label for="size-g" class="filter-label">G</label>
                    </div>
                    <div class="size-option">
                        <input type="checkbox" id="size-gg" value="gg" class="filter-checkbox">
                        <label for="size-gg" class="filter-label">GG</label>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <label for="price-range" class="filter-label">Faixa de Preço:</label>
                <div class="filter-control">
                    <input type="range" id="price-range" min="0" max="500" value="250" class="filter-slider">
                    <output for="price-range" class="price-output">R$ 250,00</output>
                </div>
            </div>

            <button class="filter-button">Aplicar Filtros</button>
        </aside>
    </aside>

    <div class="container-grid-section">
        <div class="product-container"><a href="http://localhost/siboon/produto/camisa-high-tee-black-5">
                <div class="image-container"><img
                            src="http://localhost/siboon/storage/images/products/5/principal-image.jpg"></div>
                <div class="product-description"><p class="title">Camisa High Tee Black</p>
                    <p class="price">R$ 110,00</p>
                    <p class="price">ou R$ 107,80 no PIX</p></div>
            </a>
            <div class="sizes">
                <button id="5-size-p" class="size">P</button>
                <button id="5-size-m" class="size">M</button>
                <button id="5-size-g" class="size">G</button>
                <button id="5-size-gg" class="size">GG</button>
            </div>
            <span>SELECIONE O TAMANHO</span></div>
        <div class="product-container"><a
                    href="http://localhost/siboon/produto/cal-a-vans-drill-chore-carpenter-denim-ave-2-0-pirate-black-3">
                <div class="image-container"><img
                            src="http://localhost/siboon/storage/images/products/3/principal-image-1733635169.png">
                </div>
                <div class="product-description"><p class="title">CALÇA VANS DRILL CHORE CARPENTER DENIM AVE 2.0 PIRATE
                        BLACK</p>
                    <p class="price">R$ 390,00</p>
                    <p class="price">ou R$ 370,50 no PIX</p></div>
            </a>
            <div class="sizes">
                <button id="3-size-p" class="size">P</button>
                <button id="3-size-m" class="size">M</button>
                <button id="3-size-g" class="size">G</button>
                <button id="3-size-gg" class="size">GG</button>
            </div>
            <span>SELECIONE O TAMANHO</span></div>
        <div class="product-container"><a href="http://localhost/siboon/produto/vans-bailey-1">
                <div class="image-container"><img
                            src="http://localhost/siboon/storage/images/products/1/principal-image-1732583560.png">
                </div>
                <div class="product-description"><p class="title">Vans Bailey</p>
                    <p class="price">R$ 299,90</p>
                    <p class="price">ou R$ 299,90 no PIX</p></div>
            </a>
            <div class="sizes">
                <button id="1-size-p" class="size">P</button>
                <button id="1-size-m" class="size">M</button>
                <button id="1-size-g" class="size">G</button>
                <button id="1-size-gg" class="size">GG</button>
            </div>
            <span>SELECIONE O TAMANHO</span></div>
        <div class="product-container"><a href="http://localhost/siboon/produto/camisa-azul-top-2">
                <div class="image-container"><img
                            src="http://localhost/siboon/storage/images/products/2/principal-image-1731551643.png">
                </div>
                <div class="product-description"><p class="title">Camisa Azul Top</p>
                    <p class="price">R$ 99,90</p>
                    <p class="price">ou R$ 97,90 no PIX</p></div>
            </a>
            <div class="sizes">
                <button id="2-size-p" class="size">P</button>
                <button id="2-size-m" class="size">M</button>
                <button id="2-size-g" class="size">G</button>
                <button id="2-size-gg" class="size">GG</button>
            </div>
            <span>SELECIONE O TAMANHO</span></div>
    </div>
</div>