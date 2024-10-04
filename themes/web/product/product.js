import { InputAmount } from "../../shared/components/InputAmount/InputAmount.js";
import { GetBaseURL } from "../../shared/Constants.js";
import { ProductService } from "../../shared/services/ProductService.js";
import {ErrorDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";

const productImageContainer = document.getElementById("product-image-container");
const productDescriptionContainer = document.getElementById("product-description-container");
const PRODUCT_ID = document.getElementById("product_id").value;

async function renderProductDetail() {
    const [{data: product, message}, isError] = await ProductService.getDataById(PRODUCT_ID);
    if(isError) {
        ErrorDialog(message)
        return
    }

    productImageContainer.innerHTML = generateProductImages(product);
    productDescriptionContainer.innerHTML = generateProductDescription(product);
}

function generateProductImages(product) {
    const additionalImages = product.additional_imgs?.map(img => `<img src="${GetBaseURL(img)}" class="side-image">`).join('') || '';
    return `
        <div class="side-images-container">
            ${additionalImages}
        </div>
        <img src="${GetBaseURL(product.principal_img)}" id="principal-image">
    `;
}

function generateProductDescription(product) {
    const installmentPrice = (product.price_brl / 3).toFixed(2);
    return `
        <h2>${product.name}</h2>
        <p>${product.formated_price_brl}</p>
        <p>ou até 3x de R$ ${installmentPrice}</p>
        <p>${product.description}</p>
        <p>TAMANHO</p>
        <div class="sizes">
            <button class="size">P</button>
            <button class="size">M</button>
            <button class="size">G</button>
            <button class="size">GG</button>
        </div>
        <div id="quantity-container">
            <p>QUANTIDADE</p>
        </div>
        <button class="btn">COMPRAR</button>
    `;
}

(async () => {
    await renderProductDetail();
    document.getElementById("quantity-container").append(InputAmount("quantity"));
})();
