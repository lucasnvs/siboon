import {ProductService} from "../../shared/services/ProductService.js";
import {ProductItem} from "../../shared/components/ProductItem/ProductItem.js";
import {WebsiteService} from "../../shared/services/WebsiteService.js";


const products_grid_section = document.querySelector(".container-grid-section");

async function renderSections() {
    let [responseSection, isError] = await WebsiteService.getSection();
    if (isError) return;

    responseSection.data.forEach(section => {
        section.featured_items.forEach(async item => {
            let [responseProduct, isErrorProduct] = await ProductService.getDataById(item.product_id);
            if (isErrorProduct) return;

            const productElement = ProductItem(responseProduct.data);
            products_grid_section.appendChild(productElement);
        });
    });
}

document.getElementById("price-range").addEventListener("input", (event) => {
    const priceOutput = document.querySelector(".price-output");
    const value = parseInt(event.target.value, 10);
    priceOutput.textContent = `R$ ${value.toFixed(2).replace('.', ',')}`;
});

(async () => {
    await renderSections();
})();