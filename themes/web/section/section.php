<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('section/section.css') ?>">
    <link rel="stylesheet" href="<?= assets('components/ProductItem/ProductItem.css', 'shared') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('section/section.js') ?>" type="module" async></script>
<?php $this->end(); ?>
<!-- transformar para se buildar de acordo com o tipo de seção e produto, por enquanto exemplo: SALE -->

<div id="top">
    <h2><?= isset($title) ? $title : "SALE"?></h2>
</div>
<div id="principal">
    <aside id="filters">
        <div class="filters-sticky-container">
            <p>FILTROS</p>

            <div>
                <p>Ordenar</p>
                <select>
                    <option>Mais Procurados</option>
                    <option>Menor Preço</option>
                    <option>Maior Preço</option>
                </select>
            </div>

            <div>
                <p>Tamanho</p>
                <div>
                    <div>
                        <input id="size-p" type="checkbox" value="P">
                        <label for="size-p">P</label>
                    </div>
                    <div>
                        <input id="size-p" type="checkbox" value="P">
                        <label for="size-p">P</label>
                    </div>
                    <div>
                        <input id="size-p" type="checkbox" value="P">
                        <label for="size-p">P</label>
                    </div>
                    <div>
                        <input id="size-p" type="checkbox" value="P">
                        <label for="size-p">P</label>
                    </div>
                    <div>
                        <input id="size-p" type="checkbox" value="P">
                        <label for="size-p">P</label>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <div class="container-grid-section">

    </div>
</div>