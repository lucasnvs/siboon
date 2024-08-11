import {ProductService} from "../../shared/services/ProductService.js";
import {ProductItem} from "../../shared/components/ProductItem/ProductItem.js";

// its duplicated because, the section implementation isn't ready.

const products_grid_section = document.querySelector(".container-grid-section");

async function renderProducts() {
    let {data: products} = await ProductService.getData();
    products_grid_section.innerHTML = "";

    if(!products) return;
    products.forEach(product => {
        products_grid_section.append(ProductItem(product))
    })
}

(async () => {
    await renderProducts();
})();