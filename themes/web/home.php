<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-script"); ?>
    <script src="assets/js/scripts-home.js" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="assets/css/home.css">
<?php $this->end(); ?>

<section class="main">
    <div class="banner">
        <img src="assets/imgs/background.png">
    </div>
    <!-- banner -->
    <!-- seção rápida scroll horizontal -->
    <!-- seção rápida (talvez por marcas)-->
    <section class="section-products">
        <h2>EM ALTA</h2>
        <div class="container-grid-section">
            <div class="product-container">
                <a href="<?= url("product") ?>">
                    <div class="image-container">
                        <img src="assets/imgs/camisa-independent.jpeg">
                    </div>
                    <div class="product-description">
                        <p class="title">CAMISA INDEPENDENT BLACK OVERSIZED - Truck Co.</p>
                        <p class="price">R$ 199,90</p>
                        <p class="price">ou R$180,00 no PIX</p>
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
        </div>
    </section>
    <!-- banner -->


</section>