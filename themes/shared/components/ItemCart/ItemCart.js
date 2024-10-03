import {InputAmount} from "../InputAmount/InputAmount.js";
import {CART_CACHE, GetBaseURL} from "../../Constants.js";
import {updateCart} from "../../../web/assets/js/scripts-master.js";

export const ItemCart = (product) => {
    const itemCart = document.createElement('div');
    itemCart.classList.add('item-cart');

    const image = document.createElement('img');
    image.src = GetBaseURL(product.principal_img);
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

    itemCartDesc.appendChild(
        InputAmount({
            onIncrement: () => {
                CART_CACHE.push(product);
                updateCart();
            },
            onMinus: () => {
                CART_CACHE.minus(product.id);
                updateCart();
            },
            onZero: () => {
                CART_CACHE.remove(product.id);
                updateCart();
            },
            initialValue: product.amount ? product.amount : 1
        })
    )

    itemCart.appendChild(image);
    itemCart.appendChild(itemCartDesc);

    return itemCart;
}