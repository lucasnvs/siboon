<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('about/about.css') ?>">
<?php $this->end(); ?>

<div id="container-about">
    <div>
        <div class="picture-card">
            <img src="<?= assets('assets/imgs/picture-loja.png') ?>">
            <p>S I B O O N</p>
        </div>
    </div>
    <div class="about">
        <h2>NÓS SOMOS SIBOON</h2>
        <p>A Siboon SkateShop é uma loja especializada em skate, localizada em Porto Alegre, RS. Oferecemos as peças
            mais exclusivas e os DROPS das marcas mais renomadas da cena do skate. Nosso compromisso é entregar produtos
            de qualidade e estilo, sempre com o espírito de "Atitude, qualidade e estilo sobre rodas". Se você é
            apaixonado por skate, vai encontrar tudo o que precisa aqui!</p>
        <h2>NOSSA HISTÓRIA</h2>
        <p>Começamos com uma pequena loja no centro de Porto Alegre, onde logo a galera se encantou com nossa seleção de
            roupas e peças para skate. O sucesso foi imediato, e logo a loja ficou pequena para tanto movimento. Com
            isso, conseguimos expandir para um novo espaço, que é o dobro do tamanho da primeira. Hoje, mantemos nossa
            essência, com a mesma paixão pelo skate e o compromisso de oferecer o melhor para os skatistas de todas as
            idades.

            A Siboon SkateShop é mais do que uma loja, é um lugar onde a cultura do skate se encontra com o estilo de
            vida urbano.</p>
    </div>
</div>
