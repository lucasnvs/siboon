import {ProductService} from "../../shared/services/ProductService.js";
import {ProductItem} from "../../shared/components/ProductItem/ProductItem.js";
import {WebsiteService} from "../../shared/services/WebsiteService.js";

(async () => {
    await renderSections();
    // await renderProducts();
})();

const products_grid_section = document.querySelector(".container-grid-section");
async function renderSections() {
    let [responseSection, isError] = await WebsiteService.getSection();
    if (isError) return;

    const mainContainer = document.querySelector(".main");

    responseSection.data.forEach(section => {
        const sectionElement = document.createElement("section");
        sectionElement.classList.add("section-products");

        const sectionTitle = document.createElement("h2");
        sectionTitle.textContent = section.name.toUpperCase();

        const gridContainer = document.createElement("div");
        gridContainer.classList.add("container-grid-section");

        section.featured_items.forEach(async item => {
            let [responseProduct, isErrorProduct] = await ProductService.getDataById(item.product_id);
            if(isErrorProduct) return;

            const productElement = ProductItem(responseProduct.data);
            gridContainer.appendChild(productElement);
        });

        sectionElement.appendChild(sectionTitle);
        sectionElement.appendChild(gridContainer);
        mainContainer.appendChild(sectionElement);
    });
}

async function renderProducts() {
    let [{data: products}, isError] = await ProductService.getData();
    products_grid_section.innerHTML = "";

    if(!products) return;
    products.forEach(product => {
        products_grid_section.append(ProductItem(product))
    })
}