import {URL_BASE_SITE} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";


const products_grid_section = document.querySelector(".container-grid-section");

async function renderProducts() {
    let {data: products} = await ProductService.getData();
    products_grid_section.innerHTML = "";

    if(!products) return;
    products.forEach(product => {
        products_grid_section.innerHTML += `
            <div class="product-container">
                <a href="${URL_BASE_SITE+"produto/"+product.url}">
                    <div class="image-container">
                        <img src="${URL_BASE_SITE+product.principal_img}">
                    </div>
                    <div class="product-description">
                        <p class="title">${product.name}</p>
                        <p class="price">${product.formated_price_brl}</p>
                        <p class="price">ou ${product.formated_price_brl_with_discount} no PIX</p>
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
    })
}

(async () => {
    await renderProducts();
})();