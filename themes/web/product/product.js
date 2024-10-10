import { InputAmount } from "../../shared/components/InputAmount/InputAmount.js";
import { GetBaseURL } from "../../shared/Constants.js";
import { ProductService } from "../../shared/services/ProductService.js";
import { ErrorDialog } from "../../shared/components/SimpleDialog/SimpleDialog.js";

const productImageContainer = document.getElementById("product-image-container");
const productDescriptionContainer = document.getElementById("product-description-container");
const PRODUCT_ID = document.getElementById("product_id").value;

async function renderProductDetail() {
    const [{ data: product, message }, isError] = await ProductService.getDataById(PRODUCT_ID);
    if (isError) {
        ErrorDialog(message);
        return;
    }

    productImageContainer.innerHTML = generateProductImages(product);
    productDescriptionContainer.innerHTML = generateProductDescription(product);

    // Aplica o InputAmount depois que os detalhes do produto foram renderizados
    document.getElementById("quantity-container").append(InputAmount("quantity"));

    // Configura o evento de troca de imagem
    setupImageSwitching();
}

function generateProductImages(product) {
    const additionalImages = product.additional_imgs?.map((img, index) => `
        <img src="${GetBaseURL(img)}" alt="Imagem do Produto ${index + 1}" class="side-image">
    `).join('') || '';

    return `
        <div id="side-images-container" class="side-images-container">
            ${additionalImages}
        </div>
        <img src="${GetBaseURL(product.principal_img)}" id="principal-image" alt="${product.name}">
    `;
}

function generateProductDescription(product) {
    const installmentPrice = (product.price_brl / 3).toFixed(2);
    product.sizes = ["PP", "P", "M"]
    return `
        <h2>${product.name}</h2>
        <p>${product.formated_price_brl}</p>
        <p>ou até 3x de R$ ${installmentPrice}</p>
        <p>${product.description}</p>
        <p>TAMANHO</p>
        <div class="sizes">
            ${product.sizes.map(size => `<button class="size">${size}</button>`).join('')}
        </div>
        <div id="quantity-container">
            <p>QUANTIDADE</p>
        </div>
        <button class="btn add-to-cart-btn">COMPRAR</button>
    `;
}

function setupImageSwitching() {
    const principalImage = document.getElementById('principal-image');
    const sideImages = document.querySelectorAll('.side-image');

    sideImages.forEach(smallImage => {
        smallImage.addEventListener('click', () => {
            const tempSrc = principalImage.src;

            principalImage.src = smallImage.src;

            smallImage.src = tempSrc;
        });
    });
}

(async () => {
    await renderProductDetail();
})();
