console.log("HOME - Olá, Mundo!");

const CONTAINER = document.querySelector(".container-grid-section")

for (let i = 0; i < 7; i++) {
    CONTAINER.innerHTML +=
        `
        <div class="product-container">
                <a href="http://localhost/siboon/produto/tshirt-diamond-black-piano">
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
        `
}