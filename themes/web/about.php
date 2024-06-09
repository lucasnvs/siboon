<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('web', 'css/about.css') ?>">
<?php $this->end(); ?>

<div id="container-about">
    <div>
        <div class="picture-card">
            <img src="<?= assets('web', 'imgs/picture-loja.png') ?>">
            <p>S I B O O N</p>
        </div>
    </div>
    <div class="about">
        <h2>NÓS SOMOS SIBOON</h2>
        <p>Siboon SkateShop, uma loja de skate de Porto Alegre, RS. Temos as mais exclusivas peças de DROPS das marcas mais
            brabas da cena, nosso lema é BLABLABLABLABLABLABLABLABLABLA.</p>
        <h2>NOSSO INICIO</h2>
        <p>Começamos com uma pequena loja no centro de POA, com a galera vendo nossas roupas e toda nossa variedade de peças
            pros seus carrinhos a gente estourou, até conseguirmos nossa atual loja que é o dobro do tamanho da antiga!</p>
    </div>
</div>
