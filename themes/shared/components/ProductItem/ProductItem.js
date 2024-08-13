import {URL_BASE_SITE} from "../../Constants.js";
import {openCart} from "../../../web/assets/js/scripts-master.js";


const link = document.createElement("link");
link.rel = "stylesheet";
link.href = URL_BASE_SITE+"themes/shared/components/ProductItem/ProductItem.css";
document.head.appendChild(link);

export const ProductItem = (product) => {

    const productContainer = document.createElement('div');
    productContainer.classList.add('product-container');

    const productLink = document.createElement('a');
    productLink.href = `${URL_BASE_SITE}produto/${product.url}`;

    const imageContainer = document.createElement('div');
    imageContainer.classList.add('image-container');
    const image = document.createElement('img');

    image.src = URL_BASE_SITE+product.principal_img;

    imageContainer.appendChild(image);

    const productDescription = document.createElement('div');
    productDescription.classList.add('product-description');

    const title = document.createElement('p');
    title.classList.add('title');
    title.textContent = product.name;
    const price1 = document.createElement('p');
    price1.classList.add('price');
    price1.textContent = product.formated_price_brl;
    const price2 = document.createElement('p');
    price2.classList.add('price');
    price2.textContent = `ou ${product.formated_price_brl_with_discount} no PIX`;
    productDescription.appendChild(title);
    productDescription.appendChild(price1);
    productDescription.appendChild(price2);

    productLink.appendChild(imageContainer);
    productLink.appendChild(productDescription);

    const sizeSelector = document.createElement('span');
    sizeSelector.textContent = 'SELECIONE O TAMANHO';

    const sizesContainer = document.createElement('div');
    sizesContainer.classList.add('sizes');

    const sizes = ['P', 'M', 'G', 'GG'];
    sizes.forEach(size => {
        const sizeButton = document.createElement('button');
        sizeButton.classList.add('size');
        sizeButton.textContent = size;
        sizesContainer.appendChild(sizeButton);

        sizeButton.addEventListener("click", () => {
            product.size = size;
            sizeSelector.remove();
            productContainer.appendChild(addButton);
        })
    });



    const addButton = document.createElement('button');
    addButton.classList.add('btn');
    addButton.textContent = 'ADICIONAR NA SACOLA';

    addButton.addEventListener("click", () => {
        localStorage.pushToItem("cart", product)
        openCart()
    });

    productContainer.appendChild(productLink);
    productContainer.appendChild(sizesContainer);
    productContainer.appendChild(sizeSelector);

    return productContainer;
}