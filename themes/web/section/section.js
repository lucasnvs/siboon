import {ProductService} from "../../shared/services/ProductService.js";
import {ProductItem} from "../../shared/components/ProductItem/ProductItem.js";
import {WebsiteService} from "../../shared/services/WebsiteService.js";


const products_grid_section = document.querySelector(".container-grid-section");

async function renderSections() {
    let [responseSection, isError] = await WebsiteService.getSection();
    if (isError) return;

    responseSection.data.forEach(section => {
        const gridContainer = document.createElement("div");
        gridContainer.classList.add("container-grid-section");

        section.featured_items.forEach(async item => {
            let [responseProduct, isErrorProduct] = await ProductService.getDataById(item.product_id);
            if(isErrorProduct) return;

            const productElement = ProductItem(responseProduct.data);
            gridContainer.appendChild(productElement);
        });
    });
}

(async () => {
    await renderProducts();
})();