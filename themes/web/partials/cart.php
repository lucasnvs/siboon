<div id="background-cart" class="background-blur">
    <div id="cart-body">
        <div id="cart-header">
            <p>Carrinho  <span id="span-cart-quantity">(0 itens)</span></p>
            <div id="close-cart" class="close-x" style="background-color: gray"></div>
        </div>
        <div id="cart-catalog">
            <div class="item-cart">
                <img src="<?= assets("web", "imgs/black-tshirt.jpg") ?>" alt="Imagem de ...">
                <div class="item-cart-desc">
                    <h2>Tênis Tesla Shine Black Reflect</h2>
                    <p>Cor: Black Reflect | Tamanho: 38</p>
                    <p>R$ 320,00</p>

                    <!-- input quantity number -->
                    <!-- button icon trash -->
                </div>
            </div>
        </div>
        <div id="cart-info">
            <div class="info row">
                <p>Subtotal</p>
                <h5>R$ 699,82</h5>
            </div>
            <div class="info col">
                <p>Frete - Digite seu CEP</p>
                <div class="input-container">
                    <input class="default-input" type="text" id="cep" placeholder="Digite seu CEP">
                    <button>Calcular</button>
                </div>
            </div>

            <button class="btn">FAZER PEDIDO R$ 699,82</button>
        </div>
    </div>
</div>
