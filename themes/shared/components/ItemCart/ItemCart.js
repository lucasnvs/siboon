import {InputAmount} from "../InputAmount/InputAmount.js";
import {CART_CACHE, GetBaseURL} from "../../Constants.js";
import {updateCart} from "../../../web/assets/js/scripts-master.js";

export const ItemCart = (product) => {
    const itemCart = document.createElement('div');
    itemCart.classList.add('cart-item');

    const image = document.createElement('img');
    image.src = GetBaseURL(product.principal_img);
    image.alt = `Imagem de ${product.name}`;
    image.classList.add('cart-item-image');

    const itemCartDesc = document.createElement('div');
    itemCartDesc.classList.add('cart-item-details');

    const titleElement = document.createElement('h2');
    titleElement.textContent = product.name;
    titleElement.classList.add('cart-item-title');

    const description = document.createElement('p');
    description.textContent = `Cor: ${product.color} | Tamanho: ${product.size}`;
    description.classList.add('cart-item-description');

    const priceSpan = document.createElement('span');
    priceSpan.textContent = product.formated_price;
    priceSpan.classList.add('cart-item-price');

    itemCartDesc.appendChild(titleElement);
    itemCartDesc.appendChild(description);
    itemCartDesc.appendChild(priceSpan);

    let [inputAmount, quantity] = InputAmount({
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
    itemCartDesc.appendChild(inputAmount)

    itemCart.appendChild(image);
    itemCart.appendChild(itemCartDesc);

    return itemCart;
}