import {InputAmount} from "../InputAmount/InputAmount.js";
import {URL_BASE_SITE} from "../../Constants.js";

export const ItemCart = (product, onZero) => {
    const itemCart = document.createElement('div');
    itemCart.classList.add('item-cart');

    const image = document.createElement('img');
    image.src = URL_BASE_SITE+product.principal_img;
    image.alt = `Imagem de ${product.name}`;

    const itemCartDesc = document.createElement('div');
    itemCartDesc.classList.add('item-cart-desc');

    const titleElement = document.createElement('h2');
    titleElement.textContent = product.name;

    const description = document.createElement('p');
    description.textContent = `Cor: ${product.color} | Tamanho: ${product.size}`;

    const priceSpan = document.createElement('span');
    priceSpan.textContent = product.formated_price;

    itemCartDesc.appendChild(titleElement);
    itemCartDesc.appendChild(description);
    itemCartDesc.appendChild(priceSpan);
    // Append input and button elements here

    itemCartDesc.appendChild(
        InputAmount({ onZero: onZero, initialValue: 1 })
    )

    itemCart.appendChild(image);
    itemCart.appendChild(itemCartDesc);

    return itemCart;
}