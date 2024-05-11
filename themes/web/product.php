<?php $this->layout("master", ["title"=> "Camisa Independent Oversizes - Truck CO."]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="assets/css/product.css">
<?php $this->end(); ?>

<div id="product-image-container">
    <div class="side-images-container">
        <img src="assets/imgs/black-tshirt.jpg" class="side-image">
        <img src="assets/imgs/black-tshirt.jpg" class="side-image">
        <img src="assets/imgs/black-tshirt.jpg" class="side-image">
        <img src="assets/imgs/black-tshirt.jpg" class="side-image">
    </div>
    <img src="assets/imgs/black-tshirt.jpg"  id="principal-image">
</div>

<div id="product-description-container">
    <h2>CAMISA INDEPENDENT OVERSIZES - TRUCK CO.</h2>
    <p>R$ 179,90</p>
    <p>ou até 3x de R$ 59,97</p>

    <p>Meia malha fio 26 feita 100% de algodão, com processo biopolimento que
        elimina fibras soltas. Lavagem anti-encolhimento, com amaciamento com
        silicone para maior maciez; Algodão Sustentável Certificado, com selo
        BCI (Better Cotton Initiative); Silk a base d’água e etiquetas localizadas.</p>

    <p>TAMANHO</p>
    <div class="sizes">
        <button class="size">P</button>
        <button class="size">M</button>
        <button class="size">G</button>
        <button class="size">GG</button>
    </div>

    <div>
        <p>QUANTIDADE</p>
        <div class="quantity-container">
            <button id="quantity-plus">+</button>
            <input type="number">
            <button id="quantity-minus">-</button>
        </div>
        <button class="btn">COMPRAR</button>
    </div>
</div>