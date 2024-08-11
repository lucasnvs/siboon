import {InputAmount} from "../../shared/components/InputAmount/InputAmount.js";
import {URL_BASE_SITE} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";

const productImageContainer = document.getElementById("product-image-container");
const productDescriptionContainer = document.getElementById("product-description-container");
const PRODUCT_ID = document.getElementById("product_id").value;

async function renderProductDetail() {
    let {data: product} = await ProductService.getDataById(PRODUCT_ID);

    var midStringImage = "";
    if(product.additional_imgs) {

        product.additional_imgs.forEach( img => {
            midStringImage += `<img src="${URL_BASE_SITE+img}" class="side-image">`;
        });
    }
    productImageContainer.innerHTML = `
    <div class="side-images-container">
        ${midStringImage}
    </div>
    <img src="${URL_BASE_SITE+product.principal_img}"  id="principal-image">
`

    productDescriptionContainer.innerHTML = `
    <h2>${product.name}</h2>
    <p>${product.formated_price_brl}</p>
    <p>ou até 3x de R$ ${(product.price_brl / 3).toFixed(2)}</p>

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
`

    document.getElementById("quantity-container").append(
        InputAmount("quantity")
    )
}

(async ()=> {
    await renderProductDetail()
})()