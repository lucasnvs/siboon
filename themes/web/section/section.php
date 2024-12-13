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

    </div>
</div>